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
</body>
</html>