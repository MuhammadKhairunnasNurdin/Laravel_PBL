<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request): RedirectResponse
    {
        $data = $request->except(['_token', 'date', 'month', 'year']);

        $data['kader_id'] = $this->kader_id();
        $data['tgl_kegiatan'] = Carbon::create($request->year, $request->month, $request->date)->format('Y-m-d');

        $validator = Validator::make($data, $this->rules());

        if ($validator->fails()) {
            return redirect()->intended(route('kegiatan.index'))
                ->withErrors($validator->errors(), 'errors');
        }

        Kegiatan::insert($validator->getData());

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
        $kegiatans = Kegiatan::find($id);

        return view('kader.informasi.kegiatan.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'kegiatans' => $kegiatans]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->except(['_token', 'date', 'month', 'year']);

        $data['kader_id'] = $this->kader_id();
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

    private function rules(): array
    {
        return [
            'kader_id' => [
              'bail',
              'required',
              'exists:kaders',
            ],
            'nama' => [
                'bail',
                'required',
                'string',
                'max:100',
                'min:5'
            ],
            'tgl_kegiatan' => [
                'bail',
                'required',
                'date'
            ],
            'jam_mulai' => [
                'bail',
                'required',
            ],
            'tempat' => [
                'bail',
                'required',
                'string',
                'max:200',
                'min:5'
            ]
        ];
    }

    private function kader_id(): int
    {
        return Kader::where('user_id', '=', Auth::id())->first('kader_id')->kader_id;
    }
}
