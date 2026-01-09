@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Animated Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <!-- Grid Pattern -->
        <svg class="absolute w-full h-full opacity-[0.02]" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="currentColor" stroke-width="1" fill="none" class="text-gray-900"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid-pattern)" />
        </svg>

        <!-- Floating Icons -->
        <div class="absolute top-1/4 left-10 animate-move-h opacity-0">
            <svg class="w-32 h-32 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.736 6.979C9.208 6.193 9.912 6 10.5 6c1.414 0 2.5 1.086 2.5 2.5 0 1.414-1.086 2.5-2.5 2.5h-.5a1 1 0 110-2h.5c.276 0 .5-.224.5-.5s-.224-.5-.5-.5c-.588 0-1.292.193-1.764.979a1 1 0 01-1.714-1.029zm1.528 8.042c-.472.786-1.176.979-1.764.979-.276 0-.5-.224-.5-.5s.224-.5.5-.5h.5c1.414 0 2.5-1.086 2.5-2.5 0-1.414-1.086-2.5-2.5-2.5a1 1 0 010-2c.588 0 1.292.193 1.764.979a1 1 0 111.714 1.029c-.472-.786-1.176-.979-1.764-.979-.276 0-.5.224-.5.5s.224.5.5.5h-.5c-1.414 0-2.5 1.086-2.5 2.5 0 1.414 1.086 2.5 2.5 2.5h.5a1 1 0 010 2z" clip-rule="evenodd"/></svg>
        </div>
        <div class="absolute top-10 right-1/4 animate-move-v opacity-0" style="animation-delay: 2s;">
            <svg class="w-40 h-40 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zm6-4a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zm6-3a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/></svg>
        </div>
        <div class="absolute bottom-1/3 left-1/3 animate-move-h opacity-0" style="animation-delay: 5s;">
            <svg class="w-24 h-24 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" /><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" /></svg>
        </div>
    </div>

    <style>
        @keyframes moveHorizontal {
            0% { transform: translateX(-100%) rotate(0deg); opacity: 0; }
            10% { opacity: 0.1; }
            90% { opacity: 0.1; }
            100% { transform: translateX(100vw) rotate(360deg); opacity: 0; }
        }
        @keyframes moveVertical {
            0% { transform: translateY(-100%) rotate(0deg); opacity: 0; }
            10% { opacity: 0.1; }
            90% { opacity: 0.1; }
            100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
        }
        .animate-move-h { animation: moveHorizontal 20s linear infinite; }
        .animate-move-v { animation: moveVertical 25s linear infinite; }
    </style>

<div class="space-y-6 relative z-10">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">Ringkasan Keuangan</h2>
        <span class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</span>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card Pemasukan -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
            <span class="text-sm font-medium text-gray-500 mb-1">Total Pemasukan</span>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-100 text-green-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Card Pengeluaran -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
            <span class="text-sm font-medium text-gray-500 mb-1">Total Pengeluaran</span>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-red-100 text-red-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Card Saldo -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-2xl shadow-lg text-white flex flex-col">
            <span class="text-blue-100 text-sm font-medium mb-1">Saldo Saat Ini</span>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold">Rp {{ number_format($saldo, 0, ',', '.') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi Terbaru -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Riwayat Transaksi Terbaru</h3>
            <a href="{{ route('transactions.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentTransactions as $transaction)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $transaction->date->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $transaction->category }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($transaction->description, 40) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold {{ $transaction->type == 'in' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type == 'in' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada transaksi terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
