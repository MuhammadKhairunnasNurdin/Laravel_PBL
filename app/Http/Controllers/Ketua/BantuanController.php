<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;

class BantuanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Bantuan Pangan'
        ];

        $activeMenu = 'bantuan';

        return view('ketua.bantuan.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function tambah()
    {
        $breadcrumb = (object) [
            'title' => 'Bantuan Pangan'
        ];

        $activeMenu = 'bantuan';

        return view('ketua.bantuan.penerima', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
    public function konfirmasi()
    {
        $breadcrumb= (object) [
            'title' => 'Bantuan Pangan'
        ];

        $activeMenu = 'bantuan';

        return view('ketua.bantuan.konfirmasi', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
