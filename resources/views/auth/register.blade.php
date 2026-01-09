<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Laporan Keuangan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white w-full max-w-4xl rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row-reverse">
        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Buat Akun</h2>
                <p class="text-gray-500 mt-2">Mulai kelola keuangan Anda hari ini</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Lengkap</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" id="name" type="text" name="name" required autofocus autocomplete="name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" id="email" type="email" name="email" required autocomplete="username">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" id="password" type="password" name="password" required autocomplete="new-password">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Konfirmasi Password</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>
                <button class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-700 transition duration-300" type="submit">
                    Daftar Sekarang
                </button>
            </form>
            <p class="text-center text-gray-600 text-sm mt-6">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline">Masuk</a>
            </p>
        </div>

        <!-- Visual Section -->
        <div class="w-full md:w-1/2 bg-green-600 p-12 flex flex-col items-center justify-center text-white">
            <svg class="w-48 h-48 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            <h3 class="text-2xl font-bold mb-2">Tumbuhkan Aset</h3>
            <p class="text-green-100 text-center">
                Pantau pertumbuhan finansial Anda dengan grafik yang mudah dipahami.
            </p>
        </div>
    </div>
        <!-- Animated Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <!-- Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-gray-100"></div>
        
        <!-- Grid Pattern -->
        <svg class="absolute w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="#cbd5e1" stroke-width="1" fill="none"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid-pattern)" />
        </svg>

        <!-- Floating Icons -->
        <div class="absolute top-0 left-0 w-full h-full">
            <!-- Koin (Kiri Atas) -->
            <div class="absolute top-1/4 left-10 animate-float-slow opacity-10">
                <svg class="w-32 h-32 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.736 6.979C9.208 6.193 9.912 6 10.5 6c1.414 0 2.5 1.086 2.5 2.5 0 1.414-1.086 2.5-2.5 2.5h-.5a1 1 0 110-2h.5c.276 0 .5-.224.5-.5s-.224-.5-.5-.5c-.588 0-1.292.193-1.764.979a1 1 0 01-1.714-1.029zm1.528 8.042c-.472.786-1.176.979-1.764.979-.276 0-.5-.224-.5-.5s.224-.5.5-.5h.5c1.414 0 2.5-1.086 2.5-2.5 0-1.414-1.086-2.5-2.5-2.5a1 1 0 010-2c.588 0 1.292.193 1.764.979a1 1 0 111.714 1.029c-.472-.786-1.176-.979-1.764-.979-.276 0-.5.224-.5.5s.224.5.5.5h-.5c-1.414 0-2.5 1.086-2.5 2.5 0 1.414 1.086 2.5 2.5 2.5h.5a1 1 0 010 2z" clip-rule="evenodd"/>
                </svg>
            </div>
            
            <!-- Grafik (Kanan Atas) -->
            <div class="absolute top-1/3 right-20 animate-float-medium opacity-10">
                <svg class="w-40 h-40 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zm6-4a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zm6-3a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
            </div>
            
            <!-- Dompet (Kiri Bawah) -->
            <div class="absolute bottom-1/4 left-1/3 animate-float-fast opacity-10">
                <svg class="w-24 h-24 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                </svg>
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

</body>
</html>