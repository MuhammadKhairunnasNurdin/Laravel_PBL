<?php

namespace App\Http\Controllers\Kader;

use App\Events\Bayi\PemeriksaanBayiCreated;
use App\Events\Bayi\PemeriksaanBayiUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kader\Bayi\StoreBayiRequest;
use App\Http\Requests\Kader\Bayi\UpdateBayiRequest;
use App\Http\Requests\Kader\Pemeriksaan\StorePemeriksaanRequest;
use App\Http\Requests\Kader\Pemeriksaan\UpdatePemeriksaanRequest;
use App\Models\Kader;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanBayi;
use App\Models\Penduduk;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\b;

class BayiResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Bayi'
        ];

        $activeMenu = 'bayi';

        /**
         * Retrieve data for filter feature
         */
        $penduduks = Pemeriksaan::with('penduduk', 'pemeriksaan_bayi')->where('golongan', 'bayi')->paginate(10);

        return view('kader.bayi.index', compact('breadcrumb', 'activeMenu', 'penduduks'));
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

        $bayisData = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) <= 5')->get(['penduduk_id', 'nama', 'alamat', 'NKK', 'tgl_lahir']);

        $parentsData = Penduduk::where('hubungan_keluarga', '!=', 'Anak')
            ->get(['nama', 'hubungan_keluarga', 'NKK', 'penduduk_id']);

        return view('kader.bayi.tambah', compact('breadcrumb', 'activeMenu', 'bayisData', 'parentsData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBayiRequest $bayiRequest, StorePemeriksaanRequest $pemeriksaanRequest): RedirectResponse
    {
        $pemeriksaan = Pemeriksaan::create($pemeriksaanRequest->all());
        $bayiRequest->merge([
            'pemeriksaan_id' => $pemeriksaan->pemeriksaan_id
        ]);
        $pemeriksaanBayi = PemeriksaanBayi::create($bayiRequest->all());

        event(new PemeriksaanBayiCreated($pemeriksaan, $pemeriksaanBayi));

        return redirect()->intended('kader/bayi' . session('urlPagination'))
            ->with('success', 'Data Bayi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Bayi'
        ];

        $activeMenu = 'bayi';

        $bayiData = Pemeriksaan::with('pemeriksaan_bayi', 'penduduk')->find($id);
        if ($bayiData === null) {
            return redirect()->intended('kader/bayi' . session('urlPagination'))->with('error', 'Data pemeriksaan bayi tidak ditemukan atau mungkin sudah dihapus kader lain');
        }

        $parentData = Penduduk::where('NKK', $bayiData->penduduk->NKK)
            ->where('hubungan_keluarga', '!=', 'Anak')
            ->get(['nama', 'hubungan_keluarga']);
        $ibu = $parentData->firstWhere('hubungan_keluarga', 'Istri')->nama ?? 'Tidak Ada Ibu';
        $ayah = $parentData->firstWhere('hubungan_keluarga', 'Kepala Keluarga')->nama ?? 'Tidak Ada Ayah';

        $kader = Kader::find($bayiData->kader_id)->only('penduduk_id')['penduduk_id'];
        $namaKader = Penduduk::find($kader)->only('nama')['nama'];

        return view('kader.bayi.detail', compact('breadcrumb', 'activeMenu', 'ibu', 'ayah', 'namaKader', 'bayiData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Bayi'
        ];

        $activeMenu = 'bayi';

        $bayiData = Pemeriksaan::with('pemeriksaan_bayi', 'penduduk')->lockForUpdate()->find($id);
        if ($bayiData === null) {
            return redirect()->intended('kader/bayi' . session('urlPagination'))->with('error', 'Data pemeriksaan bayi tidak ditemukan atau mungkin sudah dihapus');
        }

        $parentData = Penduduk::where('NKK', $bayiData->penduduk->NKK)
            ->where('hubungan_keluarga', '!=', 'Anak')
            ->get(['nama', 'hubungan_keluarga', 'penduduk_id']);

        return view('kader.bayi.edit', compact('breadcrumb', 'activeMenu', 'bayiData', 'parentData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBayiRequest $bayiRequest, UpdatePemeriksaanRequest $pemeriksaanRequest, string $id): RedirectResponse
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
            $isUpdated = DB::transaction(function () use ($bayiRequest, $pemeriksaanRequest, $id) {
                $isUpdated = false;
                /**
                 * retrieve original data from update action below for
                 * event
                 */
                $originalPemeriksaan = new Collection();
                $originalBayi = new Collection();

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
                 * lock and update with queue pemeriksaan table
                 * to prevent database race condition
                 *
                 * and check if use has change column in pemeriksaan_bayis table
                 */
                $pemeriksaanBayi = PemeriksaanBayi::lockForUpdate()->find($id);
                if ($bayiRequest->all() !== [] and $pemeriksaanBayi !== null) {
                    /**
                     * fill $isUpdated to use in checking update
                     * action and clone pemeriksaanBayi model data to
                     * retrieve original data before update also use
                     * that data in event
                     */
                    $originalBayi = clone $pemeriksaanBayi;
                    $isUpdated = $pemeriksaanBayi->update($bayiRequest->all());
                }

                /**
                 * running event when update success to fill
                 * automatically audit_bulanan_bayis from our data
                 * updated
                 */
                event(new PemeriksaanBayiUpdated(
                    pemeriksaan_id: $id,
                    originalPemeriksaan: $originalPemeriksaan,
                    originalPemeriksaanBayi: $originalBayi,
                    updatedPemeriksaan: $pemeriksaanRequest->all(),
                    updatedPemeriksaanBayi: $bayiRequest->all()));

                return $isUpdated;
            });

            return redirect()->intended('kader/bayi' . session('urlPagination'))
                ->with('success', $isUpdated ? 'Data Bayi berhasil diubah' : 'Namun Data Bayi tidak diubah');
        } catch (\Throwable $e) {
            return redirect()->intended('kader/bayi' . session('urlPagination'))
                ->with('error', 'Terjadi Masalah Ketika mengubah Data Bayi: ' . $e->getMessage());
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
                    return redirect()->intended('kader/bayi' . session('urlPagination'))->with('error', 'Data pemeriksaan bayi tidak ditemukan');
                }

                /**
                 * check if other user is update our data when we do delete action
                 */
                if ($pemeriksaan->updated_at > $request->input('updated_at')) {
                    return redirect()->intended('kader/bayi' . session('urlPagination'))->with('error', 'Data Bayi masih di update oleh kader lain, coba refresh dan lakukan hapus lagi');
                }

                /**
                 * delete pemeriksaans column that also cascade to pemeriksaan_bayis column, because we use cascadeOnDelete() in migration
                 */
                $pemeriksaan->delete();

                return redirect()->intended('kader/bayi' . session('urlPagination'))->with('success', 'Data pemeriksaan bayi berhasil dihapus');
            });
        } catch (QueryException) {
            return redirect()->intended('kader/bayi' . session('urlPagination'))->with('error', 'Data pemeriksaan bayi gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        } catch (\Throwable $e) {
            return redirect()->intended('kader/bayi')->with('error', 'Terjadi Masalah Ketika menghapus Data Bayi: ' . $e->getMessage());
        }
    }

    // ORIGINALLY HERE
    public function getFilteredData(Request $request)
    {
        $query = Pemeriksaan::with('pemeriksaan_bayi', 'penduduk')->orderBy('status', 'asc');

        if ($request->has('statusKes')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('golUmur')) {
            $query->where('golongan', $request->input('golongan'));
        }

        return $query;
    }
}
