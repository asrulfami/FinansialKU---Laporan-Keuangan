<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report - {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    @include('partials.navbar')
    <div class="max-w-4xl mx-auto mt-6">
        <header class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">Laporan Keuangan: {{ $user->name }}</h1>
            <div class="flex gap-2">
                <button onclick="exportTableToCSV('laporan.csv')" class="inline-flex items-center gap-2 px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow-sm">
                    Export Excel
                </button>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L4.414 9H18a1 1 0 110 2H4.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
                    Kembali
                </a>
            </div>
        </header>

        <section class="mb-4 grid grid-cols-2 gap-4">
            <div class="p-4 bg-white rounded shadow">
                <div class="text-sm text-gray-500">Total Masuk</div>
                <div class="text-xl font-medium">Rp {{ number_format($totalIn,2,',','.') }}</div>
            </div>
            <div class="p-4 bg-white rounded shadow">
                <div class="text-sm text-gray-500">Total Keluar</div>
                <div class="text-xl font-medium">Rp {{ number_format($totalOut,2,',','.') }}</div>
            </div>
        </section>

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-left table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Tipe</th>
                        <th class="px-4 py-2">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $t)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ optional($t->date)->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">{{ $t->description }}</td>
                            <td class="px-4 py-2">{{ $t->type == 'in' ? 'Masuk' : 'Keluar' }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($t->amount,2,',','.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-6" colspan="4">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll("table tr");
            
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (var j = 0; j < cols.length; j++) {
                    var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, "").trim();
                    data = data.replace(/"/g, '""');
                    row.push('"' + data + '"');
                }
                
                csv.push(row.join(","));
            }

            var csvFile = new Blob([csv.join("\n")], {type: "text/csv"});
            var downloadLink = document.createElement("a");
            downloadLink.download = filename;
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
        }
    </script>
</body>
</html>
