<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Beranda + 10 laporan terbaru warga
    public function index()
    {
        $reports = Report::latest()->take(10)->get();
        return view('public.index', compact('reports'));
    }

    // Form buat laporan baru
    public function create()
    {
        return view('report.create');
    }

    // Simpan laporan warga
    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'pesan'           => 'required|string',
            'latitude'        => 'required',
            'longitude'       => 'required',
            'kecamatan'       => 'required|string',
            'kelurahan'       => 'required|string',
            'alamat_lengkap'  => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('reports', 'public');
        }

        Report::create([
            'nama'           => $request->nama,
            'pesan'          => $request->pesan,
            'latitude'       => $request->latitude,
            'longitude'      => $request->longitude,
            'kecamatan'      => $request->kecamatan,
            'kelurahan'      => $request->kelurahan,
            'alamat_lengkap' => $request->alamat_lengkap,
            'gambar'         => $gambarPath,
            'status'         => 'baru', // ✅ DISIMPAN DI SINI
        ]);

        return redirect('/')
            ->with('success', 'Laporan berhasil dikirim');
    }
}
