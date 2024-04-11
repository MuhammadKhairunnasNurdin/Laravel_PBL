<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\KunjunganChart;

class DashboardController extends Controller
{
    public function index(KunjunganChart $chart){
        $breadcrumb = (object) [
            'title' => 'Dashboard',
        ];

        return view('kader.index', ['chart' => $chart->build(), 'breadcrumb' => $breadcrumb]);
    }
}
