<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTahunAjaranController extends Controller
{
    /**
     * Tampilkan halaman kelola tahun ajaran.
     */
    public function index()
    {
        $tahunAjarans = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('tahun_ajarans')) {
                $tahunAjarans = DB::table('tahun_ajarans')
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } catch (\Throwable $e) {
            $tahunAjarans = [];
        }

        return view('admin.tahun_ajaran.index', [
            'role' => 'Admin',
            'activeMenu' => 'kelola-tahun-ajaran',
            'sidebarType' => 'admin',
            'tahunAjarans' => $tahunAjarans,
        ]);
    }

    /**
     * Simpan tahun ajaran baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'semester' => 'required|string|in:Ganjil,Genap',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        DB::table('tahun_ajarans')->insert($data);

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    /**
     * Update data tahun ajaran.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'semester' => 'required|string|in:Ganjil,Genap',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        DB::table('tahun_ajarans')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    /**
     * Hapus tahun ajaran.
     */
    public function destroy($id)
    {
        DB::table('tahun_ajarans')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}
