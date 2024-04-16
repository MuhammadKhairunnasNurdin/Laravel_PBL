<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function indexKader()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Profil',
        ];

        $activeMenu = 'profile';

        return view('kader.profil.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function indexKetua()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Profil',
        ];

        $activeMenu = 'profile';

        return view('ketua.profil.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    // public function index()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Manajemen Profil',
    //     ];

    //     $activeMenu = 'profile';

    //     return view('profil.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    // }
}
