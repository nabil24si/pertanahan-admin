<?php
namespace App\Http\Controllers;

use App\Models\DokumenPersil;
use App\Models\JenisPenggunaan;
use App\Models\Persil;
use App\Models\PetaPersil;
use App\Models\SengketaPersil;
use App\Models\Warga;
use Illuminate\Http\Request;

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
            // 🔥 INI YANG BENAR
            'sengketaDiproses'    => SengketaPersil::where('status', 'diproses')->count(),
            'jenisPenggunaan'     => JenisPenggunaan::select('nama_penggunaan')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('nama_penggunaan')
                ->pluck('total', 'nama_penggunaan')
                ->toArray(),
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
