<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    @include('partials.navbar')
    <div class="max-w-4xl mx-auto mt-6">
        <h1 class="text-2xl font-semibold mb-4">Admin Dashboard</h1>
        <p class="mb-4">Halaman ini hanya dapat diakses oleh admin.</p>
        <div class="flex gap-2">
            <a href="{{ route('transactions.index') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Kelola Transaksi</a>
            <a href="{{ route('admin.users.index') }}" class="px-3 py-2 bg-gray-700 text-white rounded">Manajemen User</a>
        </div>
    </div>
</body>
</html>
