<?php

namespace App\Http\Controllers\Shared;

use App\Charts\KunjunganChart;
use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Pemeriksaan;

class
DashboardController extends Controller
{
    public function indexKader(KunjunganChart $chart){
        $breadcrumb = (object) [
            'title' => 'Dashboard',
        ];

        $activeMenu = 'dashboard';

        return view('kader.index', ['chart' => $chart->build(), 'breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'data' => $this->indexData()]);
    }

    public function indexKetua(KunjunganChart $chart){
        $breadcrumb = (object) [
            'title' => 'Dashboard',
        ];

        $activeMenu = 'dashboard';

        return view('ketua.index', ['chart' => $chart->build(), 'breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'data' => $this->indexData()]);
    }

    private function indexData(): array
    {
        return $data = [
            'golongan_subMonth' => Pemeriksaan::selectRaw('count(pemeriksaan_id) as total, golongan')
                ->whereDate('tgl_pemeriksaan', '>=', now()->subMonth())
                ->groupBy('golongan')->get(),
            'golongan_all' => Pemeriksaan::selectRaw('count(pemeriksaan_id) as total, golongan')
                ->groupBy('golongan')->get(),
            'status' => Pemeriksaan::selectRaw('count(pemeriksaan_id) as total, golongan')
                ->whereBetween('tgl_pemeriksaan', [now()->subMonth(), now()])
                ->where('status', '=', 'sakit')
                ->groupBy('golongan')->get(),
            'kegiatan' => Kegiatan::all(),
        ];
    }
}
