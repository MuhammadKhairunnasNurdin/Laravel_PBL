<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBayiRequest;
use App\Http\Requests\StorePemeriksaanRequest;
use App\Http\Requests\UpdateBayiRequest;
use App\Http\Requests\UpdatePemeriksaanRequest;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanBayi;
use App\Models\Penduduk;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BayiResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Bayi'
        ];

        $activeMenu = 'bayi';

        /**
         * Retrieve data for filter feature
         */
        $penduduks = Pemeriksaan::with('penduduk')->where('golongan', 'bayi')->get();

        return view('kader.bayi.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'penduduks' => $penduduks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Bayi'
        ];

        $activeMenu = 'bayi';

        $bayisData = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) <= 5')->get(['NIK', 'nama', 'alamat', 'NKK', 'tgl_lahir']);

        $parentsData = Penduduk::where('hubungan_keluarga', '!=', 'Anak')
            ->get(['nama', 'hubungan_keluarga', 'NKK']);

        return view('kader.bayi.tambah', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'bayisData' => $bayisData, 'parentsData' => $parentsData]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBayiRequest $bayiRequest, StorePemeriksaanRequest $pemeriksaanRequest): RedirectResponse
    {
        $bayiRequest->merge([
            'pemeriksaan_id' => Pemeriksaan::insertGetId($pemeriksaanRequest->all())
        ]);
        PemeriksaanBayi::insert($bayiRequest->all());

        return redirect()->intended(route('bayi.index'))
            ->with('success', 'Data Bayi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bayiData = Pemeriksaan::with('pemeriksaan_bayi', 'penduduk')->find($id);
        $parentData = Penduduk::where('NKK', $bayiData->penduduk->NKK)
            ->where('hubungan_keluarga', '!=', 'Anak')
            ->get(['nama', 'hubungan_keluarga']);

        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Bayi'
        ];

        $activeMenu = 'bayi';

        return view('kader.bayi.detail', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'bayiData' => $bayiData, 'parentData' => $parentData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bayiData = Pemeriksaan::with('pemeriksaan_bayi', 'penduduk')->find($id);
        $parentData = Penduduk::where('NKK', $bayiData->penduduk->NKK)
            ->where('hubungan_keluarga', '!=', 'Anak')
            ->get(['nama', 'hubungan_keluarga']);

        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Bayi'
        ];

        $activeMenu = 'bayi';

        return view('kader.bayi.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'bayiData' => $bayiData, 'parentData' => $parentData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBayiRequest $bayiRequest, UpdatePemeriksaanRequest $pemeriksaanRequest, string $id): RedirectResponse
    {
        if ($pemeriksaanRequest->all() !== []) {
            Pemeriksaan::find($id)->update($pemeriksaanRequest->all());
        }

        if ($bayiRequest->all() !== []) {
            PemeriksaanBayi::find($id)->update($bayiRequest->all());
        }

        return redirect()->intended(route('bayi.index'))
            ->with('success', 'Data Bayi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $check = Pemeriksaan::find($id);
        if (!$check) {
            return redirect()->intended('kader/bayi')->with('error', 'Data pemeriksaan bayi tidak ditemukan');
        }

        try {
            /**
             * delete pemeriksaans column that also cascade to pemeriksaan_bayis column, because we use cascadeOnDelete() in migration
             */
            Pemeriksaan::destroy($id);

            return redirect()->intended('kader/bayi')->with('success', 'Data pemeriksaan bayi berhasil dihapus');
        } catch (QueryException) {
            return redirect()->intended('kader/bayi')->with('error', 'Data pemeriksaan bayi gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
