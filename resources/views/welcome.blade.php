<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
        }

        .main {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Articles Application</h3>

        <a href="{{ route('articles.home') }}">Articles</a>
        <a href="{{ route('articles.dashboard') }}">Dashboard</a>
    </div>

    <!-- Main Content -->
<div class="main" style="display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;">
    <h1>Welcome to the Articles Application</h1>
    
    @yield('content')
</div>

</div>

</body>
</html>