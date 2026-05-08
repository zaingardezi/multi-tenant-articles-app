<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Tenant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="flex min-h-screen bg-gray-100">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md h-screen">
        <div class="p-4 font-bold text-xl border-b">Central Admin</div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('central.dashboard') }}"
               class="block p-2 rounded hover:bg-gray-200">Dashboard</a>
            <a href="{{ route('central.tenants.create') }}"
               class="block p-2 rounded hover:bg-gray-200">Create Tenant</a>
            <form action="{{ route('central.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="block w-full text-left p-2 rounded hover:bg-gray-200">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- Content --}}
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6">Create New Tenant</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6 max-w-md">
            <form method="POST" action="{{ route('central.tenants.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block font-medium mb-1">Tenant ID</label>
                    <input type="text" name="id" value="{{ old('id') }}"
                        placeholder="e.g. tenant3"
                        class="w-full border rounded px-3 py-2" required>
                    <p class="text-gray-500 text-sm mt-1">
                        This will be the database name.
                    </p>
                </div>
                <div class="mb-6">
                    <label class="block font-medium mb-1">Domain</label>
                    <input type="text" name="domain" value="{{ old('domain') }}"
                        placeholder="e.g. tenant3.test"
                        class="w-full border rounded px-3 py-2" required>
                    <p class="text-gray-500 text-sm mt-1">
                        Remember to add this to your hosts file.
                    </p>
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-bold">
                    Create Tenant
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>