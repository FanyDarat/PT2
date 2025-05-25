<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
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
        </div>
    </nav>

    <section class="hero">
        <div class="content">
            <h1>Cari Kosan Anti Banjir?</h1>
            <p>Mau cari kosan tapi takut kosannya kena banjir? cari di Ngosan aja</p>
            <a href="{{ route('kos') }}"class="btn">Cari Kos</a>
        </div>
        <div class="content-home">
            <img src="{{ asset('images/conf.png') }}" alt="hero">
        </div>
    </section>

    <section class="bg1-1">
        <div class="bg2-1">
            <div class="grid">
                <div class="content">
                    <h2>Peta Interaktif</h2>
                    <p>Terdapat peta interaktif untuk memperlihatkan titik banjir di sekitar kampus</p>
                    <a href="{{ route('peta') }}" class="btn">Lihat Peta</a>
                </div>
                <div class="content-img">
                    <img src="{{ asset('images/map.jpg') }}" alt="Map">
                </div>

                <div class="content-img">
                    <img src="{{ asset('images/1.jpg') }}" alt="Kamar Kos">
                </div>
                <div class="content">
                    <h2>Rekomendasi Kos</h2>
                    <p>Memberikan rekomendasi kosan dengan kualitas terbaik</p>
                    <a href="{{ route('kos') }}" class="btn">Lihat Rekomendasi</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg1-2">
        <div class="bg2-2">
            <div class="grid">
                <div class="content">
                    <h2>Melihat Berita Terkini</h2>
                    <p>Menyediakan berita terkini mengenai banjir di sekitar kampus</p>
                    <a href="{{ route('berita') }}" class="btn">Baca Berita</a>
                </div>
                <div class="content-img2">
                    <img src="{{ asset('images/news.png') }}" alt="berita">
                </div>
            </div>
        </div>
    </section>

    <section class="bg1-1">
        <div class="bg2-1">
            <div class="grid">
                <div class="content-img">
                    <img src="{{ asset('images/data.png') }}" alt="data">
                </div>
                <div class="content">
                    <h2>99% Data Akurat</h2>
                    <p>Data akurat yang didapatkan dari GIS</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
