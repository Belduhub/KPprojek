@extends('layouts.app')

@section('content')
<h2>Dashboard Super Admin</h2>
<p>Selamat datang, {{ auth()->user()->name }}</p>

<h3>Semua Laporan Warga</h3>
<ul>
@foreach($reports as $r)
    <li>
        <strong>{{ $r->nama }}</strong> - {{ $r->pesan }} <br>
        Kecamatan: {{ $r->kecamatan }} | Kelurahan: {{ $r->kelurahan }} <br>
        Status: {{ $r->status }}
    </li>
@endforeach
</ul>
@endsection
