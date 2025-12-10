<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display the admin profile.
     */
    public function show()
    {
        $user = $this->getUserData();
        
        if (!$user) {
            return redirect('/login')->with('error', 'User tidak ditemukan');
        }

        return view('profile.show', [
            'user' => $user,
            'role' => 'Admin',
            'roleType' => 'admin',
            'activeMenu' => 'profile',
            'sidebarType' => 'admin'
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
            'role' => 'Admin',
            'roleType' => 'admin',
            'activeMenu' => 'profile',
            'sidebarType' => 'admin'
        ]);
    }

    /**
     * Update the admin profile.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $updated = $this->updateUserData($validated);

        if ($updated) {
            return redirect()->route('admin.profile.show')
                ->with('success', 'Profile berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui profile');
    }

    /**
     * Get admin user data.
     */
    private function getUserData()
    {
        $userId = session('user_id') ?? 1;
        
        // Email diambil dari session (dari login)
        $email = session('user_email');
        
        // Coba ambil dari users table
        $user = DB::table('users')->where('id', $userId)->first();
        
        if ($user) {
            return (object) [
                'id' => $user->id,
                'nama_lengkap' => $user->name,
                'email' => $email ?? $user->email, // Prioritas: email dari session/login
                'nip' => session('user_nip') ?? 'ADM' . str_pad($user->id, 3, '0', STR_PAD_LEFT),
                'role' => 'admin'
            ];
        }
        
        // Fallback: ambil dari session
        return (object) [
            'id' => $userId,
            'nama_lengkap' => session('user_name') ?? 'Admin User',
            'email' => $email ?? 'admin@example.com', // Prioritas: email dari session/login
            'nip' => session('user_nip') ?? 'ADM001',
            'role' => 'admin'
        ];
    }

    /**
     * Update admin user data.
     */
    private function updateUserData($data)
    {
        try {
            $userId = session('user_id') ?? 1;
            
            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'name' => $data['nama_lengkap'],
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

