<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromosiController extends Controller
{
    public function jadwal()
    {
        $breadcrumb = (object) [
            'title' => 'Jadwal Kegiatan'
        ];

        $activeMenu = 'jadwal';

        return view('promosi.jadwal', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function profil()
    {
        $breadcrumb = (object) [
            'title' => 'Profil Posyandu'
        ];

        $activeMenu = 'profil';

        return view('promosi.profil', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function landingpage()
    {
        $breadcrumb = (object) [
            'title' => 'Landing Page'
        ];

        $activeMenu = 'promosi';

        return view('promosi.landing', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
