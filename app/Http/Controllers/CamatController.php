<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class CamatController extends Controller
{
    public function index()
    {
        $reports = Report::where('kecamatan', auth()->user()->kecamatan)->get();

        return view('camat.dashboard', compact('reports'));
    }
}
