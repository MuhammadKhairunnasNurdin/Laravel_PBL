<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Kelola Informasi'
        ];

        $activeMenu = 'info';

        return view('kader.informasi.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
