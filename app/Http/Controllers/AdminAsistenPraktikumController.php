<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAsistenPraktikumController extends Controller
{
    /**
     * Tampilkan halaman kelola data asisten praktikum.
     */
    public function index()
    {
        $asistens = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('asisten_praktikums')) {
                $asistens = DB::table('asisten_praktikums')
                    ->orderBy('id')
                    ->get();
            }
        } catch (\Throwable $e) {
            $asistens = [];
        }

        return view('admin.asisten_praktikum.index', [
            'role' => 'Admin',
            'activeMenu' => 'kelola-asisten',
            'sidebarType' => 'admin',
            'asistens' => $asistens,
        ]);
    }

    /**
     * Simpan data asisten baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|string|max:50',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        DB::table('asisten_praktikums')->insert($data);

        return redirect()
            ->route('admin.asisten-praktikum.index')
            ->with('success', 'Data asisten praktikum berhasil ditambahkan.');
    }

    /**
     * Update data asisten.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nim' => 'required|string|max:50',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        DB::table('asisten_praktikums')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->route('admin.asisten-praktikum.index')
            ->with('success', 'Data asisten praktikum berhasil diperbarui.');
    }

    /**
     * Hapus data asisten.
     */
    public function destroy($id)
    {
        DB::table('asisten_praktikums')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.asisten-praktikum.index')
            ->with('success', 'Data asisten praktikum berhasil dihapus.');
    }
}
