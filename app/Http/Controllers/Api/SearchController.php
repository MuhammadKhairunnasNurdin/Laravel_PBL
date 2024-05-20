<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanLansia;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchLansia(Request $request)
    {
        $search = $request->input('search', '');
        $query = Pemeriksaan::with('pemeriksaan_lansia','penduduk');

        if (preg_match('/^\d/', $search)) {
            $penduduk = $query
                ->where('golongan', 'lansia', 'and', 'penduduk.nama', 'like', "%{$search}%")
                ->paginate(6);
        } else {
            $penduduk = $query
                ->where('golongan', 'lansia', 'and', 'penduduk.nama', 'like', "%{$search}%")
                ->paginate(6);
        }

        if ($penduduk->isEmpty()) {
            return response()->json(['error' => 'No results found'], 404);
        }

        return response()->json([$penduduk], 200);
    }
    public function searchBayi(Request $request)
    {
        $search = $request->input('search', '');
        $query = Pemeriksaan::with('pemeriksaan_bayi','penduduk');

        if (preg_match('/^\d/', $search)) {
            $penduduk = $query
                ->where('golongan', 'bayi', 'and', 'penduduk.nama', 'like', "%{$search}%")
                ->paginate(6);
        } else {
            $penduduk = $query
                ->where('golongan', 'bayi', 'and', 'penduduk.nama', 'like', "%{$search}%")
                ->paginate(6);
        }

        if ($penduduk->isEmpty()) {
            return response()->json(['error' => 'No results found'], 404);
        }

        return response()->json([$penduduk], 200);
    }
}   