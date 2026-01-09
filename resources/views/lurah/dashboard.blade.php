@extends('layouts.app')

@section('content')
<h2>Dashboard Lurah</h2>
<p>Selamat datang, {{ auth()->user()->name }}</p>

<h3>Laporan Warga yang Diteruskan</h3>
<ul>
@foreach($reports as $r)
    <li>
        <strong>{{ $r->nama }}</strong> - {{ $r->pesan }} <br>
        Status: {{ $r->status }}<br>
        <a href="#">Beri Tanggapan</a>
    </li>
@endforeach
</ul>
@endsection
