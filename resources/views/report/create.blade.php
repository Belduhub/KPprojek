@extends('layouts.public')

@section('content')
<h2>Buat Laporan Pengaduan</h2>

<form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="nama" placeholder="Nama Pelapor" required><br><br>

<textarea name="pesan" placeholder="Pesan Aduan" required></textarea><br><br>

<button type="button" onclick="getCurrentLocation()">📍 Gunakan Lokasi Saat Ini</button><br><br>

<div id="map" style="height:300px;"></div><br>

<input type="text" name="kecamatan" placeholder="Kecamatan" readonly required><br><br>
<input type="text" name="kelurahan" placeholder="Kelurahan" readonly required><br><br>
<textarea name="alamat_lengkap" placeholder="Alamat Lengkap" readonly required></textarea><br><br>

<input type="hidden" name="latitude" required>
<input type="hidden" name="longitude" required>

<input type="file" name="gambar"><br><br>

<button type="submit">Kirim Laporan</button>
</form>

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var map = L.map('map').setView([-7.4706, 110.2177], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

var marker;

function setLocation(lat, lng) {
    if (marker) map.removeLayer(marker);
    marker = L.marker([lat, lng]).addTo(map);
    map.setView([lat, lng], 15);

    document.querySelector('[name=latitude]').value = lat;
    document.querySelector('[name=longitude]').value = lng;

    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
        .then(res => res.json())
        .then(data => {
            document.querySelector('[name=alamat_lengkap]').value = data.display_name || '';

            const address = data.address || {};
            document.querySelector('[name=kecamatan]').value =
                address.city || address.town || address.municipality || '';

            document.querySelector('[name=kelurahan]').value =
                address.village || address.suburb || address.hamlet || '';
        });
}

map.on('click', function(e) {
    setLocation(e.latlng.lat, e.latlng.lng);
});

function getCurrentLocation() {
    if (!navigator.geolocation) {
        alert('Browser tidak mendukung GPS');
        return;
    }

    navigator.geolocation.getCurrentPosition(
        function(pos) {
            setLocation(pos.coords.latitude, pos.coords.longitude);
        },
        function() {
            alert('Gagal mengambil lokasi');
        }
    );
}
</script>
@endsection
