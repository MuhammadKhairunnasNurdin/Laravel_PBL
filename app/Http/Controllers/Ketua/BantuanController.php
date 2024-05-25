<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\AuditBulananBayi;
use App\Models\Kriteria;
use App\Models\Pemeriksaan;
use App\Models\Penduduk;
use App\Models\RekamMedisIbu;
use App\Models\RentangKriteria;
use Illuminate\Http\Request;

class BantuanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Bantuan Pangan'
        ];

        $activeMenu = 'bantuan';

        $bayisData = Pemeriksaan::with('penduduk', 'pemeriksaan_bayi')->where('golongan', 'bayi')->paginate(10);

        $parentsData = Penduduk::where('hubungan_keluarga', '!=', 'Anak')
            ->get(['nama', 'hubungan_keluarga', 'NKK', 'penduduk_id']);

        return view('ketua.bantuan.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'bayis' => $bayisData, 'parents' => $parentsData]);
    }

    public function tambah()
    {
        $breadcrumb = (object) [
            'title' => 'Bantuan Pangan'
        ];

        $activeMenu = 'bantuan';

        $bayisData = Pemeriksaan::with('penduduk', 'pemeriksaan_bayi')->where('golongan', 'bayi')->where('tgl_pemeriksaan', '2024-05-15')->paginate(10);

        $parentsData = Penduduk::where('hubungan_keluarga', '!=', 'Anak')
            ->get(['nama', 'hubungan_keluarga', 'NKK', 'penduduk_id']);

        // return view('ketua.bantuan.penerima', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'bayis' => $bayisData, 'parents' => $parentsData]);
        return view('ketua.bantuan.penerima', compact('breadcrumb', 'activeMenu', 'bayisData', 'parentsData'));
    }
    public function konfirmasi(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Bantuan Pangan'
        ];

        $activeMenu = 'bantuan';

        $bayis = AuditBulananBayi::join('pemeriksaans', 'audit_bulanan_bayis.bulan_id', '=', 'pemeriksaans.pemeriksaan_id')
            ->join('penduduks', 'audit_bulanan_bayis.penduduk_id', '=', 'penduduks.penduduk_id')
            ->select('audit_bulanan_bayis.*', 'pemeriksaans.tgl_pemeriksaan', 'pemeriksaans.golongan', 'penduduks.NKK', 'penduduks.nama')
            ->where('tgl_pemeriksaan', '2024-05-15')
            ->get();

        $countBayi = $request->penduduk_id;
        $values = $this->createValue($bayis, $countBayi);
        $bayiSAW = $this->saw($values);
        $bayiMabac = $this->mabac($values);
        return view('ketua.bantuan.konfirmasi', compact('breadcrumb', 'activeMenu', 'bayis', 'values', 'bayiSAW', 'bayiMabac', 'countBayi'));
    }
    private function createValue($alternatif, $countBayi)
    {
        $ranges = RentangKriteria::all();
        $value = [];
        for ($i = 0; $i < count($countBayi); $i++) {
            foreach ($alternatif as $alt) {
                if ($alt->penduduk_id == $countBayi[$i]) {
                    $parents = Penduduk::where('NKK', '=', $alt->NKK)->where('hubungan_keluarga', '!=', 'Anak')->get();
                    foreach ($parents as $parent) {
                        if ($parent->hubungan_keluarga === 'Kepala Keluarga') {
                            $incomeDad = (float) str_replace(['Rp', '.'], '', explode(' - ', $parent->pendapatan)[0]);
                        } else {
                            $incomeMom = (float) str_replace(['Rp', '.'], '', explode(' - ', $parent->pendapatan)[0]);
                        }
                    }
                    $sumIncome = $incomeDad + $incomeMom;
                    foreach ($ranges as $range) {
                        if ($range->kode === 'C1' && $alt->berat_badan >= $range->rentang_min && $alt->berat_badan <= $range->rentang_max) {
                            $value[$i][0] = $range->nilai;
                        }
                        if ($range->kode === 'C2' && $alt->tinggi_badan >= $range->rentang_min && $alt->tinggi_badan <= $range->rentang_max) {
                            $value[$i][1] = $range->nilai;
                        }
                        if ($range->kode === 'C3' && $alt->lingkar_kepala >= $range->rentang_min && $alt->lingkar_kepala <= $range->rentang_max) {
                            $value[$i][2] = $range->nilai;
                        }
                        if ($range->kode === 'C4' && $alt->lingkar_lengan >= $range->rentang_min && $alt->lingkar_lengan <= $range->rentang_max) {
                            $value[$i][3] = $range->nilai;
                        }
                        if ($range->kode === 'C5' && $sumIncome >= $range->rentang_min && $sumIncome <= $range->rentang_max) {
                            $value[$i][4] = $range->nilai;
                        }
                    }
                }
            }
        }
        return $value;
    }
    private function saw($bayis)
    {
        $kriteria = Kriteria::all();

        $value = $bayis;
        $alternatif = $bayis;
        $maxMin = [];
        for ($i = 0; $i < count($kriteria); $i++) {
            $arrayNilai = array_column($value, $i);
            $maxMin[$i][0] = max($arrayNilai);
            $maxMin[$i][1] = min($arrayNilai);
        }

        // Menghitung normalisasi dari matrix awal
        $normalizedMatrix = [];
        for ($i = 0; $i < count($alternatif); $i++) {
            for ($j = 0; $j < count($kriteria); $j++) {
                if ($kriteria[$j]['jenis'] === 'benefit') {
                    $normalizedMatrix[$i][$j] = $value[$i][$j] / $maxMin[$j][0];
                }
                if ($kriteria[$j]['jenis'] === 'cost') {
                    $normalizedMatrix[$i][$j] = $maxMin[$j][1] / $value[$i][$j];
                }
            }
        }

        // matriks R dan perangkingan bisa dijadikan satu //
        // Matriks R
        $matriksR = [];
        for ($i = 0; $i < count($alternatif); $i++) {
            for ($j = 0; $j < count($kriteria); $j++) {
                $matriksR[$i][$j] = $normalizedMatrix[$i][$j] * $kriteria[$j]['bobot'];
            }
        }

        // Menghitung perangkingan 
        $rangking = [];
        $sum = 0;
        for ($i = 0; $i < count($alternatif); $i++) {
            $sum = 0;
            for ($j = 0; $j < count($kriteria); $j++) {
                $sum += $matriksR[$i][$j];
            }
            $rangking[$i] = $sum;
        }

        return $rangking;
    }

    private function mabac($bayis)
    {
        // Matriks keputusan awal
        $kriteria = Kriteria::all();

        $value = $bayis;
        $alternatif = $bayis;

        $maxMin = [];
        for ($i = 0; $i < 5; $i++) {
            $arrayNilai = array_column($value, $i);
            $maxMin[$i][0] = max($arrayNilai);
            $maxMin[$i][1] = min($arrayNilai);
        }

        // Normalisasi matriks keputusan (x)
        $normalizedMatrix = [];
        for ($i = 0; $i < count($alternatif); $i++) {
            for ($j = 0; $j < count($kriteria); $j++) {
                $difference = $maxMin[$j][0] - $maxMin[$j][1];
                if ($kriteria[$j]['jenis'] === 'benefit') {
                    if ($difference == 0) {
                        $normalizedMatrix[$i][$j] = 0;
                    } else {
                        $normalizedMatrix[$i][$j] = ($value[$i][$j] - $maxMin[$j][1]) / $difference;
                    }
                }
                if ($kriteria[$j]['jenis'] === 'cost') {
                    $difference = $maxMin[$j][1] - $maxMin[$j][0];
                    if ($difference == 0) {
                        $normalizedMatrix[$i][$j] = 0;
                    } else {
                        $normalizedMatrix[$i][$j] = ($value[$i][$j] - $maxMin[$j][0]) / $difference;
                    }
                }
            }
        }

        // Perhitungan matriks tertimbang (v)
        $tertimbang = [];
        for ($i = 0; $i < count($alternatif); $i++) {
            for ($j = 0; $j < count($kriteria); $j++) {
                $tertimbang[$i][$j] = ($kriteria[$j]['bobot'] * $normalizedMatrix[$i][$j]) + $kriteria[$j]['bobot'];
            }
        }

        // Matriks area perkiraan perbatasan (g)
        $area = [];
        for ($i = 0; $i < count($kriteria); $i++) {
            $area[$i] = 1;
            for ($j = 0; $j < count($alternatif); $j++) {
                $area[$i] *= $tertimbang[$j][$i];
            }
            $area[$i] = pow($area[$i], 1 / count($alternatif));
        }

        // matriks jarak (q)
        $jarak = [];
        for ($i = 0; $i < count($alternatif); $i++) {
            for ($j = 0; $j < count($kriteria); $j++) {
                $jarak[$i][$j] = $tertimbang[$i][$j] - $area[$j];
            }
        }

        // perangkingan (s)
        $rangking = [];
        $sum = 0;
        for ($i = 0; $i < count($alternatif); $i++) {
            $sum = 0;
            for ($j = 0; $j < count($kriteria); $j++) {
                $sum += $jarak[$i][$j];
                $rangking[$i] = $sum;
            }
        }

        return $rangking;
    }
}
