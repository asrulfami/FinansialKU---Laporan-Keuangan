<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laporan Keuangan</title>
    @vite('resources/css/app.css')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        @keyframes moveHorizontal {
            0% { transform: translateX(-150px) rotate(0deg); opacity: 0; }
            10% { opacity: 0.5; }
            90% { opacity: 0.5; }
            100% { transform: translateX(calc(100% + 150px)) rotate(360deg); opacity: 0; }
        }
        @keyframes moveVertical {
            0% { transform: translateY(-150px) rotate(0deg); opacity: 0; }
            10% { opacity: 0.5; }
            90% { opacity: 0.5; }
            100% { transform: translateY(calc(100% + 150px)) rotate(360deg); opacity: 0; }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-move-h { animation: moveHorizontal 15s linear infinite; }
        .animate-move-v { animation: moveVertical 15s linear infinite; }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-600 flex items-center">
                    <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    FinansialKu
                </h1>
            </div>
            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 bg-blue-50 text-blue-700 border-r-4 border-blue-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('transactions.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Transaksi
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-8 relative">
            <!-- Background Decoration -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
                <!-- Koin (Kiri ke Kanan) -->
                <div class="absolute top-1/4 left-0 animate-move-h">
                    <svg class="w-32 h-32 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.736 6.979C9.208 6.193 9.912 6 10.5 6c1.414 0 2.5 1.086 2.5 2.5 0 1.414-1.086 2.5-2.5 2.5h-.5a1 1 0 110-2h.5c.276 0 .5-.224.5-.5s-.224-.5-.5-.5c-.588 0-1.292.193-1.764.979a1 1 0 01-1.714-1.029zm1.528 8.042c-.472.786-1.176.979-1.764.979-.276 0-.5-.224-.5-.5s.224-.5.5-.5h.5c1.414 0 2.5-1.086 2.5-2.5 0-1.414-1.086-2.5-2.5-2.5a1 1 0 010-2c.588 0 1.292.193 1.764.979a1 1 0 111.714 1.029c-.472-.786-1.176-.979-1.764-.979-.276 0-.5.224-.5.5s.224.5.5.5h-.5c-1.414 0-2.5 1.086-2.5 2.5 0 1.414 1.086 2.5 2.5 2.5h.5a1 1 0 010 2z" clip-rule="evenodd"/></svg>
                </div>
                <!-- Grafik (Atas ke Bawah) -->
                <div class="absolute top-0 right-1/4 animate-move-v" style="animation-delay: 5s;">
                    <svg class="w-40 h-40 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zm6-4a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zm6-3a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/></svg>
                </div>
                <!-- Dompet (Kiri ke Kanan, delay) -->
                <div class="absolute bottom-1/3 left-0 animate-move-h" style="animation-delay: 7s;">
                    <svg class="w-24 h-24 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" /><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" /></svg>
                </div>
                 <!-- Uang (Atas ke Bawah, delay) -->
                <div class="absolute top-0 left-1/3 animate-move-v" style="animation-delay: 2s;">
                    <svg class="w-28 h-28 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05 1.18 1.91 2.53 1.91 1.29 0 2.13-.72 2.13-1.71 0-1.12-.88-1.58-2.33-2.08l-.9-.33c-2.02-.7-3.27-1.7-3.27-3.56 0-1.87 1.45-3.09 3.14-3.47V3h2.67v1.93c1.5.25 2.9 1.25 2.99 3.12h-1.92c-.13-.91-1.13-1.56-2.37-1.56-1.16 0-1.92.64-1.92 1.58 0 1.1.81 1.51 2.11 1.96l.9.32c2.2.78 3.52 1.82 3.52 3.71 0 2.05-1.55 3.32-3.29 3.63z"/></svg>
                </div>
            </div>

            <div class="relative z-10">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Ringkasan Keuangan</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Keluar</button>
                </form>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Saldo Card -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Saldo</p>
                        <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Pemasukan Card -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Pemasukan</p>
                        <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($total_pemasukan ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Pengeluaran Card -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500 flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Pengeluaran</p>
                        <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($total_pengeluaran ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Placeholder for Chart or Recent Transactions -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Perbandingan Pemasukan vs Pengeluaran</h3>
                <div class="h-64">
                    <canvas id="incomeExpenseChart"></canvas>
                </div>
            </div>
            </div>
        </main>
    </div>

    <script>
        const ctx = document.getElementById('incomeExpenseChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    data: [{{ $total_pemasukan ?? 0 }}, {{ $total_pengeluaran ?? 0 }}],
                    backgroundColor: ['#10B981', '#EF4444'], // Hijau (Green-500) & Merah (Red-500)
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
</body>
</html>