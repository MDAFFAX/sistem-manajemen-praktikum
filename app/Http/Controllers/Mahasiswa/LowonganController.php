<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LowonganController extends Controller
{
    /**
     * Tampilkan daftar lowongan yang dibuka untuk mahasiswa.
     */
    public function index()
    {
        $lowongans = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('lowongan_asisten_praktikums')) {
                // Ambil lowongan yang statusnya "Aktif" atau "Dibuka".
                // Juga alias kolom agar view lebih mudah dibaca.
                $lowongans = DB::table('lowongan_asisten_praktikums')
                    ->select([
                        'id',
                        'mata_kuliah',
                        'prodi',
                        'dosen',
                        'kuota',
                        'tanggal_awal_pendaftaran',
                        'tanggal_akhir_pendaftaran',
                        'tahun_ajaran',
                        'status'
                    ])
                    ->whereIn('status', ['Aktif', 'Dibuka'])
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } catch (\Throwable $e) {
            $lowongans = [];
        }

        return view('mahasiswa.lowongan', [
            'role' => 'MAHASISWA',
            'activeMenu' => 'lowongan-asprak',
            'sidebarType' => 'mahasiswa',
            'lowongans' => $lowongans,
        ]);
    }

    /**
     * Tampilkan halaman detail lowongan + form pendaftaran.
     */
    public function formDaftar($id)
    {
        try {
            $lowongan = DB::table('lowongan_asisten_praktikums')
                ->where('id', $id)
                ->first();
        } catch (\Throwable $e) {
            $lowongan = null;
        }

        if (!$lowongan) {
            return view('mahasiswa.form-daftar', [
                'lowongan' => null,
                'role' => 'MAHASISWA',
                'activeMenu' => 'lowongan-asprak',
                'sidebarType' => 'mahasiswa',
            ]);
        }

        // Jika status bukan Aktif/Dibuka, treat as closed
        if (!in_array($lowongan->status, ['Aktif', 'Dibuka'])) {
            return view('mahasiswa.form-daftar', [
                'lowongan' => $lowongan,
                'closed' => true,
                'role' => 'MAHASISWA',
                'activeMenu' => 'lowongan-asprak',
                'sidebarType' => 'mahasiswa',
            ]);
        }

        return view('mahasiswa.form-daftar', [
            'lowongan' => $lowongan,
            'closed' => false,
            'role' => 'MAHASISWA',
            'activeMenu' => 'lowongan-asprak',
            'sidebarType' => 'mahasiswa',
        ]);
    }

    /**
     * Terima submit pendaftaran dan simpan.
     */
    public function submitDaftar(Request $request, $id)
    {
        // Pastikan lowongan ada dan masih aktif
        $lowongan = DB::table('lowongan_asisten_praktikums')->where('id', $id)->first();
        if (!$lowongan || !in_array($lowongan->status, ['Aktif', 'Dibuka'])) {
            return redirect()->back()->with('error', 'Lowongan tidak tersedia atau sudah ditutup.');
        }

        $validated = $request->validate([
            'nim' => 'required|string|max:30',
            'nama_lengkap' => 'required|string|max:191',
            'kelas' => 'nullable|string|max:50',
            'ipk' => 'nullable|numeric|between:0,4',
            'nomor_hp' => 'nullable|string|max:30',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'transkrip' => 'required|file|mimes:pdf|max:2048',
            'jadwal_kelas' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Simpan file ke storage/public
        $cvPath = $request->file('cv')->store('pendaftaran/cv', 'public');
        $transPath = $request->file('transkrip')->store('pendaftaran/transkrip', 'public');
        $jadwalPath = $request->file('jadwal_kelas')->store('pendaftaran/jadwal_kelas', 'public');

        // Simpan pendaftaran
        $idPendaftaran = DB::table('pendaftaran_asprak')->insertGetId([
            'lowongan_id' => $id,
            'nim' => $validated['nim'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'kelas' => $validated['kelas'] ?? null,
            'ipk' => $validated['ipk'] ?? null,
            'nomor_hp' => $validated['nomor_hp'] ?? null,
            'cv_path' => $cvPath,
            'transkrip_path' => $transPath,
            'jadwal_kelas_path' => $jadwalPath,
            'status' => 'Menunggu',
            'tanggal_daftar' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/mahasiswa/status-seleksi')
            ->with('success', 'Pendaftaran berhasil! Berkas kamu sedang menunggu verifikasi admin.');
    }

    /**
     * Tampilkan halaman status seleksi untuk mahasiswa.
     */
    public function statusSeleksi()
    {
        // Jika sistem menggunakan auth:mahasiswa, bisa ambil user-specific pendaftaran di sini.
        // Untuk sekarang tampilkan pesan dan ringkasan pendaftaran milik user (jika ada).
        $pendaftaran = [];
        try {
            if (\DB::getSchemaBuilder()->hasTable('pendaftaran_asprak')) {
                $pendaftaran = \DB::table('pendaftaran_asprak')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        } catch (\Throwable $e) {
            $pendaftaran = [];
        }

        return view('mahasiswa.status-seleksi', [
            'role' => 'MAHASISWA',
            'activeMenu' => 'status-seleksi',
            'sidebarType' => 'mahasiswa',
            'pendaftaran' => $pendaftaran,
        ]);
    }
}
