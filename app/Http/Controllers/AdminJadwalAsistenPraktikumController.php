<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminJadwalAsistenPraktikumController extends Controller
{
    /**
     * Tampilkan halaman menetapkan jadwal asisten praktikum.
     */
    public function index()
    {
        $jadwals = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('jadwal_asisten_praktikums')) {
                $jadwals = DB::table('jadwal_asisten_praktikums')
                    ->orderBy('id')
                    ->get();
            }
        } catch (\Throwable $e) {
            $jadwals = [];
        }

        return view('admin.jadwal_asisten_praktikum.index', [
            'role' => 'Admin',
            'activeMenu' => 'jadwal-asisten',
            'sidebarType' => 'admin',
            'jadwals' => $jadwals,
        ]);
    }

    /**
     * Simpan jadwal baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_mata_kuliah' => 'required|string|max:20',
            'nim' => 'required|string|max:50',
            'hari' => 'required|string|max:20',
            'ruang' => 'required|string|max:20',
            'jam' => 'required|string|max:20',
        ]);

        DB::table('jadwal_asisten_praktikums')->insert($data);

        return redirect()
            ->route('admin.jadwal-asisten.index')
            ->with('success', 'Jadwal asisten praktikum berhasil ditambahkan.');
    }

    /**
     * Update jadwal.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'kode_mata_kuliah' => 'required|string|max:20',
            'nim' => 'required|string|max:50',
            'hari' => 'required|string|max:20',
            'ruang' => 'required|string|max:20',
            'jam' => 'required|string|max:20',
        ]);

        DB::table('jadwal_asisten_praktikums')
            ->where('id', $id)
            ->update($data);

        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Jadwal berhasil diperbarui']);
        }

        return redirect()
            ->route('admin.jadwal-asisten.index')
            ->with('success', 'Jadwal asisten praktikum berhasil diperbarui.');
    }

    /**
     * Hapus jadwal.
     */
    public function destroy($id)
    {
        DB::table('jadwal_asisten_praktikums')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.jadwal-asisten.index')
            ->with('success', 'Jadwal asisten praktikum berhasil dihapus.');
    }
}
