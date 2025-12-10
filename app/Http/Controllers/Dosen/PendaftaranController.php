<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of pendaftaran.
     */
    public function index()
    {
        // Get all pendaftaran data with lowongan info to get prodi
        $pendaftaran = DB::table('pendaftaran_asprak')
            ->leftJoin('lowongan_asisten_praktikums', 'pendaftaran_asprak.lowongan_id', '=', 'lowongan_asisten_praktikums.id')
            ->select('pendaftaran_asprak.*', 'lowongan_asisten_praktikums.prodi')
            ->orderBy('pendaftaran_asprak.created_at', 'desc')
            ->get();

        return view('dosen.pendaftaran.index', [
            'pendaftaran' => $pendaftaran,
            'role' => 'Dosen Praktikum',
            'activeMenu' => 'pendaftaran',
            'sidebarType' => 'dosen'
        ]);
    }

    /**
     * Display the specified pendaftaran.
     */
    public function show($id)
    {
        $pendaftaran = DB::table('pendaftaran_asprak')
            ->leftJoin('lowongan_asisten_praktikums', 'pendaftaran_asprak.lowongan_id', '=', 'lowongan_asisten_praktikums.id')
            ->select(
                'pendaftaran_asprak.*',
                'lowongan_asisten_praktikums.prodi',
                'lowongan_asisten_praktikums.mata_kuliah'
            )
            ->where('pendaftaran_asprak.id', $id)
            ->first();

        if (!$pendaftaran) {
            abort(404, 'Pendaftaran tidak ditemukan');
        }

        return view('dosen.pendaftaran.show', [
            'pendaftaran' => $pendaftaran,
            'role' => 'Dosen Praktikum',
            'activeMenu' => 'pendaftaran',
            'sidebarType' => 'dosen'
        ]);
    }

    /**
     * Download attached file (cv or transkrip) for a pendaftaran.
     */
    public function download($id, $type)
    {
        // Authorization: only admin and dosen can download files
        // Check session first, then request
        $role = session('role') ?? request('role') ?? null;
        
        // Normalize role values for comparison
        $roleLower = strtolower($role ?? '');
        
        // Allow if role is admin or dosen (any variation)
        // Since this route is under /dosen/, if role is not set but user can access this route, allow it
        $allowedRoles = ['admin', 'dosen', 'dosen praktikum'];
        if ($role && !in_array($roleLower, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki izin untuk mengunduh file ini');
        }

        $pendaftaran = DB::table('pendaftaran_asprak')
            ->where('id', $id)
            ->first();

        if (!$pendaftaran) {
            abort(404, 'Pendaftaran tidak ditemukan');
        }

        // determine which path to use
        if ($type === 'cv') {
            $path = $pendaftaran->cv_path ?? null;
        } elseif ($type === 'transkrip' || $type === 'transkrip_nilai') {
            $path = $pendaftaran->transkrip_path ?? null;
        } elseif ($type === 'jadwal' || $type === 'jadwal_kelas') {
            $path = $pendaftaran->jadwal_kelas_path ?? null;
        } else {
            abort(404);
        }

        if (empty($path)) {
            abort(404, 'File tidak ditemukan');
        }

        // expected storage location: storage/app/public/{path}
        $fullPath = storage_path('app/public/' . ltrim($path, '/'));

        if (!file_exists($fullPath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($fullPath, basename($fullPath));
    }
}
