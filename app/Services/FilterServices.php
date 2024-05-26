<?php

namespace App\Services;

use App\Models\Penduduk;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanBayi;
use App\Models\PemeriksaanLansia;
use Illuminate\Http\Request;

Class FilterServices
{
    public function getFilteredDataBayi(Request $request)
    {
        $query = Pemeriksaan::with('penduduk', 'pemeriksaan_bayi')->where('golongan', 'bayi');

        if ($request->has('statusKes')) {
            $query->where('status', $request->input('statusKes'));
        }

        if ($request->has('golUmur')) {
            $query->whereHas('pemeriksaan_bayi', function($query) use ($request) {
                $query->where('kategori_golongan', $request->input('golUmur'));  
            });
        }

        return $query;
    }
    
    public function getFilteredDataLansia(Request $request)
    {
        $query = Pemeriksaan::with('penduduk', 'pemeriksaan_lansia')->where('golongan', 'lansia');
        $indikasi = $request->input('indikasi');
        $asam_urat = 6.5;
        $gula = 140.0;
        $kolesterol = 200.0;

        if ($request->has('statusKes')) {
            $query->where('status', $request->input('statusKes'));
        }

        if ($request->has('indikasi')) {
            $query->whereHas('pemeriksaan_lansia', function($query) use ($indikasi, $gula, $asam_urat, $kolesterol, $request) {
                if($indikasi === 'asam_urat')
                {
                    $query->where('asam_urat', '>', $asam_urat);  
                } 
                elseif($indikasi === 'gula')
                {
                    $query->where('gula_darah', '>', $gula);
                } 
                elseif($indikasi === 'kolesterol') 
                {
                    $query->where('kolesterol', '>', $kolesterol);
                }
            });
        }

        return $query;
    }
    
    public function getFilteredData(Request $request)
    {
        $query = Penduduk::orderBy('NIK', 'asc');

        if ($request->has('hubKeluarga')) {
            $query->where('hubungan_keluarga', $request->input('hubKeluarga'));
        }

        if ($request->has('golUmur')) {
            $query->whereHas('pemeriksaan_bayi', function($query) use ($request) {
                $query->where('kategori_golongan', $request->input('golUmur'));  
            });
        }

        if ($request->has('rt')) {
            $query->where('RT', $request->input('rt'));
        }

        if ($request->has('kelamin')) {
            $query->where('jenis_kelamin', $request->input('kelamin'));
        }

        return $query;
    }
}