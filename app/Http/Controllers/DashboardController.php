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

        // Buat Query Builder dasar
        $query = Transaction::where('user_id', $userId);

        // Ambil semua transaksi user
        $transactions = (clone $query)->get();

        // Hitung Total Pemasukan (type = 'in')
        $totalPemasukan = $transactions->where('type', 'in')->sum('amount');

        // Hitung Total Pengeluaran (type = 'out')
        $totalPengeluaran = $transactions->where('type', 'out')->sum('amount');

        // Hitung Saldo Saat Ini
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Ambil 5 transaksi terbaru
        $recentTransactions = (clone $query)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('totalPemasukan', 'totalPengeluaran', 'saldo', 'recentTransactions'));
    }
}
