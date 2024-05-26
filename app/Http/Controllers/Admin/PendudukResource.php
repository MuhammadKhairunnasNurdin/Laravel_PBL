<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Penduduk\StorePendudukRequest;
use App\Http\Requests\Admin\Penduduk\UpdatePendudukRequest;
use App\Models\Penduduk;
use App\Services\FilterServices;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendudukResource extends Controller
{
    private FilterServices $filter;

    public function __construct(FilterServices $filter)
    {
        $this->filter = $filter;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Data Penduduk'
        ];

        $activeMenu = 'penduduk';

        /**
         * Retrieve data for filter feature
         */
        // $penduduks = Penduduk::paginate(10);
        $penduduks = $this->filter->getFilteredData($request)->paginate(10);
        $penduduks->appends(request()->all());

        return view('admin.penduduk.index', compact('breadcrumb', 'activeMenu', 'penduduks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Data Penduduk'
        ];

        $activeMenu = 'penduduk';

        return view('admin.penduduk.tambah', compact('breadcrumb', 'activeMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePendudukRequest $request): RedirectResponse
    {
        Penduduk::create($request->all());

        return redirect()->intended('admin/penduduk' . session('urlPagination'))
            ->with('success', 'Data penduduk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penduduk = Penduduk::find($id);
        if ($penduduk === null) {
            return redirect()->intended('admin/penduduk' . session('urlPagination'))->with('error', 'Data penduduk tidak ditemukan atau mungkin sudah dihapus admin lain');
        }

        $breadcrumb = (object) [
            'title' => 'Data Penduduk'
        ];

        $activeMenu = 'penduduk';

        return view('admin.penduduk.detail', compact('breadcrumb', 'activeMenu', 'penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penduduk = Penduduk::find($id);
        if ($penduduk === null) {
            return redirect()->intended('admin/penduduk' . session('urlPagination'))->with('error', 'Data penduduk tidak ditemukan atau mungkin sudah dihapus admin lain');
        }

        $breadcrumb = (object) [
            'title' => 'Data Penduduk'
        ];

        $activeMenu = 'penduduk';

        return view('admin.penduduk.edit', compact('breadcrumb', 'activeMenu', 'penduduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendudukRequest $request, string $id): RedirectResponse
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
                 * lock and update with queue penduduks table
                 * to prevent database race condition
                 *
                 * and check if use has change column in penduduks table
                 */
                $penduduk = Penduduk::lockForUpdate()->find($id);
                if ($request->all() !== [] and $penduduk !== null) {
                    /**
                     * fill $isUpdated to use in checking update
                     * action
                     */
                    $isUpdated = $penduduk->update($request->all());
                }

                return $isUpdated;
            });

            return redirect()->intended('admin/penduduk' . session('urlPagination'))
                ->with('success', $isUpdated ? 'Data penduduk berhasil diubah' : 'Namun Data penduduk tidak diubah');

        } catch (\Throwable $e) {
            return redirect()->intended('admin/penduduk' . session('urlPagination'))
                ->with('error', 'Terjadi Masalah Ketika mengubah Data penduduk: ' . $e->getMessage());
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
                 * lock and delete with queue penduduks table
                 * to prevent database race condition
                 */
                $penduduk = Penduduk::lockForUpdate()->find($id);
                if ($penduduk === null) {
                    return redirect()->intended('admin/penduduk' . session('urlPagination'))->with('error', 'Data penduduk tidak ditemukan');
                }

                /**
                 * check if other user is update our data when we do delete action
                 */
                if ($penduduk->updated_at > $request->input('updated_at')) {
                    return redirect()->intended('admin/penduduk' . session('urlPagination'))->with('error', 'Data penduduk masih di update oleh admin lain, coba refresh dan lakukan hapus lagi');
                }

                $penduduk->delete();

                return redirect()->intended('admin/penduduk' . session('urlPagination'))->with('success', 'Data penduduk berhasil dihapus');
            });
        } catch (QueryException) {
            return redirect()->intended('admin/penduduk' . session('urlPagination'))->with('error', 'Data penduduk gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        } catch (\Throwable $e) {
            return redirect()->intended('admin/penduduk' . session('urlPagination'))->with('error', 'Terjadi Masalah Ketika menghapus Data penduduk: ' . $e->getMessage());
        }
    }
}