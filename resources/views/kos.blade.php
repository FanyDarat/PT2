<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
            <div class="profile">Profile</div>
        </div>
    </nav>

    <div class="carousel-wrapper">
    <button onclick="prevSlide()" class="nav-btn">&#10094;</button>

    <div class="carousel" id="carousel">
        <div class="card">
            <img src="{{ asset('images/2.png') }}" alt="Kamar Kos">
            <div class="text">Kos dekat Warteg</div>
        </div>
        <div class="card center">
            <img src="{{ asset('images/2.png') }}" alt="Kamar Kos">
            <div class="text">Diskon 70%</div>
        </div>
        <div class="card">
            <img src="{{ asset('images/2.png') }}" alt="Kamar Kos">
            <div class="text">Ada Wifi Kenceng</div>
        </div>
    </div>

    <button onclick="nextSlide()" class="nav-btn">&#10095;</button>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>


    <section class="bg1-1">
    <div class="bg2-1">
        <div class="kos-grid">
            <div class="kos-card">
                <img src="{{ asset('images/1.jpg') }}" alt="Kamar Kos">
                <h2>Kos White House 2</h2>
                <p class="lokasi">Ciganitri</p>
                <p class="harga">Rp. 7.000.000</p>
            </div>
            <div class="kos-card">
                <img src="{{ asset('images/2.png') }}" alt="Kamar Kos">
                <h2>Kos White House 2</h2>
                <p class="lokasi">Ciganitri</p>
                <p class="harga">Rp. 7.000.000</p>
            </div>
            <div class="kos-card">
                <img src="{{ asset('images/3.png') }}" alt="Kamar Kos">
                <h2>Kos White House 2</h2>
                <p class="lokasi">Ciganitri</p>
                <p class="harga">Rp. 7.000.000</p>
            </div>
            <div class="kos-card">
                <img src="{{ asset('images/4.png') }}" alt="Kamar Kos">
                <h2>Kos White House 2</h2>
                <p class="lokasi">Ciganitri</p>
                <p class="harga">Rp. 7.000.000</p>
            </div>
            <div class="kos-card">
                <img src="{{ asset('images/5.png') }}" alt="Kamar Kos">
                <h2>Kos White House 2</h2>
                <p class="lokasi">Ciganitri</p>
                <p class="harga">Rp. 7.000.000</p>
            </div>
            <div class="kos-card">
                <img src="{{ asset('images/6.png') }}" alt="Kamar Kos">
                <h2>Kos White House 2</h2>
                <p class="lokasi">Ciganitri</p>
                <p class="harga">Rp. 7.000.000</p>
            </div>
            <div class="kos-card">
                <img src="{{ asset('images/7.png') }}" alt="Kamar Kos">
                <h2>Kos White House 2</h2>
                <p class="lokasi">Ciganitri</p>
                <p class="harga">Rp. 7.000.000</p>
            </div>
            <div class="kos-card">
                <img src="{{ asset('images/8.png') }}" alt="Kamar Kos">
                <h2>Kos White House 2</h2>
                <p class="lokasi">Ciganitri</p>
                <p class="harga">Rp. 7.000.000</p>
            </div>
            <div class="kos-card">
                <img src="{{ asset('images/9.png') }}" alt="Kamar Kos">
                <h2>Kos White House 2</h2>
                <p class="lokasi">Ciganitri</p>
                <p class="harga">Rp. 7.000.000</p>
            </div>
    </div>
  </div>
  </section>

</body>
</html>