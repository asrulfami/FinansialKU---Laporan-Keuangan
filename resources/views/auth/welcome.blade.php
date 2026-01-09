<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-bold text-xl text-gray-900">FinansialKu</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Masuk</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium">Daftar</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                        Kelola Keuangan Anda <br> <span class="text-blue-600">Lebih Efisien</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        Pantau pemasukan dan pengeluaran harian Anda dengan mudah. Dapatkan wawasan visual tentang kesehatan finansial Anda.
                    </p>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 shadow-lg transition duration-150 ease-in-out">
                        Mulai Sekarang
                    </a>
                </div>
                <div class="flex justify-center">
                    <!-- Financial Illustration SVG -->
                    <svg class="w-full max-w-md h-auto text-blue-100" viewBox="0 0 400 300" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <rect x="50" y="200" width="40" height="100" class="text-blue-300" rx="4" />
                        <rect x="110" y="150" width="40" height="150" class="text-blue-400" rx="4" />
                        <rect x="170" y="180" width="40" height="120" class="text-blue-300" rx="4" />
                        <rect x="230" y="100" width="40" height="200" class="text-blue-500" rx="4" />
                        <rect x="290" y="60" width="40" height="240" class="text-blue-600" rx="4" />
                        <path d="M50 190 L110 140 L170 170 L230 90 L310 50" stroke="#2563EB" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="310" cy="50" r="6" class="text-blue-700" />
                    </svg>
                </div>
            </div>
        </main>
    </div>
</body>
</html>