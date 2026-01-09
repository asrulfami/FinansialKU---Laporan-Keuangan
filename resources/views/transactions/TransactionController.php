<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Transaction::query();

        // Jika bukan admin, hanya tampilkan transaksi milik sendiri
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $transactions = $query->orderBy('date', 'desc')->paginate(10);
        
        // Hitung total untuk ringkasan di halaman index
        if ($user->role !== 'admin') {
             $totalIn = Transaction::where('user_id', $user->id)->where('type', 'in')->sum('amount');
             $totalOut = Transaction::where('user_id', $user->id)->where('type', 'out')->sum('amount');
        } else {
             $totalIn = Transaction::where('type', 'in')->sum('amount');
             $totalOut = Transaction::where('type', 'out')->sum('amount');
        }

        return view('transactions.index', compact('transactions', 'totalIn', 'totalOut'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255', // Validasi kategori wajib diisi
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:in,out',
        ]);

        $validated['user_id'] = Auth::id();

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaction $transaction)
    {
        // Pastikan user hanya bisa edit punya sendiri (kecuali admin)
        if (Auth::user()->role !== 'admin' && $transaction->user_id !== Auth::id()) {
            abort(403);
        }
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        if (Auth::user()->role !== 'admin' && $transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255', // Validasi kategori
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:in,out',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        if (Auth::user()->role !== 'admin' && $transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
