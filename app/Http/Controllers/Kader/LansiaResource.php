<?php

namespace App\Http\Controllers\Kader;

use App\Events\Lansia\PemeriksaanLansiaCreated;
use App\Events\Lansia\PemeriksaanLansiaUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\Lansia\StoreLansiaRequest;
use App\Http\Requests\Kader\Lansia\UpdateLansiaRequest;
use App\Http\Requests\Kader\Pemeriksaan\StorePemeriksaanRequest;
use App\Http\Requests\Kader\Pemeriksaan\UpdatePemeriksaanRequest;
use App\Models\Kader;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanLansia;
use App\Models\Penduduk;
use App\Services\FilterServices;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LansiaResource extends Controller
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
            'title' => 'Pemeriksaan Lansia'
        ];

        $activeMenu = 'lansia';

        /**
         * Retrieve data for filter feature
         */
        // $penduduks = Pemeriksaan::with('penduduk')->where('golongan', 'lansia')->paginate(10);
        $penduduks = $this->filter->getFilteredDataLansia($request)->paginate(10);
        $penduduks->appends(request()->all());
        
        return view('kader.lansia.index', compact('breadcrumb', 'activeMenu', 'penduduks'));
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

        return view('kader.lansia.tambah', compact('breadcrumb', 'activeMenu', 'lansiasData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLansiaRequest $lansiaRequest, StorePemeriksaanRequest $pemeriksaanRequest): RedirectResponse
    {
        $pemeriksaan = Pemeriksaan::create($pemeriksaanRequest->all());
        $lansiaRequest->merge([
            'pemeriksaan_id' => $pemeriksaan->pemeriksaan_id
        ]);
        $pemeriksaanLansia = PemeriksaanLansia::create($lansiaRequest->all());

        event(new PemeriksaanLansiaCreated($pemeriksaan, $pemeriksaanLansia));

        return redirect()->intended('kader/lansia' . session('urlPagination'))
            ->with('success', 'Data Lansia berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lansiaData = Pemeriksaan::with('pemeriksaan_lansia', 'penduduk')->find($id);
        if ($lansiaData === null) {
            return redirect()->intended('kader/lansia' . session('urlPagination'))->with('error', 'Data pemeriksaan lansia tidak ditemukan atau mungkin sudah dihapus kader lain');
        }

        $kader = Kader::find($lansiaData->kader_id)->only('penduduk_id')['penduduk_id'];
        $namaKader = Penduduk::find($kader)->only('nama')['nama'];


        $breadcrumb = (object)[
            'title' => 'Pemeriksaan Lansia'
        ];

        $activeMenu = 'lansia';

        return view('kader.lansia.detail', compact('breadcrumb', 'activeMenu', 'lansiaData', 'namaKader'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lansiaData = Pemeriksaan::with('pemeriksaan_lansia', 'penduduk')->lockForUpdate()->find($id);
        if ($lansiaData === null) {
            return redirect()->intended('kader/lansia' . session('urlPagination'))->with('error', 'Data pemeriksaan lansia tidak ditemukan atau mungkin sudah dihapus kader lain');
        }

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
            $isUpdated =  DB::transaction(function () use ($lansiaRequest, $pemeriksaanRequest, $id) {
                $isUpdated = false;
                /**
                 * retrieve original data from update action below for
                 * event
                 */
                $originalPemeriksaan = new Collection();
                $originalLansia = new Collection();

                /**
                 * lock and update with queue pemeriksaan table
                 * to prevent database race condition
                 *
                 * and check if use has change column in pemeriksaans table
                 */
                $pemeriksaan = Pemeriksaan::lockForUpdate()->find($id);
                if ($pemeriksaanRequest->all() !== [] and $pemeriksaan !== null) {
                    /**
                     * fill $isUpdated to use in checking update
                     * action and clone pemeriksaan model data to
                     * retrieve original data before update also use
                     * that data in event
                     */
                    $originalPemeriksaan = clone $pemeriksaan;
                    $isUpdated = $pemeriksaan->update($pemeriksaanRequest->all());
                }

                /**
                 * lock and update with queue pemeriksaanLansia table
                 * to prevent database race condition
                 *
                 * and check if use has change column in pemeriksaan_lansias table
                 */
                $pemeriksaanLansia = PemeriksaanLansia::lockForUpdate()->find($id);
                if ($lansiaRequest->all() !== [] and $pemeriksaanLansia !== null) {
                    /**
                     * fill $isUpdated to use in checking update
                     * action and clone pemeriksaanLansia model data to
                     * retrieve original data before update also use
                     * that data in event
                     */
                    $originalLansia = clone $pemeriksaanLansia;
                    $isUpdated = PemeriksaanLansia::find($id)->update($lansiaRequest->all());
                }

                /**
                 * running event when update success to fill
                 * automatically audit_bulanan_lansias from our data
                 * updated
                 */
                event(new PemeriksaanLansiaUpdated(
                    pemeriksaan_id: $id,
                    originalPemeriksaan: $originalPemeriksaan,
                    originalPemeriksaanLansia: $originalLansia,
                    updatedPemeriksaan: $pemeriksaanRequest->all(),
                    updatedPemeriksaanLansia: $lansiaRequest->all())
                );

                return $isUpdated;
            });

            return redirect()->intended('kader/lansia' . session('urlPagination'))
                ->with('success', $isUpdated ? 'Data lansia berhasil diubah' : 'Namun Data lansia tidak diubah');

        } catch (\Throwable $e) {
            return redirect()->intended('kader/lansia' . session('urlPagination'))
                ->with('error', 'Terjadi Masalah Ketika mengubah Data Lansia: ' . $e->getMessage());
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
                 * lock and delete with queue pemeriksaan table
                 * to prevent database race condition
                 */
                $pemeriksaan = Pemeriksaan::lockForUpdate()->find($id);
                if ($pemeriksaan === null) {
                    return redirect()->intended('kader/lansia' . session('urlPagination'))->with('error', 'Data pemeriksaan lansia tidak ditemukan');
                }

                /**
                 * check if other user is update our data when we do delete action
                 */
                if ($pemeriksaan->updated_at > $request->input('updated_at')) {
                    return redirect()->intended('kader/lansia' . session('urlPagination'))->with('error', 'Data Lansia masih di update oleh kader lain, coba refresh dan lakukan hapus lagi');
                }

                /**
                 * delete pemeriksaans column that also cascade to pemeriksaan_lansias column, because we use cascadeOnDelete() in migration
                 */
                $pemeriksaan->delete();

                return redirect()->intended('kader/lansia' . session('urlPagination'))->with('success', 'Data pemeriksaan lansia berhasil dihapus');
            });
        } catch (QueryException) {
            return redirect()->intended('kader/lansia' . session('urlPagination'))->with('error', 'Data pemeriksaan lansia gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        } catch (\Throwable $e) {
            return redirect()->intended('kader/lansia' . session('urlPagination'))->with('error', 'Terjadi Masalah Ketika menghapus Data Lansia: ' . $e->getMessage());
        }
    }
}