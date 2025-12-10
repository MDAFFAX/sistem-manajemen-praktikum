<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display the dosen profile.
     */
    public function show()
    {
        $user = $this->getUserData();
        
        if (!$user) {
            return redirect('/login')->with('error', 'User tidak ditemukan');
        }

        return view('profile.show', [
            'user' => $user,
            'role' => 'Dosen Pengampu',
            'roleType' => 'dosen',
            'activeMenu' => 'profile',
            'sidebarType' => 'dosen'
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
            'role' => 'Dosen Pengampu',
            'roleType' => 'dosen',
            'activeMenu' => 'profile',
            'sidebarType' => 'dosen'
        ]);
    }

    /**
     * Update the dosen profile.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $updated = $this->updateUserData($validated);

        if ($updated) {
            return redirect()->route('dosen.profile.show')
                ->with('success', 'Profile berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui profile');
    }

    /**
     * Get dosen user data.
     */
    private function getUserData()
    {
        $dosenId = session('user_id') ?? 1;
        
        // Email diambil dari session (dari login)
        $email = session('user_email');
        
        // Ambil dari dosens table
        $dosen = DB::table('dosens')->where('id', $dosenId)->first();
        
        if ($dosen) {
            return (object) [
                'id' => $dosen->id,
                'nama_lengkap' => $dosen->nama,
                'email' => $email ?? $dosen->email, // Prioritas: email dari session/login
                'nip' => $dosen->nip,
                'jabatan' => $dosen->jabatan ?? null,
                'role' => 'dosen'
            ];
        }
        
        // Fallback: ambil dari session
        return (object) [
            'id' => $dosenId,
            'nama_lengkap' => session('user_name') ?? 'Dosen User',
            'email' => $email ?? 'dosen@example.com', // Prioritas: email dari session/login
            'nip' => session('user_nip') ?? 'DOS001',
            'jabatan' => 'Dosen Pengampu',
            'role' => 'dosen'
        ];
    }

    /**
     * Update dosen user data.
     */
    private function updateUserData($data)
    {
        try {
            $dosenId = session('user_id') ?? 1;
            
            DB::table('dosens')
                ->where('id', $dosenId)
                ->update([
                    'nama' => $data['nama_lengkap'],
                    'email' => $data['email'],
                    'updated_at' => now()
                ]);
            
            session(['user_name' => $data['nama_lengkap']]);
            session(['user_email' => $data['email']]);
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

