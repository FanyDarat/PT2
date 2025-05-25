<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosan List</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kos.css') }}">
</head>
<body class="kos">
<nav class="navbar">
    <div class="logo">Ngosan</div>
    <div class="right">
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('peta') }}">Peta</a></li>
            <li><a href="{{ route('kos') }}">Cari Kos</a></li>
            <li><a href="{{ route('berita') }}">Berita</a></li>
        </ul>
    </div>
</nav>

<div class="search-container">
    <input type="text" id="searchInput" placeholder="Search by Kosan Name..." onkeyup="searchKosan()">
</div>
        <div class="kos-grid" id="kosanGrid">
            <!-- Kosan cards will be dynamically inserted here -->
        </div>
<script src="{{ asset('js/kos.js') }}"></script>
</body>
</html>
