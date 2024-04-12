<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\KunjunganChart;

class DashboardController extends Controller
{
    public function indexKader(KunjunganChart $chart){
        $breadcrumb = (object) [
            'title' => 'Dashboard',
        ];

        $activeMenu = 'dashboard';

        return view('kader.index', ['chart' => $chart->build(), 'breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function indexKetua(KunjunganChart $chart){
        $breadcrumb = (object) [
            'title' => 'Dashboard',
        ];

        $activeMenu = 'dashboard';

        return view('ketua.index', ['chart' => $chart->build(), 'breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
