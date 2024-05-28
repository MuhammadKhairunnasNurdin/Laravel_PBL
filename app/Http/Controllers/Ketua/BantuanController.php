<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\AuditBulananBayi;
use App\Models\Kriteria;
use App\Models\Pemeriksaan;
use App\Models\Penduduk;
use App\Models\RekamMedisIbu;
use App\Models\RentangKriteria;
use App\Services\MabacServices;
use App\Services\SAWServices;
use Illuminate\Http\Request;

class BantuanController extends Controller
{
    private MabacServices $mabac;
    private SAWServices $saw;
    public function __construct(MabacServices $mabac, SAWServices $saw) {
        $this->mabac = $mabac;
        $this->saw = $saw;
    }
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

        if ($request->penduduk_id === null) {
            return redirect()->intended('ketua/bantuan/penerima')
            ->with('error', 'Pilih setidaknya satu alternatif');
        }

        $kriteria = Kriteria::all();
        $countBayi = $request->penduduk_id;
        // SAW
        $values = $this->saw->createValue($bayis, $countBayi);
        $maxMin = $this->saw->maxMin($values, $kriteria);
        $normalize = $this->saw->normalizedSaw($values, $maxMin, $kriteria);
        $optimalize = $this->saw->optimalizedSaw($values, $normalize, $kriteria);
        $bayiSAW = $this->saw->rankSaw($values, $optimalize, $kriteria);

        // Mabac
        $values = $this->mabac->createValue($bayis, $countBayi);
        $maxMin = $this->mabac->maxMin($values, $kriteria);
        $normalize = $this->mabac->normalizedMabac($values, $maxMin, $kriteria);
        $weighted = $this->mabac->weighMabac($values, $normalize, $kriteria);
        $areas = $this->mabac->areaMabac($values, $weighted, $kriteria);
        $distance = $this->mabac->distanceMabac($values, $weighted, $areas, $kriteria);
        $bayiMabac = $this->mabac->rankMabac($values, $distance, $kriteria);
        return view('ketua.bantuan.konfirmasi', compact('breadcrumb', 'activeMenu', 'bayis', 'values', 'bayiSAW', 'bayiMabac', 'countBayi'));
    }
}
