<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $reports = \App\Models\Report::all();

        return view('admin.dashboard', compact('reports'));
    }
}
