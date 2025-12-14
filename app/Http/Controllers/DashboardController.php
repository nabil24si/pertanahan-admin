<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Persil;
use App\Models\PetaPersil;
use Illuminate\Http\Request;
use App\Models\DokumenPersil;
use App\Models\SengketaPersil;
use App\Models\JenisPenggunaan;

class DashboardController extends Controller
{

    public function index()
    {
        $data = [
            'totalWarga'          => Warga::count(),
            'totalPersil'         => Persil::count(),
            'totalDokumenPersil'  => DokumenPersil::count(),
            'totalSengketaPersil' => SengketaPersil::count(),
            'totalPetaPersil'     => PetaPersil::count(),
            'totalJenisPenggunaan'     => JenisPenggunaan::count(),
            // Tambahkan data penggunaan di bawah jika diperlukan
        ];

        return view('pages.dashboard', $data);
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
