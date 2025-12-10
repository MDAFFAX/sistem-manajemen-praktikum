<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDosenController extends Controller
{
    /**
     * Tampilkan halaman kelola data dosen.
     */
    public function index()
    {
        $dosens = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('dosens')) {
                $dosens = DB::table('dosens')
                    ->orderBy('id')
                    ->get();
            }
        } catch (\Throwable $e) {
            $dosens = [];
        }

        return view('admin.dosen.index', [
            'role' => 'Admin',
            'activeMenu' => 'kelola-dosen',
            'sidebarType' => 'admin',
            'dosens' => $dosens,
        ]);
    }

    /**
     * Simpan data dosen baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        DB::table('dosens')->insert($data);

        return redirect()
            ->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    /**
     * Update data dosen.
     *
     * Endpoint ini terutama dipanggil lewat AJAX (fetch)
     * dari halaman kelola data dosen, jadi kita selalu
     * mengembalikan response JSON agar mudah ditangani
     * di sisi frontend.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
                'nip' => 'required|string|max:50',
                'email' => 'required|email|max:255',
                'jabatan' => 'required|string|max:255',
            ]);

            DB::table('dosens')
                ->where('id', $id)
                ->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data dosen berhasil diperbarui.',
            ]);
        } catch (\Throwable $e) {
            // Untuk debugging jika terjadi error tak terduga
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.',
            ], 500);
        }
    }

    /**
     * Hapus data dosen.
     */
    public function destroy($id)
    {
        DB::table('dosens')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil dihapus.');
    }
}







