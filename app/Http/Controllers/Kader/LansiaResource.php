<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Kegiatan;
use App\Models\Pemeriksaan;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $penduduks = Pemeriksaan::with('penduduk')->where('golongan', 'lansia')->get();

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

        $activeMenu = 'lansia';

        return view('kader.lansia.tambah', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->except(['_token', 'date', 'month', 'year']);

        $data['tgl_kegiatan'] = Carbon::create($request->year, $request->month, $request->date)->format('Y-m-d');

        $validator = Validator::make($data, $this->rules());


        if ($validator->fails()) {
            return redirect()->intended(route('kegiatan.index'))
                ->withErrors($validator->errors(), 'errors');
        }


        Kegiatan::find($id)->update($validator->getData());

        return redirect()->intended(route('kegiatan.index'))
            ->with('success', 'kegiatan berhasil diubah');
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

    private function pemeriksaanLansiaRules(): array
    {
        return [
            'lingkar_perut' => [
                'bail',
                'required',
                'numeric'
            ],
            'gula_darah' => [
                'bail',
                'required',
                'integer'
            ],
            'kolesterol' => [
                'bail',
                'required',
                'integer'
            ],
            'tensi_darah' => [
                'bail',
                'required',
                'integer'
            ],
            'asam_urat' => [
                'bail',
                'required',
                'numeric'
            ],
        ];
    }

    private function pemeriksaanRules(): array
    {
        return [
            'kader_id' => [
                'bail',
                'required',
                'exists:kaders'
            ],
            'NIK' => [
                'bail',
                'required',
                'exists:penduduks'
            ],
            'status' => [
                'bail',
                'required',
                Rule::in(['sehat', 'sakit'])
            ],
            'golongan' => [
                'bail',
                'required',
                Rule::in(['lansia', 'bayi'])
            ],
            'tgl_pemeriksaan' => [
                'bail',
                'required',
                'date'
            ],
            'tinggi_badan' => [
                'bail',
                'required',
                'float'
            ],
            'berat_badan' => [
                'bail',
                'required',
                'float'
            ],
            'respon' => [
                'bail',
                'required',
                'text'
            ],
        ];
    }
}
