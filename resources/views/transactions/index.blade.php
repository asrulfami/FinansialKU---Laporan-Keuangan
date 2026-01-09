@extends('layouts.app')

@section('title', 'Transaksi Keuangan')

@section('content')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @keyframes float {
            0% { transform: translateY(0px) rotate(12deg); }
            50% { transform: translateY(-20px) rotate(15deg); }
            100% { transform: translateY(0px) rotate(12deg); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
    <div class="max-w-4xl mx-auto relative">
        <!-- Background SVG Decoration -->
        <div class="absolute top-0 right-0 -mt-10 -mr-20 opacity-10 pointer-events-none z-0">
            <svg width="400" height="400" viewBox="0 0 24 24" fill="currentColor" class="text-indigo-600 transform rotate-12 animate-float">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05 1.18 1.91 2.53 1.91 1.29 0 2.13-.72 2.13-1.71 0-1.12-.88-1.58-2.33-2.08l-.9-.33c-2.02-.7-3.27-1.7-3.27-3.56 0-1.87 1.45-3.09 3.14-3.47V3h2.67v1.93c1.5.25 2.9 1.25 2.99 3.12h-1.92c-.13-.91-1.13-1.56-2.37-1.56-1.16 0-1.92.64-1.92 1.58 0 1.1.81 1.51 2.11 1.96l.9.32c2.2.78 3.52 1.82 3.52 3.71 0 2.05-1.55 3.32-3.29 3.63z"/>
            </svg>
        </div>

        <header class="flex items-center justify-between mb-6 relative z-10">
            <div>
                <h1 class="text-2xl font-semibold">Transaksi Keuangan</h1>
                <p class="text-sm text-gray-500">Ringkasan dan daftar transaksi Anda</p>
            </div>
            <div class="flex gap-2 items-center">
                @if(auth()->user()->role !== 'admin' || isset($viewingUser))
                <button onclick="exportTableToCSV('transaksi.csv')" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    Export Excel
                </button>
                @endif
                <a href="{{ route('transactions.exportPdf', request()->query()) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded shadow transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                    Export PDF
                </a>
                <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/></svg>
                    Tambah
                </a>
            </div>
        </header>

        <!-- Filter Tanggal -->
        <form method="GET" action="{{ route('transactions.index') }}" class="mb-6 flex flex-wrap gap-4 items-end bg-gray-50 p-4 rounded shadow-sm border border-gray-200">
            @if(request('user_id'))
                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
            @endif
            <div>
                <label class="block text-sm text-gray-600 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-3 py-2 border rounded text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-3 py-2 border rounded text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700 shadow">Filter</button>
            @if(request('start_date') || request('end_date'))
                <a href="{{ route('transactions.index', ['user_id' => request('user_id')]) }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded text-sm hover:bg-gray-400">Reset</a>
            @endif
        </form>

        @if(isset($viewingUser))
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded flex justify-between items-center">
            <div>
                <span class="text-blue-800 font-semibold">Sedang melihat detail transaksi: </span>
                <span class="font-bold text-gray-800">{{ $viewingUser->name }}</span>
            </div>
            <a href="{{ route('transactions.index') }}" class="text-sm text-blue-600 hover:underline">Tutup / Kembali ke Rekap</a>
        </div>
        @endif

        @if(auth()->user()->role !== 'admin' || isset($viewingUser))
        <section class="mb-4 grid grid-cols-2 gap-4">
            <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded shadow">
                <div class="text-sm text-green-600 font-semibold">Total Masuk</div>
                <div class="text-xl font-bold text-green-700">Rp {{ number_format($totalIn,2,',','.') }}</div>
            </div>
            <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded shadow">
                <div class="text-sm text-red-600 font-semibold">Total Keluar</div>
                <div class="text-xl font-bold text-red-700">Rp {{ number_format($totalOut,2,',','.') }}</div>
            </div>
        </section>

        <!-- Grafik Garis (Line Chart) -->
        <div class="bg-white p-6 rounded shadow mb-6 relative z-10">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Tren Pemasukan & Pengeluaran</h3>
            <canvas id="trendChart" height="100"></canvas>
        </div>

        <!-- Grafik Batang Sederhana -->
        @php
            $maxVal = max($totalIn, $totalOut);
            $heightIn = $maxVal > 0 ? ($totalIn / $maxVal) * 100 : 0;
            $heightOut = $maxVal > 0 ? ($totalOut / $maxVal) * 100 : 0;
        @endphp
        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Perbandingan Pemasukan vs Pengeluaran</h3>
            <div class="flex items-end h-48 space-x-12 px-8 border-b border-gray-200 pb-1">
                <!-- Bar Pemasukan -->
                <div class="w-1/2 flex flex-col justify-end items-center group h-full">
                    <div class="mb-2 text-green-700 font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">Rp {{ number_format($totalIn, 0, ',', '.') }}</div>
                    <div class="w-full bg-green-500 rounded-t hover:bg-green-600 transition-all duration-700 ease-out shadow-lg" style="height: {{ $heightIn }}%"></div>
                    <div class="mt-3 text-gray-600 font-medium">Pemasukan</div>
                </div>
                <!-- Bar Pengeluaran -->
                <div class="w-1/2 flex flex-col justify-end items-center group h-full">
                    <div class="mb-2 text-red-700 font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">Rp {{ number_format($totalOut, 0, ',', '.') }}</div>
                    <div class="w-full bg-red-500 rounded-t hover:bg-red-600 transition-all duration-700 ease-out shadow-lg" style="height: {{ $heightOut }}%"></div>
                    <div class="mt-3 text-gray-600 font-medium">Pengeluaran</div>
                </div>
            </div>
        </div>
        @endif

        @if(isset($userBalances) && count($userBalances) > 0)
        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Rekap Saldo User</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Nama User</th>
                            <th class="px-4 py-2">Total Masuk</th>
                            <th class="px-4 py-2">Total Keluar</th>
                            <th class="px-4 py-2">Saldo Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userBalances as $u)
                        <tr class="border-t hover:bg-gray-50 {{ isset($viewingUser) && $viewingUser->id == $u->id ? 'bg-blue-50' : '' }}">
                            <td class="px-4 py-2 font-medium">
                                <a href="{{ route('transactions.index', ['user_id' => $u->id]) }}" class="text-blue-600 hover:underline hover:text-blue-800">
                                    {{ $u->name }}
                                </a>
                            </td>
                            <td class="px-4 py-2 text-green-600">Rp {{ number_format($u->income ?? 0, 2, ',', '.') }}</td>
                            <td class="px-4 py-2 text-red-600">Rp {{ number_format($u->expense ?? 0, 2, ',', '.') }}</td>
                            <td class="px-4 py-2 font-bold text-gray-800">Rp {{ number_format(($u->income ?? 0) - ($u->expense ?? 0), 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if(auth()->user()->role !== 'admin' || isset($viewingUser))
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-left table-auto divide-y">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        @if(optional(auth()->user())->role === 'admin')
                            <th class="px-4 py-2">Pemilik</th>
                        @endif
                        <th class="px-4 py-2">Tipe</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2 no-export">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($transactions as $t)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ optional($t->date)->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">{{ $t->category }}</td>
                            <td class="px-4 py-2">{{ $t->description }}</td>
                            @if(optional(auth()->user())->role === 'admin')
                                <td class="px-4 py-2">{{ optional($t->user)->name ?? '-' }}</td>
                            @endif
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs rounded-full {{ $t->type == 'in' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $t->type == 'in' ? 'Masuk' : 'Keluar' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 font-medium {{ $t->type == 'in' ? 'text-green-600' : 'text-red-600' }}">Rp {{ number_format($t->amount,2,',','.') }}</td>
                            <td class="px-4 py-2 no-export">
                                <div class="flex gap-2">
                                    <a href="{{ route('transactions.edit', $t) }}" class="inline-flex items-center gap-2 px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">Edit</a>
                                    <form action="{{ route('transactions.destroy', $t) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex items-center gap-2 px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-6" colspan="7">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($transactions, 'links'))
            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        @endif
        @endif
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
                        pointRadius: 3,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($chartExpense),
                        borderColor: '#EF4444', // red-500
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 6
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
                    },
                    tooltip: {
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
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
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
    </script>
@endsection
