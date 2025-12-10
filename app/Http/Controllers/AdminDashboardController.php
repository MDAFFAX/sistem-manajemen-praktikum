<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total Dosen
        $totalDosen = DB::table('dosens')->count();

        // Total Mata Kuliah Praktikum
        $totalMataKuliah = DB::table('mata_kuliah_praktikums')->count();

        // Total Lowongan Asisten Praktikum Aktif
        $totalLowonganAktif = DB::table('lowongan_asisten_praktikums')
            ->where('status', 'Aktif')
            ->count();

        // Total Berkas Perlu Verifikasi (Status Menunggu)
        $berkasMenunggu = DB::table('pendaftaran_asprak')
            ->where('status', 'Menunggu')
            ->count();

        return view('admin.dashboard', [
            'role' => 'Admin',
            'activeMenu' => 'dashboard',
            'sidebarType' => 'admin',
            'totalDosen' => $totalDosen,
            'totalMataKuliah' => $totalMataKuliah,
            'totalLowonganAktif' => $totalLowonganAktif,
            'berkasMenunggu' => $berkasMenunggu,
        ]);
    }
}
