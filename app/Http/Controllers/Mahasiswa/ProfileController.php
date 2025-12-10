<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display the mahasiswa profile.
     */
    public function show()
    {
        $user = $this->getUserData();
        
        if (!$user) {
            return redirect('/login')->with('error', 'User tidak ditemukan');
        }

        return view('profile.show', [
            'user' => $user,
            'role' => 'MAHASISWA',
            'roleType' => 'mahasiswa',
            'activeMenu' => 'profile',
            'sidebarType' => 'mahasiswa'
        ]);
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = $this->getUserData();
        
        if (!$user) {
            return redirect('/login')->with('error', 'User tidak ditemukan');
        }

        return view('profile.edit', [
            'user' => $user,
            'role' => 'MAHASISWA',
            'roleType' => 'mahasiswa',
            'activeMenu' => 'profile',
            'sidebarType' => 'mahasiswa'
        ]);
    }

    /**
     * Update the mahasiswa profile.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'program_studi' => 'nullable|string|max:255',
        ]);

        $updated = $this->updateUserData($validated);

        if ($updated) {
            return redirect()->route('mahasiswa.profile.show')
                ->with('success', 'Profile berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui profile');
    }

    /**
     * Get mahasiswa user data.
     */
    private function getUserData()
    {
        $mahasiswaId = session('user_id') ?? 1;
        $nim = session('user_nim') ?? 'MHS001';
        
        // Email diambil dari session (dari login)
        $email = session('user_email');
        
        // Coba ambil dari pendaftaran_asprak berdasarkan NIM
        $pendaftaran = DB::table('pendaftaran_asprak')
            ->where('nim', $nim)
            ->orderBy('created_at', 'desc')
            ->first();
        
        if ($pendaftaran) {
            return (object) [
                'id' => $mahasiswaId,
                'nama_lengkap' => $pendaftaran->nama_lengkap,
                'email' => $email ?? 'mahasiswa@example.com', // Prioritas: email dari session/login
                'nim' => $pendaftaran->nim,
                'program_studi' => session('user_program_studi') ?? 'Sistem Informasi Akuntansi',
                'role' => 'mahasiswa'
            ];
        }
        
        // Fallback: ambil dari session
        return (object) [
            'id' => $mahasiswaId,
            'nama_lengkap' => session('user_name') ?? 'Mahasiswa User',
            'email' => $email ?? 'mahasiswa@example.com', // Prioritas: email dari session/login
            'nim' => $nim,
            'program_studi' => session('user_program_studi') ?? 'Sistem Informasi Akuntansi',
            'role' => 'mahasiswa'
        ];
    }

    /**
     * Update mahasiswa user data.
     */
    private function updateUserData($data)
    {
        try {
            $nim = session('user_nim') ?? 'MHS001';
            
            // Update di pendaftaran_asprak jika ada
            DB::table('pendaftaran_asprak')
                ->where('nim', $nim)
                ->update([
                    'nama_lengkap' => $data['nama_lengkap'],
                    'updated_at' => now()
                ]);
            
            session(['user_name' => $data['nama_lengkap']]);
            session(['user_email' => $data['email']]);
            session(['user_program_studi' => $data['program_studi'] ?? '']);
            
            return true;
        } catch (\Exception $e) {
            // Jika update gagal, tetap simpan di session
            session(['user_name' => $data['nama_lengkap']]);
            session(['user_email' => $data['email']]);
            session(['user_program_studi' => $data['program_studi'] ?? '']);
            return true;
        }
    }
}

