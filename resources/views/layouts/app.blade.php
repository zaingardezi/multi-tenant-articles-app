<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
<div class="flex min-h-screen bg-gray-100">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-light shadow-md h-screen">

        <div class="p-4 font-bold text-xl border-b">
            My Panel
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('articles.dashboard') }}" class="block p-2 rounded hover:bg-gray-200">Dashboard</a>
            <a href="{{ route('users.homepage') }}" class="block p-2 rounded hover:bg-gray-200">Users</a>
            <a href="{{ route('articles.home') }}" class="block p-2 rounded hover:bg-gray-200">Articles</a>
            <a href="{{route('profile.edit', auth()->id())}}"  class="block p-2 rounded hover:bg-gray-200" >Settings</a>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                @method('post')
           
    <button type="submit" class="block p-2 rounded hover:bg-gray-200">
        Logout
    </button>
            </form>
        </nav>

    </aside>

    <!-- CONTENT -->
    <div class="flex-1 p-6">

        <main>
            {{ $slot }}
        </main>

    </div>

</div>
</body>
</html>
