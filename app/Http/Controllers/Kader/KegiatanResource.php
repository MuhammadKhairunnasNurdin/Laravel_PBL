<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\Kegiatan\StoreKegiatanRequest;
use App\Http\Requests\Kader\Kegiatan\UpdateKegiatanRequest;
use App\Models\Kegiatan;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;

class KegiatanResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Kelola Informasi'
        ];

        $activeMenu = 'info';

        /**
         * Retrieve data for filter feature
         */
        $kegiatans = Kegiatan::paginate(10);

        return view('kader.informasi.kegiatan.list', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'kegiatans' => $kegiatans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Kelola Informasi'
        ];

        $activeMenu = 'info';

        return view('kader.informasi.kegiatan.tambahKegiatan', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKegiatanRequest $request): RedirectResponse
    {
        Kegiatan::insert($request->all());
        return redirect()->intended(route('kegiatan.index'))
            ->with('success', 'kegiatan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Kelola Informasi'
        ];

        $activeMenu = 'info';

        /**
         * Retrieve data for filter feature
         */
        $kegiatan = Kegiatan::find($id);

        return view('kader.informasi.kegiatan.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'kegiatan' => $kegiatan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKegiatanRequest $request, string $id): RedirectResponse
    {
        $isUpdated = false;
        if ($request != []) {
            $isUpdated = Kegiatan::find($id)->update($request->all());
        }

        return redirect()->intended(route('kegiatan.index'))
            ->with('success', $isUpdated ? 'Data Kegiatan berhasil diubah' : 'Namun Data Kegiatan tidak diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $check = Kegiatan::find($id);
        if(!$check) {
            return redirect()->intended('kader/informasi/kegiatan')->with('error', 'Data kegiatan tidak ditemukan');
        }

        try {
            /**
             * delete pemeriksaans column that also cascade to pemeriksaan_bayis column, because we use cascadeOnDelete() in migration
             */
            Kegiatan::destroy($id);

            return redirect()->intended('kader/informasi/kegiatan')->with('success', 'Data kegiatan berhasil dihapus');
        } catch (QueryException) {
            return redirect()->intended('kader/informasi/kegiatan')->with('error', 'Data kegiatan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}