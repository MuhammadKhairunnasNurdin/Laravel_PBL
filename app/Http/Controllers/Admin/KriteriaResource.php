<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Kriteria\StoreKriteriaRequest;
use App\Http\Requests\Admin\Kriteria\UpdateKriteriaRequest;
use App\Models\Kriteria;
use App\Models\RentangKriteria;
use App\Services\FilterServices;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class KriteriaResource extends Controller
{
    // private FilterServices $filter;

    public function __construct( private readonly FilterServices $filter)
    {
        // $this->filter = $filter;
    }
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Sistem Pengambilan Keputusan'
        ];

        $activeMenu = 'bantuan';

        $kriterias = Kriteria::paginate(10);
        // $kriterias = $this->filter->getFilteredData($request)->paginate(10);
        // $kriterias->appends(request()->all());

        return view('admin.bantuan.index', compact('breadcrumb', 'activeMenu', 'kriterias'));
    }
    public function create() 
    {
        $breadcrumb = (object) [
            'title' => 'Sistem Pengambilan Keputusan'
        ];

        $activeMenu = 'bantuan';

        $kriteria = Kriteria::all();
        $rentangs = RentangKriteria::orderBy('nilai', 'asc')->paginate(10);

        return view('admin.bantuan.tambah', compact('breadcrumb', 'activeMenu', 'kriteria', 'rentangs'));
    }
    public function store(StoreKriteriaRequest $kriteriaRequest): RedirectResponse 
    {
        $kriteria = Kriteria::create($kriteriaRequest->all());
        return redirect()->intended('admin/kriteria')
            ->with('success', 'Data Kriteria berhasil ditambahkan');
    }
    public function show(string $code) 
    {
        $breadcrumb = (object) [
            'title' => 'Sistem Pengambilan Keputusan'
        ];

        $activeMenu = 'bantuan';

        $kriteria = Kriteria::find($code);
        $rentang = RentangKriteria::groupBy('kode')->get('kode');
        $rentangs = RentangKriteria::where('kode', $code)->orderBy('nilai', 'asc')->paginate(10);
        // dd($rentang);

        return view('admin.bantuan.detail', compact('breadcrumb', 'activeMenu', 'kriteria', 'rentangs'));
    }
    public function edit(string $code) 
    {
        $breadcrumb = (object) [
            'title' => 'Sistem Pengambilan Keputusan'
        ];

        $activeMenu = 'bantuan';

        $kriteria = Kriteria::find($code);

        return view('admin.bantuan.edit', compact('breadcrumb', 'activeMenu', 'kriteria'));
    }
    public function update(UpdateKriteriaRequest $kriteriaRequest, string $id): RedirectResponse 
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
            $isUpdated = DB::transaction(function () use ($kriteriaRequest, $id) {
                $isUpdated = false;
                /**
                 * lock and update with queue pemeriksaan table
                 * to prevent database race condition
                 *
                 * and check if use has change column in pemeriksaans table
                 */
                $kriteria = Kriteria::lockForUpdate()->find($id);
                if ($kriteriaRequest->all() !== [] and $kriteria !== null) {
                    /**
                     * fill $isUpdated to use in checking update
                     * action and clone pemeriksaan model data to
                     * retrieve original data before update also use
                     * that data in event
                     */
                    // dd($kriteriaRequest, $kriteria);
                    $isUpdated = $kriteria->update($kriteriaRequest->all());
                }

                return $isUpdated;
            });

            return redirect()->intended('admin/kriteria')
                ->with('success', $isUpdated ? 'Data Kriteria berhasil diubah' : 'Namun Data Kriteria tidak diubah');
        } catch (\Throwable $e) {
            return redirect()->intended('admin/kritria')
                ->with('error', 'Terjadi Masalah Ketika mengubah Data Kriteria: ' . $e->getMessage());
        }
    }
    public function destroy(string $code, Request $request) : RedirectResponse
    {
        $kriteria = Kriteria::destroy($code);
        return redirect()->intended('admin/kriteria')->with('success', 'Data kriteria berhasil dihapus');
    }
}
