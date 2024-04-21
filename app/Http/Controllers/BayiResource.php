<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class BayiResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Bayi'
        ];

        $activeMenu = 'bayi';

        $penduduks = Pemeriksaan::with('penduduk')->where('golongan', 'bayi')->get();

        return view('kader.bayi.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'penduduks' => $penduduks]);
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

        return view('kader.bayi.tambah', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
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
        $bayiData = Pemeriksaan::with('pemeriksaan_bayi', 'penduduk')->find($id);
        $parentData = Penduduk::where('NKK', $bayiData->penduduk->NKK)
            ->where('hubungan_keluarga', '!=', 'Anak')
            ->get(['nama', 'hubungan_keluarga']);

        $breadcrumb = (object) [
            'title' => 'Pemeriksaan Bayi'
        ];

        $activeMenu = 'bayi';

        return view('kader.bayi.detail', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'bayiData' => $bayiData, 'parentData' => $parentData]);
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

        return view('kader.bayi.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
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
        //
    }
}
