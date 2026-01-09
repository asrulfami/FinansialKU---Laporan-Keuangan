<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-white p-8 font-sans text-gray-900">
    
    <div class="max-w-4xl mx-auto">
        <!-- Header Laporan -->
        <div class="text-center mb-8 border-b-2 border-gray-800 pb-4">
            <h1 class="text-3xl font-bold uppercase tracking-wide">Laporan Keuangan</h1>
            <p class="text-gray-600 mt-1">FinansialKu - Kelola Keuangan Lebih Efisien</p>
            <p class="text-sm text-gray-500 mt-2">Dicetak pada: {{ now()->translatedFormat('l, d F Y H:i') }}</p>
            <p class="text-sm text-gray-500">Oleh: {{ auth()->user()->name }}</p>
        </div>

        <!-- Ringkasan -->
        <div class="grid grid-cols-3 gap-4 mb-8 text-center">
            <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                <h3 class="text-sm font-semibold text-green-800 uppercase">Total Pemasukan</h3>
                <p class="text-xl font-bold text-green-700">Rp {{ number_format($transactions->where('type', 'in')->sum('amount'), 0, ',', '.') }}</p>
            </div>
            <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                <h3 class="text-sm font-semibold text-red-800 uppercase">Total Pengeluaran</h3>
                <p class="text-xl font-bold text-red-700">Rp {{ number_format($transactions->where('type', 'out')->sum('amount'), 0, ',', '.') }}</p>
            </div>
            <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <h3 class="text-sm font-semibold text-blue-800 uppercase">Saldo Akhir</h3>
                <p class="text-xl font-bold text-blue-700">Rp {{ number_format($transactions->where('type', 'in')->sum('amount') - $transactions->where('type', 'out')->sum('amount'), 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Tanggal</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Kategori</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Keterangan</th>
                    <th class="border border-gray-300 px-4 py-2 text-right">Masuk (Rp)</th>
                    <th class="border border-gray-300 px-4 py-2 text-right">Keluar (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $t)
                <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="border border-gray-300 px-4 py-2">{{ $t->date->format('d/m/Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $t->category }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $t->description }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right text-green-600 font-medium">
                        {{ $t->type == 'in' ? number_format($t->amount, 0, ',', '.') : '-' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-right text-red-600 font-medium">
                        {{ $t->type == 'out' ? number_format($t->amount, 0, ',', '.') : '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tombol Cetak (Hanya muncul di layar) -->
        <div class="mt-8 text-center no-print">
            <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700 transition">Cetak / Simpan PDF</button>
        </div>
    </div>
</body>
</html>