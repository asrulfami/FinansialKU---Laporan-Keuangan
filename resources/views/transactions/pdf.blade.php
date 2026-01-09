<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { margin-bottom: 20px; }
        .summary { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Keuangan</h2>
        <p>User: {{ $targetUser->name ?? 'Semua User' }}</p>
        @if(isset($startDate) || isset($endDate))
        <p>Periode: {{ $startDate ? date('d-m-Y', strtotime($startDate)) : 'Awal' }} s/d {{ $endDate ? date('d-m-Y', strtotime($endDate)) : 'Sekarang' }}</p>
        @endif
        <p>Tanggal Cetak: {{ date('d-m-Y H:i') }}</p>
    </div>
    
    <div class="summary">
        <strong>Ringkasan:</strong><br>
        Total Pemasukan: Rp {{ number_format($totalIn, 0, ',', '.') }}<br>
        Total Pengeluaran: Rp {{ number_format($totalOut, 0, ',', '.') }}<br>
        Saldo Akhir: Rp {{ number_format($currentBalance, 0, ',', '.') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                @if(!$targetUser)
                <th>User</th>
                @endif
                <th>Deskripsi</th>
                <th>Tipe</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->date ? $transaction->date->format('d-m-Y') : '-' }}</td>
                @if(!$targetUser)
                <td>{{ $transaction->user->name ?? '-' }}</td>
                @endif
                <td>{{ $transaction->description }}</td>
                <td>{{ $transaction->type == 'in' ? 'Pemasukan' : 'Pengeluaran' }}</td>
                <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
