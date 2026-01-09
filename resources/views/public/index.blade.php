@extends('layouts.public')

@section('content')

<section class="hero">
    <h1>SISTEM PENGADUAN MASYARAKAT</h1>
    <h2>KABUPATEN MAGELANG</h2>
    <p>
        Sampaikan laporan, keluhan, dan aspirasi Anda secara cepat,
        tepat, dan transparan.
    </p>

    <a href="/lapor" class="btn-primary">Buat Laporan Sekarang</a>
</section>

<section class="info">
    <div class="info-box">
        <h3>📝 Mudah Melapor</h3>
        <p>Isi laporan langsung dari lokasi kejadian melalui peta.</p>
    </div>
    <div class="info-box">
        <h3>📍 Tepat Sasaran</h3>
        <p>Laporan diteruskan ke wilayah terkait secara otomatis.</p>
    </div>
    <div class="info-box">
        <h3>🔍 Transparan</h3>
        <p>Masyarakat dapat melihat laporan terbaru.</p>
    </div>
</section>

<hr>

<section>
    <h2>Laporan Terbaru Warga</h2>

    @forelse($reports as $r)
        <div class="report-card">
            <strong>{{ $r->nama }}</strong>
            <p>{{ $r->pesan }}</p>

            <small>
                {{ $r->kelurahan }}, {{ $r->kecamatan }} <br>
                {{ $r->created_at->diffForHumans() }}
            </small>

            <div id="map-{{ $r->id }}" class="map-small"></div>

            @if($r->gambar)
                <img src="{{ asset('storage/'.$r->gambar) }}" class="report-image">
            @endif
        </div>

        <script>
            var map{{ $r->id }} = L.map('map-{{ $r->id }}').setView(
                [{{ $r->latitude }}, {{ $r->longitude }}], 15
            );
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
                .addTo(map{{ $r->id }});
            L.marker([{{ $r->latitude }}, {{ $r->longitude }}])
                .addTo(map{{ $r->id }});
        </script>
    @empty
        <p>Belum ada laporan.</p>
    @endforelse
</section>

@endsection
