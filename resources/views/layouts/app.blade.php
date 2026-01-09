<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FinansialKu')</title>

    {{-- Memuat aset CSS dan JS melalui Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center gap-2">
                        <div class="bg-blue-600 text-white p-1.5 rounded-lg shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.66 2.691.66 3.842 0l.879-.659m-6.182-1.318a2.25 2.25 0 01-2.25-2.25V6m0 0c0-1.242 1.008-2.25 2.25-2.25h6c1.242 0 2.25 1.008 2.25 2.25v6.75a2.25 2.25 0 01-2.25 2.25" />
                            </svg>
                        </div>
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 tracking-tight">Finansial<span class="text-blue-600">Ku</span></a>
                    </div>
                    <!-- Desktop Menu -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-blue-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Dashboard</a>
                        <a href="{{ route('transactions.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('transactions.*') ? 'border-blue-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Transaksi</a>
                    </div>
                </div>
                <!-- User Menu -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">Halo, <span class="font-semibold text-gray-800">{{ auth()->user()->name ?? 'User' }}</span></span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">Logout</button>
                        </form>
                    </div>
                </div>
                <!-- Mobile Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="hidden sm:hidden bg-white border-t border-gray-200" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">Dashboard</a>
                <a href="{{ route('transactions.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('transactions.*') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">Transaksi</a>
            </div>
            <div class="pt-4 pb-4 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ auth()->user()->name ?? 'User' }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email ?? '' }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out">Logout</button>
                    </form>
                </div>
            </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-center">
        {{-- Konten utama akan di-render di sini --}}
        @yield('content')
    </main>
</body>
</html>