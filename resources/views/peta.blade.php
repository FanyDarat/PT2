<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Data Map</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/maps.css') }}">
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

<h1>Flood Data Map</h1>

<label for="wilayahInput">Wilayah</label>
<select name="wilayahInput" id="wilayahInput">
    <option value="Bandung">Bandung</option>
    <option value="Kota Bandung">Kota Bandung</option>
</select>

<label for="yearInput">Year</label>
<select name="yearInput" id="yearInput">
    <option value="2025">2025</option>
    <option value="2026">2026</option>
</select>

<label for="monthInput">Month</label>
<select id="monthInput">
    <option value="" disabled selected>Select month</option>
    <option value="januari">Januari</option>
    <option value="februari">Februari</option>
    <option value="maret">Maret</option>
    <option value="april">April</option>
    <option value="mei">Mei</option>
    <option value="juni">Juni</option>
    <option value="juli">Juli</option>
    <option value="agustus">Agustus</option>
    <option value="september">September</option>
    <option value="oktober">Oktober</option>
    <option value="november">November</option>
    <option value="desember">Desember</option>
</select>

<button id="searchButton">Search Flood Data</button>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('js/maps.js') }}"></script>
</body>
</html>
