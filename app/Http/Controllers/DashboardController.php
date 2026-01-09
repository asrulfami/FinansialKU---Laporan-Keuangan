<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua transaksi user
        $transactions = Transaction::where('user_id', $userId)->get();

        // Hitung Total Pemasukan (type = 'in')
        $totalPemasukan = $transactions->where('type', 'in')->sum('amount');

        // Hitung Total Pengeluaran (type = 'out')
        $totalPengeluaran = $transactions->where('type', 'out')->sum('amount');

        // Hitung Saldo Saat Ini
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Ambil 5 transaksi terbaru
        $recentTransactions = Transaction::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('totalPemasukan', 'totalPengeluaran', 'saldo', 'recentTransactions'));
    }
}
