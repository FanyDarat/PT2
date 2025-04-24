<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Ngosan</div>
        <div class="right">
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('peta') }}">Peta</a></li>
                <li><a href="{{ route('kos') }}">Cari Kos</a></li>
                <li><a href="{{ route('berita') }}">Berita</a></li>
            </ul>
            <div class="profile">Profile</div>
        </div>
    </nav>
</body>
</html>