<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMataKuliahPraktikumController extends Controller
{
    /**
     * Tampilkan halaman kelola mata kuliah praktikum.
     */
    public function index()
    {
        $mataKuliah = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('mata_kuliah_praktikums')) {
                $mataKuliah = DB::table('mata_kuliah_praktikums')
                    ->orderBy('id')
                    ->get();
            }
        } catch (\Throwable $e) {
            $mataKuliah = [];
        }

        return view('admin.mata_kuliah_praktikum', [
            'role' => 'Admin',
            'activeMenu' => 'kelola-mata-kuliah',
            'sidebarType' => 'admin',
            'mataKuliah' => $mataKuliah,
        ]);
    }

    /**
     * Simpan mata kuliah baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:10',
        ]);

        DB::table('mata_kuliah_praktikums')->insert($data);

        return redirect()
            ->route('admin.mata-kuliah.index')
            ->with('success', 'Mata kuliah praktikum berhasil ditambahkan.');
    }

    /**
     * Update data mata kuliah.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'kode' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:10',
        ]);

        DB::table('mata_kuliah_praktikums')
            ->where('id', $id)
            ->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Mata kuliah praktikum berhasil diperbarui.']);
        }

        return redirect()
            ->route('admin.mata-kuliah.index')
            ->with('success', 'Mata kuliah praktikum berhasil diperbarui.');
    }

    /**
     * Hapus mata kuliah.
     */
    public function destroy($id)
    {
        DB::table('mata_kuliah_praktikums')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.mata-kuliah.index')
            ->with('success', 'Mata kuliah praktikum berhasil dihapus.');
    }
}
