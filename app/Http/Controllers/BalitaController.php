<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BalitaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Balita'
        ];

        $activeMenu = 'balita';

        return view('kader.balita.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function tambah()
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Balita'
        ];

        $activeMenu = 'balita';

        return view('kader.balita.tambah', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
