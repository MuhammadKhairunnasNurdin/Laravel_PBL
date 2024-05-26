<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\Kegiatan\StoreKegiatanRequest;
use App\Http\Requests\Kader\Kegiatan\UpdateKegiatanRequest;
use App\Models\Kegiatan;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('kader.informasi.kegiatan.list', compact('breadcrumb', 'activeMenu', 'kegiatans'));
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

        return view('kader.informasi.kegiatan.tambahKegiatan', compact('breadcrumb', 'activeMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKegiatanRequest $request): RedirectResponse
    {
        Kegiatan::create($request->all());
        return redirect()->intended('kader/informasi/kegiatan' . session('urlPagination'))
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
        if ($kegiatan === null) {
            return redirect()->intended('kader/informasi/kegiatan' . session('urlPagination'))
                ->with('error', 'kegiatan tidak ditemukan atau mungki dihapus oleh kader lain');
        }

        return view('kader.informasi.kegiatan.edit', compact('breadcrumb', 'activeMenu', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKegiatanRequest $request, string $id): RedirectResponse
    {
        try {
            $isUpdated = DB::transaction(function () use ($request, $id) {
                $isUpdated = false;
                $kegiatan = Kegiatan::lockForUpdate()->find($id);
                if ($request->all() !== [] and $kegiatan !== null) {
                    $isUpdated = $kegiatan->update($request->all());
                }
                return $isUpdated;
            });

            return redirect()->intended('kader/informasi/kegiatan' . session('urlPagination'))
                    ->with('success', $isUpdated ? 'Data Kegiatan berhasil diubah' : 'Namun Data Kegiatan tidak diubah');
        } catch (\Throwable $e) {
            return redirect()->intended('kader/informasi/kegiatan' . session('urlPagination'))
                ->with('error', 'Terjadi Masalah Ketika mengubah Data Kegiatan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request): RedirectResponse
    {
        /**
         * try database transaction, because we use sql type
         * database(mysql), to prevent database race condition when
         * delete data, we use transaction to rollback if there are any
         * error and catch that error mesasge to display in view
         */
        try {
            return DB::transaction(function () use ($id, $request) {
                /**
                 * lock and delete with queue kagiatans table
                 * to prevent database race condition
                 */
                $kegiatan = Kegiatan::lockForUpdate()->find($id);
                if ($kegiatan === null) {
                    return redirect()->intended('kader/informasi/kegiatan' . session('urlPagination'))->with('error', 'Data kegiatan tidak ditemukan');
                }

                /**
                 * check if other user is update our data when we do delete action
                 */
                if ($kegiatan->updated_at > $request->input('updated_at')) {
                    return redirect()->intended('kader/informasi/kegiatan' . session('urlPagination'))->with('error', 'Data Kegiatan masih di update oleh kader lain, coba refresh dan lakukan hapus lagi');
                }

                /**
                 * delete kegiatan data in database
                 */
                $kegiatan->delete();

                return redirect()->intended('kader/informasi/kegiatan' . session('urlPagination'))->with('success', 'Data kegiatan berhasil dihapus');
            });
        } catch (QueryException) {
            return redirect()->intended('kader/informasi/kegiatan' . session('urlPagination'))->with('error', 'Data kegiatan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        } catch (\Throwable $e) {
            return redirect()->intended('kader/informasi/kegiatan' . session('urlPagination'))->with('error', 'Terjadi Masalah Ketika menghapus Data Kegiatan: ' . $e->getMessage());
        }
    }
}
