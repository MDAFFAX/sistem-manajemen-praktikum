<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLowonganAsprakController extends Controller
{
    /**
     * Tampilkan halaman kelola lowongan asisten praktikum.
     */
    public function index()
    {
        $lowongans = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('lowongan_asisten_praktikums')) {
                $lowongans = DB::table('lowongan_asisten_praktikums')
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } catch (\Throwable $e) {
            $lowongans = [];
        }

        return view('admin.lowongan_asprak.index', [
            'role' => 'Admin',
            'activeMenu' => 'kelola-lowongan',
            'sidebarType' => 'admin',
            'lowongans' => $lowongans,
        ]);
    }

    /**
     * Simpan lowongan baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'prodi' => 'nullable|string|max:100',
            'dosen' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
            'tanggal_awal_pendaftaran' => 'required|date',
            'tanggal_akhir_pendaftaran' => 'required|date|after:tanggal_awal_pendaftaran',
            'kuota' => 'required|integer|min:1',
        ]);

        $data['status'] = 'Aktif'; // Default status ke Aktif

        DB::table('lowongan_asisten_praktikums')->insert($data);

        return redirect()
            ->route('admin.lowongan-asprak.index')
            ->with('success', 'Lowongan asisten praktikum berhasil ditambahkan.');
    }

    /**
     * Update data lowongan.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'prodi' => 'nullable|string|max:100',
            'dosen' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
            'tanggal_awal_pendaftaran' => 'required|date',
            'tanggal_akhir_pendaftaran' => 'required|date|after:tanggal_awal_pendaftaran',
            'kuota' => 'required|integer|min:1',
        ]);

        DB::table('lowongan_asisten_praktikums')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->route('admin.lowongan-asprak.index')
            ->with('success', 'Lowongan asisten praktikum berhasil diperbarui.');
    }

    /**
     * Hapus lowongan.
     */
    public function destroy($id)
    {
        DB::table('lowongan_asisten_praktikums')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.lowongan-asprak.index')
            ->with('success', 'Lowongan asisten praktikum berhasil dihapus.');
    }
}
