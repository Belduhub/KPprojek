<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pengaduan Masyarakat</title>

    <!-- CSS PUBLIK KAMU -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- LEAFLET MAP -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>
</head>
<body>

<header class="header">
    <div class="container header-flex">
        <div>
            <strong>Pengaduan Masyarakat</strong>
        </div>
        <nav>
            <a href="/">Beranda</a>
            <a href="/lapor">Buat Laporan</a>
            <a href="/login">Login Admin</a>
        </nav>
    </div>
</header>

<main class="container" style="margin-top:30px;">
    @yield('content')
</main>

<footer class="footer">
    <p>© {{ date('Y') }} Pemerintah Kabupaten Magelang</p>
</footer>

</body>
</html>
