<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

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

        return view('kader.informasi.artikel.list', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'artikels' => $artikels]);
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

        return view('kader.informasi.artikel.tambahArtikel', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
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
        $artikel = Artikel::find($id);

        $breadcrumb = (object) [
            'title' => 'Kelola Informasi'
        ];

        $activeMenu = 'info';

        return view('kader.informasi.artikel.detail', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'artikel' => $artikel]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
