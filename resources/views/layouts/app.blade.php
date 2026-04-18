<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>

    <style>
        body { margin: 0; font-family: Arial; }

        .container { display: flex; }

      .sidebar {
    width: 220px;
    min-height: 100vh; /* ✅ changed */
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

    <div class="sidebar">
        <h3>Articles Application</h3>
        <a href="{{ route('articles.home') }}">Articles</a>
        <a href="{{ route('articles.dashboard') }}">Dashboard</a>
    </div>

    <div class="main">
        @yield('content')
    </div>

</div>

</body>
</html>