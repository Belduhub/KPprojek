<?php

namespace App\Http\Controllers;

use App\Models\Report;

class LurahController extends Controller
{
    public function index()
    {
        $reports = Report::where('status','diproses_kelurahan')
                         ->orWhere('status','diteruskan_ke_kecamatan')
                         ->where('kelurahan', auth()->user()->wilayah)
                         ->get();

        return view('lurah.dashboard', compact('reports'));
    }
}
