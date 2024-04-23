<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
        $kegiatans = Kegiatan::get(['kegiatan_id', 'nama']);

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
    public function store(Request $request)
    {
        //
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
        $kegiatans = Kegiatan::find($id);

        return view('kader.informasi.kegiatan.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'kegiatans' => $kegiatans]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
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
