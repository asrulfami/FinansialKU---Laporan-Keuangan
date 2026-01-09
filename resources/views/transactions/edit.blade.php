<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    @include('partials.navbar')
    <div class="max-w-2xl mx-auto mt-6">
        <header class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">Edit Transaksi</h1>
            <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L4.414 9H18a1 1 0 110 2H4.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
                Kembali
            </a>
        </header>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('transactions.update', $transaction) }}" method="post" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm text-gray-600">Deskripsi</label>
                    <input name="description" class="w-full mt-1 px-3 py-2 border rounded" value="{{ old('description', $transaction->description) }}">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Jumlah</label>
                    <input name="amount" type="number" step="0.01" required class="w-full mt-1 px-3 py-2 border rounded" value="{{ old('amount', $transaction->amount) }}">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Kategori</label>
                    <input name="category" type="text" required class="w-full mt-1 px-3 py-2 border rounded" value="{{ old('category', $transaction->category) }}">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Tipe</label>
                    <select name="type" class="w-full mt-1 px-3 py-2 border rounded">
                        <option value="in" {{ old('type', $transaction->type) == 'in' ? 'selected' : '' }}>Masuk</option>
                        <option value="out" {{ old('type', $transaction->type) == 'out' ? 'selected' : '' }}>Keluar</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Tanggal</label>
                    <input name="date" type="date" class="w-full mt-1 px-3 py-2 border rounded" value="{{ old('date', optional($transaction->date)->format('Y-m-d')) }}">
                </div>
                <div class="flex justify-end">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
