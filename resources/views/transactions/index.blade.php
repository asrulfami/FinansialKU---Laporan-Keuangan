@extends('layouts.app')

@section('title', 'Transaksi Keuangan')

@section('content')
    <!-- Animated Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-gray-100"></div>
        <svg class="absolute w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="#cbd5e1" stroke-width="1" fill="none"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid-pattern)" />
        </svg>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-1/4 left-10 animate-float-slow opacity-10">
                <svg class="w-32 h-32 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.736 6.979C9.208 6.193 9.912 6 10.5 6c1.414 0 2.5 1.086 2.5 2.5 0 1.414-1.086 2.5-2.5 2.5h-.5a1 1 0 110-2h.5c.276 0 .5-.224.5-.5s-.224-.5-.5-.5c-.588 0-1.292.193-1.764.979a1 1 0 01-1.714-1.029zm1.528 8.042c-.472.786-1.176.979-1.764.979-.276 0-.5-.224-.5-.5s.224-.5.5-.5h.5c1.414 0 2.5-1.086 2.5-2.5 0-1.414-1.086-2.5-2.5-2.5a1 1 0 010-2c.588 0 1.292.193 1.764.979a1 1 0 111.714 1.029c-.472-.786-1.176-.979-1.764-.979-.276 0-.5.224-.5.5s.224.5.5.5h-.5c-1.414 0-2.5 1.086-2.5 2.5 0 1.414 1.086 2.5 2.5 2.5h.5a1 1 0 010 2z" clip-rule="evenodd"/></svg>
            </div>
            <div class="absolute top-1/3 right-20 animate-float-medium opacity-10">
                <svg class="w-40 h-40 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zm6-4a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zm6-3a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/></svg>
            </div>
            <div class="absolute bottom-1/4 left-1/3 animate-float-fast opacity-10">
                <svg class="w-24 h-24 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" /><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" /></svg>
            </div>
        </div>
    </div>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .animate-float-slow { animation: float 8s ease-in-out infinite; }
        .animate-float-medium { animation: float 6s ease-in-out infinite; }
        .animate-float-fast { animation: float 4s ease-in-out infinite; }
    </style>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="max-w-7xl mx-auto space-y-8">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Transaksi Keuangan</h1>
                <p class="text-gray-500 mt-1">Kelola dan pantau riwayat keuangan Anda.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                @if(auth()->user()->role !== 'admin' || isset($viewingUser))
                <button onclick="exportTableToCSV('transaksi.csv')" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl shadow-sm hover:bg-gray-50 hover:text-gray-900 transition-all text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    Excel
                </button>
                @endif
                <a href="{{ route('transactions.exportPdf', request()->query()) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl shadow-sm hover:bg-gray-50 hover:text-gray-900 transition-all text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                    PDF
                </a>
                <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow-md hover:shadow-lg transition-all text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/></svg>
                    Tambah Baru
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <form method="GET" action="{{ route('transactions.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                @if(request('user_id'))
                    <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                @endif
                
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pencarian</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari deskripsi..." class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</label>
                    <select name="category" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Rentang Tanggal</label>
                    <div class="flex gap-2">
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-gray-900 hover:bg-gray-800 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition shadow-sm">
                        Terapkan
                    </button>
                    @if(request()->anyFilled(['search', 'category', 'start_date', 'end_date', 'min_amount', 'max_amount']))
                        <a href="{{ route('transactions.index', ['user_id' => request('user_id')]) }}" class="px-4 py-2.5 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded-lg text-sm font-medium transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if(isset($viewingUser))
        <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl flex justify-between items-center text-blue-800">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                <span>Menampilkan data untuk: <strong>{{ $viewingUser->name }}</strong></span>
            </div>
            <a href="{{ route('transactions.index') }}" class="text-sm font-medium hover:underline">Kembali ke Semua</a>
        </div>
        @endif

        @if(auth()->user()->role !== 'admin' || isset($viewingUser))
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pemasukan</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($totalIn, 2, ',', '.') }}</p>
                    </div>
                    <div class="p-3 bg-green-50 rounded-full text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-red-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pengeluaran</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($totalOut, 2, ',', '.') }}</p>
                    </div>
                    <div class="p-3 bg-red-50 rounded-full text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Tren Keuangan</h3>
                <div class="h-64">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Rasio</h3>
                @php
                    $maxVal = max($totalIn, $totalOut);
                    $heightIn = $maxVal > 0 ? ($totalIn / $maxVal) * 100 : 0;
                    $heightOut = $maxVal > 0 ? ($totalOut / $maxVal) * 100 : 0;
                @endphp
                <div class="flex items-end justify-center h-56 gap-8 pb-4">
                    <div class="flex flex-col items-center group w-16">
                        <div class="mb-2 text-xs font-bold text-green-600 opacity-0 group-hover:opacity-100 transition-opacity">
                            {{ number_format($totalIn, 0, ',', '.') }}
                        </div>
                        <div class="w-full bg-green-500 rounded-t-lg shadow-lg hover:bg-green-400 transition-all duration-500 relative" style="height: {{ $heightIn }}%"></div>
                        <span class="mt-3 text-sm font-medium text-gray-600">Masuk</span>
                    </div>
                    <div class="flex flex-col items-center group w-16">
                        <div class="mb-2 text-xs font-bold text-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                            {{ number_format($totalOut, 0, ',', '.') }}
                        </div>
                        <div class="w-full bg-red-500 rounded-t-lg shadow-lg hover:bg-red-400 transition-all duration-500 relative" style="height: {{ $heightOut }}%"></div>
                        <span class="mt-3 text-sm font-medium text-gray-600">Keluar</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(isset($userBalances) && count($userBalances) > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Rekap Saldo User</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nama User</th>
                            <th class="px-6 py-4 font-semibold">Total Masuk</th>
                            <th class="px-6 py-4 font-semibold">Total Keluar</th>
                            <th class="px-6 py-4 font-semibold">Saldo Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($userBalances as $u)
                        <tr class="hover:bg-gray-50 transition {{ isset($viewingUser) && $viewingUser->id == $u->id ? 'bg-blue-50' : '' }}">
                            <td class="px-6 py-4 font-medium">
                                <a href="{{ route('transactions.index', ['user_id' => $u->id]) }}" class="text-indigo-600 hover:text-indigo-800 hover:underline">
                                    {{ $u->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-green-600">Rp {{ number_format($u->income ?? 0, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 text-red-600">Rp {{ number_format($u->expense ?? 0, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 font-bold text-gray-800">Rp {{ number_format(($u->income ?? 0) - ($u->expense ?? 0), 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if(auth()->user()->role !== 'admin' || isset($viewingUser))
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-semibold">
                            <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'date', 'sort_order' => (request('sort_by', 'date') == 'date' && request('sort_order', 'desc') == 'desc') ? 'asc' : 'desc']) }}" class="flex items-center gap-1 hover:text-gray-700">
                                Tanggal
                                @if(request('sort_by', 'date') == 'date')
                                    <span class="text-indigo-500">{{ request('sort_order', 'desc') == 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-4 font-semibold">Kategori</th>
                        <th class="px-6 py-4 font-semibold">Deskripsi</th>
                        @if(optional(auth()->user())->role === 'admin')
                            <th class="px-6 py-4 font-semibold">Pemilik</th>
                        @endif
                        <th class="px-6 py-4 font-semibold">Tipe</th>
                        <th class="px-6 py-4 font-semibold text-right">
                            <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'amount', 'sort_order' => (request('sort_by') == 'amount' && request('sort_order') == 'desc') ? 'asc' : 'desc']) }}" class="flex items-center justify-end gap-1 hover:text-gray-700">
                                Jumlah
                                @if(request('sort_by') == 'amount')
                                    <span class="text-indigo-500">{{ request('sort_order') == 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-4 font-semibold text-center no-export">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($transactions as $t)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ optional($t->date)->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $t->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $t->description }}">{{ $t->description }}</td>
                            @if(optional(auth()->user())->role === 'admin')
                                <td class="px-6 py-4 text-sm text-gray-600">{{ optional($t->user)->name ?? '-' }}</td>
                            @endif
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $t->type == 'in' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $t->type == 'in' ? 'Masuk' : 'Keluar' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-right font-bold {{ $t->type == 'in' ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($t->amount, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center no-export">
                                <div class="flex justify-center gap-2">
                                    <button type="button" data-url="{{ route('transactions.show', $t) }}" class="view-transaction-btn p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                                    </button>
                                    <a href="{{ route('transactions.edit', $t) }}" class="p-1.5 text-yellow-600 hover:bg-yellow-50 rounded-lg transition" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" /></svg>
                                    </a>
                                    <form action="{{ route('transactions.destroy', $t) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-12 text-center text-gray-500" colspan="7">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    <p>Belum ada data transaksi yang ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($transactions, 'links'))
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $transactions->links() }}
            </div>
        @endif
        @endif
    </div>

    <!-- Modal Detail Transaksi -->
    <div id="transactionModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-50 backdrop-blur-sm" aria-hidden="true" onclick="closeModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-6 pt-6 pb-4 bg-white">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-xl font-bold leading-6 text-gray-900 mb-6" id="modal-title">Detail Transaksi</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between border-b border-gray-100 pb-3">
                                    <span class="text-sm text-gray-500">Tanggal</span>
                                    <span class="text-sm font-medium text-gray-900" id="modal-date">-</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-3">
                                    <span class="text-sm text-gray-500">Kategori</span>
                                    <span class="text-sm font-medium text-gray-900" id="modal-category">-</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-3">
                                    <span class="text-sm text-gray-500">Tipe</span>
                                    <span class="text-sm font-bold" id="modal-type">-</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-3">
                                    <span class="text-sm text-gray-500">Jumlah</span>
                                    <span class="text-lg font-bold text-gray-900" id="modal-amount">-</span>
                                </div>
                                <div class="pt-2">
                                    <span class="block text-sm text-gray-500 mb-1">Deskripsi</span>
                                    <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-lg" id="modal-description">-</p>
                                </div>
                                <div class="hidden pt-2" id="modal-user-row">
                                    <span class="block text-sm text-gray-500 mb-1">User</span>
                                    <p class="text-sm font-medium text-gray-900" id="modal-user">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex flex-row-reverse">
                    <button type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-xl shadow-sm hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition" onclick="closeModal()">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi Chart.js
        const ctx = document.getElementById('trendChart').getContext('2d');
        const trendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartDates),
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: @json($chartIncome),
                        borderColor: '#10B981', // green-500
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 2,
                        tension: 0.4, // Membuat garis melengkung halus
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#10B981'
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($chartExpense),
                        borderColor: '#EF4444', // red-500
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,                     
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#EF4444'
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8,
                            font: { family: "'Figtree', sans-serif", size: 12 }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#1f2937',
                        bodyColor: '#4b5563',
                        borderColor: '#e5e7eb',
                        borderWidth: 1,
                        padding: 10,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'Figtree', sans-serif" } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [2, 4], color: '#f3f4f6' },
                        ticks: {
                            font: { family: "'Figtree', sans-serif" },
                            callback: function(value) {
                                return new Intl.NumberFormat('id-ID', { notation: "compact", compactDisplay: "short" }).format(value);
                            }
                        }
                    }
                }
            }
        });

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll("table tr");
            
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (var j = 0; j < cols.length; j++) {
                    if (cols[j].classList.contains('no-export')) continue;
                    var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, "").trim();
                    data = data.replace(/"/g, '""');
                    row.push('"' + data + '"');
                }
                
                csv.push(row.join(","));
            }

            var csvFile = new Blob([csv.join("\n")], {type: "text/csv"});
            var downloadLink = document.createElement("a");
            downloadLink.download = filename;
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
        }

        // Modal Logic
        function closeModal() {
            document.getElementById('transactionModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.view-transaction-btn');
            const modal = document.getElementById('transactionModal');
            
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    
                    // Reset data loading
                    document.getElementById('modal-date').textContent = 'Memuat...';
                    document.getElementById('modal-category').textContent = '...';
                    document.getElementById('modal-amount').textContent = '...';
                    
                    modal.classList.remove('hidden');

                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modal-date').textContent = data.date;
                        document.getElementById('modal-category').textContent = data.category;
                        document.getElementById('modal-amount').textContent = 'Rp ' + data.amount;
                        document.getElementById('modal-description').textContent = data.description;
                        
                        const typeEl = document.getElementById('modal-type');
                        typeEl.textContent = data.type;
                        typeEl.className = data.type === 'Pemasukan' ? 'text-sm font-bold text-green-600' : 'text-sm font-bold text-red-600';

                        const userRow = document.getElementById('modal-user-row');
                        if (data.user_name) {
                            document.getElementById('modal-user').textContent = data.user_name;
                            userRow.classList.remove('hidden');
                        } else {
                            userRow.classList.add('hidden');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
@endsection
