<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LansiaController extends Controller
{
    public function index(){
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Lansia'
        ];

        $activeMenu = 'lansia';

        return view('kader.lansia.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function tambah(){
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Lansia'
        ];

        $activeMenu = 'lansia';

        return view('kader.lansia.tambah', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function detail()
    {
        $breadcrumb = (object)[
            'title' => 'Pemeriksaan Lansia'  
        ];

        $activeMenu = 'lansia';

        return view('kader.lansia.detail', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}