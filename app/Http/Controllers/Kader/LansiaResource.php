<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\Lansia\StoreLansiaRequest;
use App\Http\Requests\Kader\Lansia\UpdateLansiaRequest;
use App\Http\Requests\Kader\Pemeriksaan\StorePemeriksaanRequest;
use App\Http\Requests\Kader\Pemeriksaan\UpdatePemeriksaanRequest;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanLansia;
use App\Models\Penduduk;
use Illuminate\Http\RedirectResponse;

class LansiaResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Lansia'
        ];

        $activeMenu = 'lansia';

        /**
         * Retrieve data for filter feature
         */
        $penduduks = Pemeriksaan::with('penduduk')->where('golongan', 'lansia')->paginate(10);
        // $penduduks = Pemeriksaan::with('penduduk')->where('golongan', 'lansia')->get();

        return view('kader.lansia.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'penduduks' => $penduduks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Lansia'
        ];

        $lansiasData = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >= 60')->get(['penduduk_id', 'nama', 'tgl_lahir', 'alamat']);

        $activeMenu = 'lansia';

        return view('kader.lansia.tambah', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'lansiasData' => $lansiasData]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLansiaRequest $lansiaRequest, StorePemeriksaanRequest $pemeriksaanRequest): RedirectResponse
    {
        $lansiaRequest->merge([
            'pemeriksaan_id' => Pemeriksaan::insertGetId($pemeriksaanRequest->all())
        ]);
        PemeriksaanLansia::insert($lansiaRequest->all());

        return redirect()->intended(route('lansia.index'))
            ->with('success', 'Data Lansia berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lansiaData = Pemeriksaan::with('pemeriksaan_lansia', 'penduduk')->find($id);

        $breadcrumb = (object)[
            'title' => 'Pemeriksaan Lansia'
        ];

        $activeMenu = 'lansia';

        return view('kader.lansia.detail', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'lansiaData' => $lansiaData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lansiaData = Pemeriksaan::with('pemeriksaan_lansia', 'penduduk')->find($id);

        $breadcrumb = (object)[
            'title' => 'Pemeriksaan Lansia'
        ];

        $activeMenu = 'lansia';

        return view('kader.lansia.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'lansiaData' => $lansiaData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLansiaRequest $lansiaRequest, UpdatePemeriksaanRequest $pemeriksaanRequest, string $id): RedirectResponse
    {
        $isUpdated = false;

        if ($pemeriksaanRequest->all() !== []) {
            Pemeriksaan::find($id)->update($pemeriksaanRequest->all());
            $isUpdated = true;
        }

        if ($lansiaRequest->all() !== []) {
            PemeriksaanLansia::find($id)->update($lansiaRequest->all());
            $isUpdated = true;
        }

        return redirect()->intended(route('lansia.index'))
            ->with('success', $isUpdated ? 'Data lansia berhasil diubah' : 'Namun Data lansia tidak diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $check = Pemeriksaan::find($id);
        if(!$check) {
            return redirect()->intended('kader/lansia')->with('error', 'Data pemeriksaan lansia tidak ditemukan');
        }

        try {
            /**
             * delete pemeriksaans column that also cascade to pemeriksaan_lansias column, because we use cascadeOnDelete() in migration
             */
            Pemeriksaan::destroy($id);

            return redirect()->intended('kader/lansia')->with('success', 'Data pemeriksaan lansia berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->intended('kader/lansia')->with('error', 'Data pemeriksaan lansia gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}