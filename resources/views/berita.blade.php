<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class = "berita">
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

<div class="content-container">
    <div class="top-news">
        <img src="{{ asset('images/berita.png') }}" alt="Berita" class="top-news-image">
    
        <div class="top-news-list">
            <h2>Terpopuler</h2>
            <div class="news-card-2">1. Tangis Haru Warga Bojongsoang Saat Diselamatkan dari Banjir Tengah Malam</div>
            <div class="news-card-2">2. Setelah Sepekan Terendam, Banjir di Bojongsoang Mulai Surut Perlahan</div>
            <div class="news-card-2">3. Bojongsoang Darurat Banjir: Relawan dan Donasi Terus Mengalir</div>
            <div class="news-card-2">4. Evakuasi Masal Dilakukan di Bojongsoang Setelah Banjir Meluas</div>
            <div class="news-card-2">5. Bojongsoang Kembali Banjir, Aktivitas Ekonomi Warga Terhambat</div>
        </div>  
    </div>

    <div class="news-grid">
        <div class="news-card">
            <div class="thumbnail">
                <img src="{{ asset('images/berita.png') }}" alt="Berita">
            </div>
            <p>Banjir Kembali Rendam Bojongsoang, Warga Mengungsi ke Tempat Aman</p>
        </div>
        <div class="news-card">
            <div class="thumbnail">
                <img src="{{ asset('images/berita.png') }}" alt="Berita">   
            </div>
            <p>Hujan Deras Semalaman, Puluhan Rumah di Bojongsoang Terendam Banjir</p>
        </div>
        <div class="news-card">
            <div class="thumbnail">
                <img src="{{ asset('images/berita.png') }}" alt="Berita">
            </div>
            <p>Bojongsoang Lumpuh Akibat Banjir, Jalan Utama Tak Bisa Dilewati</p>
        </div>
        <div class="news-card">
            <div class="thumbnail">
                <img src="{{ asset('images/berita.png') }}" alt="Berita">
            </div>
            <p>Air Sungai Meluap, Banjir Bojongsoang Capai Ketinggian Satu Meter</p>
        </div>
        <div class="news-card">
            <div class="thumbnail">
                <img src="{{ asset('images/berita.png') }}" alt="Berita">
            </div>
            <p>Banjir Bojongsoang Picu Pemadaman Listrik dan Krisis Air Bersih</p>
        </div>
        <div class="news-card">
            <div class="thumbnail">
                <img src="{{ asset('images/berita.png') }}" alt="Berita">
            </div>
            <p>Sekolah di Bojongsoang Diliburkan Akibat Banjir yang Makin Parah</p>
        </div>
        <div class="news-card">
            <div class="thumbnail">
                <img src="{{ asset('images/berita.png') }}" alt="Berita">
            </div>
            <p>Warga Bojongsoang Keluhkan Minimnya Bantuan Saat Banjir</p>
        </div>
        <div class="news-card">
            <div class="thumbnail">
                <img src="{{ asset('images/berita.png') }}" alt="Berita">
            </div>
            <p>Banjir Berulang, Warga Bojongsoang Desak Pemerintah Cari Solusi Permanen</p>
        </div>
    </div>
</div>
</body>
</html>