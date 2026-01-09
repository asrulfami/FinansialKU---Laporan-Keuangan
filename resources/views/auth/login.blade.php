<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Laporan Keuangan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white w-full max-w-4xl rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Selamat Datang</h2>
                <p class="text-gray-500 mt-2">Silakan masuk ke akun Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" id="email" type="email" name="email" required autofocus autocomplete="username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" id="password" type="password" name="password" required autocomplete="current-password">
                </div>
                <div class="flex items-center justify-between mb-6">
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">Lupa Password?</a>
                </div>
                <button class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300" type="submit">
                    Masuk
                </button>
            </form>
            <p class="text-center text-gray-600 text-sm mt-6">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar</a>
            </p>
        </div>

        <!-- Visual Section -->
        <div class="w-full md:w-1/2 bg-blue-600 p-12 flex flex-col items-center justify-center text-white">
            <svg class="w-48 h-48 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h3 class="text-2xl font-bold mb-2">Aman & Terpercaya</h3>
            <p class="text-blue-100 text-center">
                Data keuangan Anda tersimpan dengan aman. Kelola aset Anda tanpa rasa khawatir.
            </p>
        </div>
    </div>
</body>
</html>