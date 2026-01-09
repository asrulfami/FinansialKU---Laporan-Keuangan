<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laporan Keuangan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
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
    <body class="font-sans text-gray-900 antialiased relative overflow-hidden bg-gradient-to-br from-gray-50 to-blue-50">
        <!-- Animated Background -->
        <div class="fixed inset-0 w-full h-full pointer-events-none z-0 overflow-hidden">
            <!-- Dollar Icon -->
            <svg class="floating-icon text-green-300 w-24 h-24 left-[10%]" style="animation-duration: 15s; animation-delay: 0s;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05 1.18 1.91 2.53 1.91 1.29 0 2.13-.72 2.13-1.71 0-1.12-.88-1.58-2.33-2.08l-.9-.33c-2.02-.7-3.27-1.7-3.27-3.56 0-1.87 1.45-3.09 3.14-3.47V3h2.67v1.93c1.5.25 2.9 1.25 2.99 3.12h-1.92c-.13-.91-1.13-1.56-2.37-1.56-1.16 0-1.92.64-1.92 1.58 0 1.1.81 1.51 2.11 1.96l.9.32c2.2.78 3.52 1.82 3.52 3.71 0 2.05-1.55 3.32-3.29 3.63z"/></svg>
            <!-- Chart Icon -->
            <svg class="floating-icon text-blue-300 w-32 h-32 left-[30%]" style="animation-duration: 20s; animation-delay: 2s;" fill="currentColor" viewBox="0 0 24 24"><path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/></svg>
            <!-- Pie Chart Icon -->
            <svg class="floating-icon text-indigo-300 w-20 h-20 left-[70%]" style="animation-duration: 18s; animation-delay: 5s;" fill="currentColor" viewBox="0 0 24 24"><path d="M11 2v20c-5.07-.5-9-4.79-9-10s3.93-9.5 9-10zm2.03 0v8.99H22c-.47-4.74-4.24-8.52-8.97-8.99zm0 11.01V22c4.74-.47 8.5-4.25 8.97-8.99h-8.97z"/></svg>
            <!-- Wallet/Card Icon -->
            <svg class="floating-icon text-purple-300 w-28 h-28 left-[50%]" style="animation-duration: 25s; animation-delay: 1s;" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
            <!-- Trending Up -->
            <svg class="floating-icon text-red-300 w-16 h-16 left-[85%]" style="animation-duration: 22s; animation-delay: 3s;" fill="currentColor" viewBox="0 0 24 24"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/></svg>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <div class="mb-6">
                <a href="/" class="flex items-center gap-2 text-3xl font-bold text-indigo-600 tracking-tight">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                    FinansialKu
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/90 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-2xl border border-gray-100">
                @yield('content')
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} Laporan Keuangan. All rights reserved.
            </div>
        </div>
    </body>
</html>
