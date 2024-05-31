<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\Artikel\StoreArtikelRequest;
use App\Http\Requests\Kader\Artikel\UpdateArtikelRequest;
use App\Models\Artikel;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArtikelResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::all();

        $breadcrumb = (object) [
            'title' => 'Kelola Informasi'
        ];

        $activeMenu = 'info';

        return view('kader.informasi.artikel.list', compact('breadcrumb', 'activeMenu', 'artikels'));
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

        return view('kader.informasi.artikel.tambahArtikel', compact('breadcrumb', 'activeMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtikelRequest $request): RedirectResponse
    {
        Artikel::create($request->input());
        return redirect()->intended(route('artikel.index'))
            ->with('success', 'Data artikel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artikel = Artikel::find($id);
        if ($artikel === null) {
            return redirect()->intended(route('artikel.index'))->with('error', 'Data artikel tidak ditemukan atau mungkin sudah dihapus kader lain');
        }

        $breadcrumb = (object) [
            'title' => 'Kelola Informasi'
        ];

        $activeMenu = 'info';

        return view('kader.informasi.artikel.detail', compact('breadcrumb', 'activeMenu', 'artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikel = Artikel::find($id);
        if ($artikel === null) {
            return redirect()->intended(route('artikel.index'))->with('error', 'Data artikel tidak ditemukan atau mungkin sudah dihapus kader lain');
        }

        $breadcrumb = (object) [
            'title' => 'Kelola Informasi'
        ];

        $activeMenu = 'info';

        $tags = explode(',', $artikel->tag);

        $foto_artikel_path = substr(parse_url($artikel->foto_artikel, PHP_URL_PATH), 1);

        return view('kader.informasi.artikel.edit', compact('breadcrumb', 'activeMenu', 'artikel', 'tags', 'foto_artikel_path'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtikelRequest $request, string $id): RedirectResponse
    {
        /**
         * try database transaction, because we use sql type
         * database(mysql), to prevent database race condition when
         * update data, we use transaction to rollback if there are any
         * error and catch that error mesasge to display in view
         */
        try {
            /**
             * return $isUpdated for checking update data not just
             * submit when not actually changes
             */
            $isUpdated =  DB::transaction(function () use ($request, $id) {
                $isUpdated = false;

                /**
                 * lock and update with queue artikels table
                 * to prevent database race condition
                 *
                 * and check if use has change column in artikels table
                 */
                $artikel = Artikel::lockForUpdate()->find($id);
                if ($request->input() !== [] and $artikel !== null) {
                    /**
                     * delete image foto_artikel in public directory if user fill foto_artikel input
                     */
                    if ($request->has('foto_artikel')) {
                        /**
                         * delete foto_artikel that saved in public/artikel directory
                         */
                        $foto_artikel = $artikel->foto_artikel;
                        /**
                         * using parse_url to remove url like: http://127.0.0.1:8000 or PHP_URL_PATH
                         *
                         * using substr() with offset 9 to remove: /artikel/
                         *
                         * result from those logic: hashName.extension
                         */
                        $foto_artikel = substr(parse_url($foto_artikel, PHP_URL_PATH), 9);
                        /**
                         * delete image foto_artikel in public directory
                         */
                        Storage::disk('artikel_img')->delete($foto_artikel);
                    }
                    /**
                     * fill $isUpdated to use in checking update
                     * action
                     */
                    $isUpdated = $artikel->update($request->input());
                }

                return $isUpdated;
            });

            return redirect()->intended(route('artikel.index'))
                ->with('success', $isUpdated ? 'Data artikel berhasil diubah' : 'Namun Data artikel tidak diubah');

        } catch (\Throwable $e) {
            return redirect()->intended(route('artikel.index'))
                ->with('error', 'Terjadi Masalah Ketika mengubah Data artikel: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
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
                $artikel = Artikel::lockForUpdate()->find($id);
                if ($artikel === null) {
                    return redirect()->intended(route('artikel.index'))->with('error', 'Data artikel tidak ditemukan');
                }

                /**
                 * check if other user is update our data when we do delete action
                 */
                if ($artikel->updated_at > $request->input('updated_at')) {
                    return redirect()->intended(route('artikel.index'))->with('error', 'Data artikel masih di update oleh kader lain, coba refresh dan lakukan hapus lagi');
                }

                /**
                 * delete foto_artikel that saved in public/artikel directory
                 */
                $foto_artikel = $artikel->foto_artikel;
                /**
                 * using parse_url to remove url like: http://127.0.0.1:8000 or PHP_URL_PATH
                 *
                 * using substr() with offset 9 to remove: /artikel/
                 *
                 * result from those logic: hashName.extension
                 */
                $foto_artikel = substr(parse_url($foto_artikel, PHP_URL_PATH), 9);
                if (Storage::disk('artikel_img')->exists($foto_artikel)) {
                    /**
                     * delete image foto_artikel in public directory
                     */
                    Storage::disk('artikel_img')->delete($foto_artikel);
                }

                /**
                 * delete artikel data in database
                 */
                $artikel->delete();

                return redirect()->intended(route('artikel.index'))->with('success', 'Data artikel berhasil dihapus');
            });
        } catch (QueryException) {
            return redirect()->intended(route('artikel.index'))->with('error', 'Data artikel gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        } catch (\Throwable $e) {
            return redirect()->intended(route('artikel.index'))->with('error', 'Terjadi Masalah Ketika menghapus Data artikel: ' . $e->getMessage());
        }
    }
}
