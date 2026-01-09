<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    @include('partials.navbar')
    <div class="max-w-2xl mx-auto mt-6">
        <header class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">Edit User</h1>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L4.414 9H18a1 1 0 110 2H4.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
                Kembali
            </a>
        </header>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm text-gray-600">Name</label>
                    <input name="name" value="{{ old('name', $user->name) }}" class="w-full mt-1 px-3 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Email</label>
                    <input name="email" value="{{ old('email', $user->email) }}" class="w-full mt-1 px-3 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">New Password (leave blank to keep)</label>
                    <input name="password" type="password" class="w-full mt-1 px-3 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Confirm Password</label>
                    <input name="password_confirmation" type="password" class="w-full mt-1 px-3 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Role</label>
                    <select name="role" class="w-full mt-1 px-3 py-2 border rounded">
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
