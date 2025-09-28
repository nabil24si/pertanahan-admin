<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'persil_id' => 201,
            'kode_persil' => 'C-002-0221-01',
            'pemilik_warga_id' => 231,
            'luas_m2'=> 450,
            'penggunaan' => 1,
            'alamat_tanah' => 'Jl. Umban Sari atas ',
            'rt' => '002',
            'rw' => '003',
        ];

        return view ("persil", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
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
