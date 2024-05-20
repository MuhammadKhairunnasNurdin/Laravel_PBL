<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penduduk;

class PendudukController extends Controller
{
    //
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Data Penduduk'
        ];

        $activeMenu = 'penduduk';

        /**
         * Retrieve data for filter feature
         */
        $penduduks = Penduduk::paginate(10);
        return view('admin.penduduk.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'penduduks' => $penduduks]);
    }

    
}