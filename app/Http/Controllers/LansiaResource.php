<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('kader.lansia.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
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
        $breadcrumb = (object)[
            'title' => 'Pemeriksaan Lansia'
        ];

        $activeMenu = 'lansia';

        return view('kader.lansia.detail', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcrumb = (object)[
            'title' => 'Pemeriksaan Lansia'
        ];

        $activeMenu = 'lansia';

        return view('kader.lansia.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
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
