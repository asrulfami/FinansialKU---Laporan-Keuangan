<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laporan Keuangan</title>
    @vite('resources/css/app.css')
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
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
            <div class="absolute top-0 right-0 -mt-10 -mr-10 opacity-10 pointer-events-none z-0">
                <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="text-blue-500 fill-current animate-float">
                    <path d="M45.7,-76.3C58.9,-69.3,69.1,-55.8,76.3,-41.3C83.5,-26.9,87.7,-11.5,85.8,3.1C83.9,17.7,75.9,31.5,66.3,43.6C56.7,55.7,45.5,66.1,32.6,72.6C19.7,79.1,5.1,81.7,-8.6,79.8C-22.3,77.9,-35.1,71.5,-46.8,63.1C-58.5,54.7,-69.1,44.3,-76.3,31.7C-83.5,19.1,-87.3,4.3,-84.8,-9.4C-82.3,-23.1,-73.5,-35.7,-62.9,-45.3C-52.3,-54.9,-39.9,-61.5,-27.4,-68.8C-14.9,-76.1,-2.3,-84.1,11.7,-82.1C25.7,-80.1,51.4,-68.1,45.7,-76.3Z" transform="translate(100 100)" />
                </svg>
            </div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 opacity-5 pointer-events-none z-0">
                <svg width="500" height="500" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="text-green-500 fill-current animate-float" style="animation-delay: 3s;">
                    <path d="M41.3,-72.8C53.5,-64.4,63.4,-53.2,71.3,-40.8C79.2,-28.4,85.1,-14.8,83.9,-1.8C82.7,11.2,74.4,23.6,65.1,34.8C55.8,46,45.5,56,33.9,62.9C22.3,69.8,9.4,73.6,-2.8,78.5C-15,83.3,-26.5,89.2,-36.9,83.8C-47.3,78.4,-56.6,61.7,-64.3,46.8C-72,31.9,-78.1,18.8,-77.8,5.9C-77.5,-7,-70.8,-19.7,-61.8,-30.3C-52.8,-40.9,-41.5,-49.4,-30.3,-58.3C-19.1,-67.2,-8,-76.5,4.8,-84.8C17.6,-93.1,35.2,-100.4,41.3,-72.8Z" transform="translate(100 100)" />
                </svg>
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
            <div class="bg-white rounded-xl shadow-sm p-8 flex flex-col items-center justify-center text-center h-64">
                <svg class="w-20 h-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                <p class="text-gray-500">Grafik aktivitas keuangan akan muncul di sini.</p>
            </div>
            </div>
        </main>
    </div>
</body>
</html>