<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    @include('partials.navbar')
    <div class="max-w-4xl mx-auto mt-6">
        <header class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold">Manajemen User</h1>
                <p class="text-sm text-gray-500">Kelola akun pengguna dan peran</p>
            </div>
            <div class="flex gap-2">
                <button onclick="exportTableToCSV('users.csv')" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow">
                    Export Excel
                </button>
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
                    Tambah User
                </a>
            </div>
        </header>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-left table-auto divide-y">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2 no-export">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($users as $u)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $u->id }}</td>
                            <td class="px-4 py-2">{{ $u->name }}</td>
                            <td class="px-4 py-2">{{ $u->email }}</td>
                            <td class="px-4 py-2">{{ $u->role }}</td>
                            <td class="px-4 py-2 no-export">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.users.edit', $u) }}" class="inline-flex items-center gap-2 px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">Edit</a>
                                    <a href="{{ route('admin.users.report', $u) }}" class="inline-flex items-center gap-2 px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm">Laporan</a>
                                    <form action="{{ route('admin.users.destroy', $u) }}" method="POST" onsubmit="return confirm('Delete user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex items-center gap-2 px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
                    if (cols[j].classList.contains('no-export')) continue;
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
