<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Central Admin Dashboard</title>
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
                    class="block p-2 rounded hover:bg-gray-200">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- Content --}}
    <div class="flex-1 p-6">

        <h1 class="text-3xl font-bold mb-6">Tenants</h1>
        

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table width="100%" cellpadding="10" style="border-collapse:collapse;">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 text-center">Tenant ID</th>
                        <th class="p-3 text-center">Domain</th>
                        <th class="p-3 text-center">Created At</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 text-center">{{ $tenant->id }}</td>
                        <td class="p-3 text-center">
                            @foreach($tenant->domains as $domain)
                                <a href="http://{{ $domain->domain }}"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                    {{ $domain->domain }}
                                </a>
                            @endforeach
                        </td>
                        <td class="p-3 text-center">{{ $tenant->created_at }}</td>
                        <td class="p-3 text-center">
                            <form method="POST"
                                action="{{ route('central.tenants.destroy', $tenant) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Delete this tenant and all its data?')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>