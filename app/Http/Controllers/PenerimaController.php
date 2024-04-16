<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenerimaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Penerima Bantuan'
        ];

        $activeMenu = 'bantuan';

        return view('ketua.bantuan.penerima', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
