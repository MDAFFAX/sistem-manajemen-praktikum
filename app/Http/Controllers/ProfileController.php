<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Logout the user.
     */
    public function logout()
    {
        // Hapus semua data session terlebih dahulu
        Session::forget(['role', 'user_email', 'user_id', 'user_name', 'user_nim', 'user_nip', 'user_program_studi']);
        
        // Hapus semua data session
        Session::flush();
        
        // Regenerate session ID untuk keamanan
        Session::regenerate(true);
        
        return redirect()->route('login')->with('success', 'Anda telah logout');
    }
}

