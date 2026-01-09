<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Keuangan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        @keyframes float {
            0% { transform: translateY(120vh) scale(0.8) rotate(0deg); opacity: 0; }
            10% { opacity: 0.4; }
            90% { opacity: 0.4; }
            100% { transform: translateY(-20vh) scale(1.2) rotate(360deg); opacity: 0; }
        }
        .floating-icon {
            position: absolute;
            bottom: -20vh;
            animation: float infinite linear;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-gray-50 to-blue-50 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="fixed inset-0 w-full h-full pointer-events-none z-0 overflow-hidden">
        <svg class="floating-icon text-green-300 w-24 h-24 left-[10%]" style="animation-duration: 15s; animation-delay: 0s;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05 1.18 1.91 2.53 1.91 1.29 0 2.13-.72 2.13-1.71 0-1.12-.88-1.58-2.33-2.08l-.9-.33c-2.02-.7-3.27-1.7-3.27-3.56 0-1.87 1.45-3.09 3.14-3.47V3h2.67v1.93c1.5.25 2.9 1.25 2.99 3.12h-1.92c-.13-.91-1.13-1.56-2.37-1.56-1.16 0-1.92.64-1.92 1.58 0 1.1.81 1.51 2.11 1.96l.9.32c2.2.78 3.52 1.82 3.52 3.71 0 2.05-1.55 3.32-3.29 3.63z"/></svg>
        <svg class="floating-icon text-blue-300 w-32 h-32 left-[30%]" style="animation-duration: 20s; animation-delay: 2s;" fill="currentColor" viewBox="0 0 24 24"><path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/></svg>
        <svg class="floating-icon text-indigo-300 w-20 h-20 left-[70%]" style="animation-duration: 18s; animation-delay: 5s;" fill="currentColor" viewBox="0 0 24 24"><path d="M11 2v20c-5.07-.5-9-4.79-9-10s3.93-9.5 9-10zm2.03 0v8.99H22c-.47-4.74-4.24-8.52-8.97-8.99zm0 11.01V22c4.74-.47 8.5-4.25 8.97-8.99h-8.97z"/></svg>
        <svg class="floating-icon text-purple-300 w-28 h-28 left-[50%]" style="animation-duration: 25s; animation-delay: 1s;" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
        <svg class="floating-icon text-red-300 w-16 h-16 left-[85%]" style="animation-duration: 22s; animation-delay: 3s;" fill="currentColor" viewBox="0 0 24 24"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/></svg>
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

    <div class="relative min-h-screen flex flex-col justify-center py-6 sm:py-12 z-10">
        <div class="relative bg-white/90 backdrop-blur-sm px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="mx-auto max-w-md">
                <div class="flex items-center gap-3 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                    <h1 class="text-2xl font-bold text-gray-900">FinansialKu</h1>
                </div>
                <div class="divide-y divide-gray-300/50">
                    <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
                        <p class="text-lg font-medium text-gray-900">Kelola keuangan Anda dengan mudah.</p>
                        <p>Aplikasi pencatatan keuangan sederhana untuk memantau pemasukan dan pengeluaran harian Anda secara efisien.</p>
                    </div>
                    <div class="pt-8 text-base font-semibold leading-7">
                        @if (Route::has('login'))
                            <div class="flex flex-col gap-4">
                                @auth
                                    <a href="{{ url('/transactions') }}" class="w-full text-center rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="w-full text-center rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                                        Masuk (Login)
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="w-full text-center rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-indigo-600 shadow-sm ring-1 ring-inset ring-indigo-200 hover:bg-gray-50 transition">
                                            Daftar Akun Baru
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
