<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $userBalances = [];
        $viewingUser = null;
        $currentBalance = 0;
        $chartDates = [];
        $chartIncome = [];
        $chartExpense = [];

        if ($user && $user->role === 'admin') {
            // Cek apakah admin sedang melihat detail user tertentu
            if ($request->has('user_id')) {
                $viewingUser = User::find($request->user_id);
            }

            // Gunakan satu logika query: Jika ada user tertentu, filter. Jika tidak, ambil semua.
            // Filter: Jika melihat semua, hanya ambil transaksi user (bukan admin) agar sinkron dengan daftar userBalances
            $query = $viewingUser 
                ? Transaction::where('user_id', $viewingUser->id) 
                : Transaction::whereHas('user', function($q) { $q->where('role', '!=', 'admin'); });

            // Filter Tanggal
            if ($request->filled('start_date')) {
                $query->whereDate('date', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $query->whereDate('date', '<=', $request->end_date);
            }

            $totalIn = (clone $query)->where('type', 'in')->sum('amount');
            $totalOut = (clone $query)->where('type', 'out')->sum('amount');
            $currentBalance = $totalIn - $totalOut;

            // Ambil data untuk grafik (Group by Date)
            $chartData = (clone $query)
                ->selectRaw('DATE(date) as date, type, SUM(amount) as total')
                ->groupBy('date', 'type')
                ->orderBy('date', 'asc')
                ->get();
            
            $chartDates = $chartData->pluck('date')->unique()->sort()->values();
            foreach ($chartDates as $date) {
                $chartIncome[] = $chartData->where('date', $date)->where('type', 'in')->sum('total');
                $chartExpense[] = $chartData->where('date', $date)->where('type', 'out')->sum('total');
            }

            $transactions = $query->with('user')->orderBy('date', 'desc')->paginate(10)->withQueryString();

            $userBalances = User::where('role', '!=', 'admin')
                ->withSum(['transactions as income' => function($query) {
                    $query->where('type', 'in');
                }], 'amount')
                ->withSum(['transactions as expense' => function($query) {
                    $query->where('type', 'out');
                }], 'amount')
                ->get();
        } else {
            $query = Transaction::where('user_id', $user->id);

            if ($request->filled('start_date')) {
                $query->whereDate('date', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $query->whereDate('date', '<=', $request->end_date);
            }

            $transactions = (clone $query)->orderBy('date','desc')->paginate(10)->withQueryString();
            $totalIn = (clone $query)->where('type','in')->sum('amount');
            $totalOut = (clone $query)->where('type','out')->sum('amount');
            $currentBalance = $totalIn - $totalOut;

            // Ambil data untuk grafik (Group by Date)
            $chartData = (clone $query)
                ->selectRaw('DATE(date) as date, type, SUM(amount) as total')
                ->groupBy('date', 'type')
                ->orderBy('date', 'asc')
                ->get();
            
            $chartDates = $chartData->pluck('date')->unique()->sort()->values();
            foreach ($chartDates as $date) {
                $chartIncome[] = $chartData->where('date', $date)->where('type', 'in')->sum('total');
                $chartExpense[] = $chartData->where('date', $date)->where('type', 'out')->sum('total');
            }
        }

        return view('transactions.index', compact('transactions', 'totalIn', 'totalOut', 'currentBalance', 'userBalances', 'viewingUser', 'chartDates', 'chartIncome', 'chartExpense'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:in,out',
            'date' => 'nullable|date',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $user = $request->user();
        if (!$user) abort(403); // Pastikan user login

        // Jika bukan admin atau user_id tidak diisi, gunakan ID user yang login
        if ($user->role !== 'admin' || !isset($data['user_id'])) {
            $data['user_id'] = $user->id;
        }

        $transaction = Transaction::create($data);

        // Jika admin menginput untuk user tertentu, redirect kembali ke filter user tersebut
        if ($user->role === 'admin' && $transaction->user_id !== $user->id) {
            return redirect()->route('transactions.index', ['user_id' => $transaction->user_id])->with('success', 'Transaction saved.');
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction saved.');
    }

    public function show(Transaction $transaction)
    {
        $user = auth()->user();
        if (!$user || ($user->role !== 'admin' && $transaction->user_id !== $user->id)) {
            abort(403);
        }

        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $user = auth()->user();
        if (!$user || ($user->role !== 'admin' && $transaction->user_id !== $user->id)) {
            abort(403);
        }

        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:in,out',
            'date' => 'nullable|date',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $user = $request->user();
        if (!$user || ($user->role !== 'admin' && $transaction->user_id !== $user->id)) {
            abort(403);
        }

        // Cegah user biasa mengubah pemilik transaksi
        if ($user->role !== 'admin') {
            unset($data['user_id']);
        }

        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated.');
    }

    public function destroy(Transaction $transaction)
    {
        $user = auth()->user();
        if (!$user || ($user->role !== 'admin' && $transaction->user_id !== $user->id)) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted.');
    }

    public function exportExcel()
    {
        $user = auth()->user();
        $transactions = $user->role === 'admin' 
            ? Transaction::with('user')->orderBy('date', 'desc')->get()
            : $user->transactions()->orderBy('date', 'desc')->get();

        $filename = "laporan_keuangan_" . date('Y-m-d_H-i-s') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Tanggal', 'Kategori', 'Deskripsi', 'Tipe', 'Jumlah'];
        if ($user->role === 'admin') {
            array_unshift($columns, 'Nama User');
        }

        $callback = function() use($transactions, $columns, $user) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transactions as $t) {
                if ($user->role === 'admin') {
                    $row['Nama User'] = $t->user->name ?? 'User Tidak Ditemukan';
                }
                $row['Tanggal']  = $t->date->format('Y-m-d');
                $row['Kategori'] = $t->category;
                $row['Deskripsi'] = $t->description;
                $row['Tipe']     = $t->type == 'in' ? 'Pemasukan' : 'Pengeluaran';
                $row['Jumlah']   = $t->amount;

                fputcsv($file, array_values($row));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $user = auth()->user();
        $targetUser = null;
        $query = null;

        if ($user->role === 'admin') {
            if ($request->has('user_id')) {
                $targetUser = User::find($request->user_id);
                $query = Transaction::where('user_id', $targetUser->id);
                $filename = "Laporan_Keuangan_" . str_replace(' ', '_', $targetUser->name);
            } else {
                $query = Transaction::with('user');
                $filename = "Laporan_Keuangan_Semua";
            }
        } else {
            $targetUser = $user;
            $query = $user->transactions();
            $filename = "Laporan_Keuangan_" . str_replace(' ', '_', $user->name);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
            $filename .= "_from_" . $request->start_date;
        }
        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
            $filename .= "_to_" . $request->end_date;
        }
        
        $transactions = $query->orderBy('date', 'desc')->get();

        $totalIn = $transactions->where('type', 'in')->sum('amount');
        $totalOut = $transactions->where('type', 'out')->sum('amount');
        $currentBalance = $totalIn - $totalOut;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transactions.pdf', compact('transactions', 'totalIn', 'totalOut', 'currentBalance', 'targetUser', 'startDate', 'endDate'));
        return $pdf->download($filename . '.pdf');
    }

    public function print()
    {
        $user = auth()->user();
        
        $transactions = $user->role === 'admin' 
            ? Transaction::with('user')->orderBy('date', 'desc')->get()
            : $user->transactions()->orderBy('date', 'desc')->get();
            
        return view('transactions.print', compact('transactions'));
    }
}
