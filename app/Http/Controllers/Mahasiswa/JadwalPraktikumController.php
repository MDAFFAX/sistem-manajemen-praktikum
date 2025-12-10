<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class JadwalPraktikumController extends Controller
{
    /**
     * Tampilkan jadwal praktikum yang ditetapkan admin.
     */
    public function index()
    {
        $jadwals = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('jadwal_asisten_praktikums')) {
                $jadwals = DB::table('jadwal_asisten_praktikums')
                    ->orderBy('hari')
                    ->orderBy('jam')
                    ->orderBy('kode_mata_kuliah')
                    ->get();
            }
        } catch (\Throwable $e) {
            $jadwals = [];
        }

        return view('mahasiswa.jadwal-praktikum', [
            'role' => 'MAHASISWA',
            'activeMenu' => 'jadwal-praktikum',
            'sidebarType' => 'mahasiswa',
            'jadwals' => $jadwals,
        ]);
    }
}




