<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\AdminMataKuliahPraktikumController;
use App\Http\Controllers\AdminTahunAjaranController;
use App\Http\Controllers\AdminLowonganAsprakController;
use App\Http\Controllers\AdminAsistenPraktikumController;
use App\Http\Controllers\AdminJadwalAsistenPraktikumController;
use App\Http\Controllers\Mahasiswa\LowonganController;
use App\Http\Controllers\Mahasiswa\LowonganController as MahasiswaLowonganController;
use App\Http\Controllers\Mahasiswa\JadwalPraktikumController;
use App\Http\Controllers\Dosen\PendaftaranController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Dosen\ProfileController as DosenProfileController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    // Jika sudah login, redirect sesuai role
    $role = session('role');
    if ($role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($role === 'dosen') {
        return redirect('/dosen/dashboard');
    } elseif ($role === 'mahasiswa') {
        return redirect('/mahasiswa/jadwal-praktikum');
    }
    return view('login');
})->name('login');

Route::post('/login', function () {
    $role = request('role');
    
    // TODO: Implementasi validasi login dan authentication di sini
    // Untuk sementara, langsung redirect berdasarkan role
    session(['role' => $role]);
    
    if ($role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($role === 'dosen') {
        return redirect('/dosen/dashboard');
    } elseif ($role === 'mahasiswa') {
        // langsung ke jadwal praktikum, tidak lewat dashboard
        return redirect('/mahasiswa/jadwal-praktikum');
    }
    
    // Default redirect jika role tidak valid
    return redirect('/login')->with('error', 'Role tidak valid');
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard', [
        'role' => 'Dosen Praktikum',
        'activeMenu' => 'dashboard',
        'sidebarType' => 'dosen'
    ]);
});

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard', [
        'role' => 'MAHASISWA',
        'activeMenu' => 'dashboard',
        'sidebarType' => 'mahasiswa'
    ]);
});

Route::get('/mahasiswa/lowongan-asprak', [LowonganController::class, 'index'])->name('mahasiswa.lowongan-asprak.index');
// Detail dan pendaftaran
Route::get('/mahasiswa/lowongan-asprak/{id}/daftar', [MahasiswaLowonganController::class, 'formDaftar'])->name('mahasiswa.lowongan-asprak.form');
Route::post('/mahasiswa/lowongan-asprak/{id}/daftar', [MahasiswaLowonganController::class, 'submitDaftar'])->name('mahasiswa.lowongan-asprak.submit');
// Halaman status seleksi mahasiswa (target redirect setelah submit)
Route::get('/mahasiswa/status-seleksi', [MahasiswaLowonganController::class, 'statusSeleksi'])->name('mahasiswa.status-seleksi');
Route::get('/mahasiswa/jadwal-praktikum', [JadwalPraktikumController::class, 'index'])->name('mahasiswa.jadwal-praktikum');
// Mahasiswa Profile
Route::get('/mahasiswa/profile', [MahasiswaProfileController::class, 'show'])->name('mahasiswa.profile.show');
Route::get('/mahasiswa/profile/edit', [MahasiswaProfileController::class, 'edit'])->name('mahasiswa.profile.edit');
Route::put('/mahasiswa/profile', [MahasiswaProfileController::class, 'update'])->name('mahasiswa.profile.update');

// Dosen routes
Route::get('/dosen/pendaftaran', [PendaftaranController::class, 'index'])->name('dosen.pendaftaran.index');
Route::get('/dosen/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('dosen.pendaftaran.show');
Route::get('/dosen/pendaftaran/{id}/download/{type}', [PendaftaranController::class, 'download'])->name('dosen.pendaftaran.download');
// Dosen Profile
Route::get('/dosen/profile', [DosenProfileController::class, 'show'])->name('dosen.profile.show');
Route::get('/dosen/profile/edit', [DosenProfileController::class, 'edit'])->name('dosen.profile.edit');
Route::put('/dosen/profile', [DosenProfileController::class, 'update'])->name('dosen.profile.update');

Route::prefix('admin')->group(function () {
    Route::get('/dosen', [AdminDosenController::class, 'index'])->name('admin.dosen.index');
    Route::post('/dosen', [AdminDosenController::class, 'store'])->name('admin.dosen.store');
    Route::put('/dosen/{id}', [AdminDosenController::class, 'update'])->name('admin.dosen.update');
    Route::delete('/dosen/{id}', [AdminDosenController::class, 'destroy'])->name('admin.dosen.delete');

    Route::get('/mata-kuliah-praktikum', [AdminMataKuliahPraktikumController::class, 'index'])->name('admin.mata-kuliah.index');
    Route::post('/mata-kuliah-praktikum', [AdminMataKuliahPraktikumController::class, 'store'])->name('admin.mata-kuliah.store');
    Route::put('/mata-kuliah-praktikum/{id}', [AdminMataKuliahPraktikumController::class, 'update'])->name('admin.mata-kuliah.update');
    Route::delete('/mata-kuliah-praktikum/{id}', [AdminMataKuliahPraktikumController::class, 'destroy'])->name('admin.mata-kuliah.delete');

    Route::get('/tahun-ajaran', [AdminTahunAjaranController::class, 'index'])->name('admin.tahun-ajaran.index');
    Route::post('/tahun-ajaran', [AdminTahunAjaranController::class, 'store'])->name('admin.tahun-ajaran.store');
    Route::put('/tahun-ajaran/{id}', [AdminTahunAjaranController::class, 'update'])->name('admin.tahun-ajaran.update');
    Route::delete('/tahun-ajaran/{id}', [AdminTahunAjaranController::class, 'destroy'])->name('admin.tahun-ajaran.delete');

    Route::get('/lowongan-asprak', [AdminLowonganAsprakController::class, 'index'])->name('admin.lowongan-asprak.index');
    Route::post('/lowongan-asprak', [AdminLowonganAsprakController::class, 'store'])->name('admin.lowongan-asprak.store');
    Route::put('/lowongan-asprak/{id}', [AdminLowonganAsprakController::class, 'update'])->name('admin.lowongan-asprak.update');
    Route::delete('/lowongan-asprak/{id}', [AdminLowonganAsprakController::class, 'destroy'])->name('admin.lowongan-asprak.delete');

    Route::get('/asisten-praktikum', [AdminAsistenPraktikumController::class, 'index'])->name('admin.asisten-praktikum.index');
    Route::post('/asisten-praktikum', [AdminAsistenPraktikumController::class, 'store'])->name('admin.asisten-praktikum.store');
    Route::put('/asisten-praktikum/{id}', [AdminAsistenPraktikumController::class, 'update'])->name('admin.asisten-praktikum.update');
    Route::delete('/asisten-praktikum/{id}', [AdminAsistenPraktikumController::class, 'destroy'])->name('admin.asisten-praktikum.delete');

    Route::get('/jadwal-asisten', [AdminJadwalAsistenPraktikumController::class, 'index'])->name('admin.jadwal-asisten.index');
    Route::post('/jadwal-asisten', [AdminJadwalAsistenPraktikumController::class, 'store'])->name('admin.jadwal-asisten.store');
    Route::put('/jadwal-asisten/{id}', [AdminJadwalAsistenPraktikumController::class, 'update'])->name('admin.jadwal-asisten.update');
    Route::delete('/jadwal-asisten/{id}', [AdminJadwalAsistenPraktikumController::class, 'destroy'])->name('admin.jadwal-asisten.delete');

    Route::get('/verifikasi-berkas', function () {
        return view('admin.verifikasi-berkas', [
            'role' => 'Admin',
            'activeMenu' => 'verifikasi-berkas',
            'sidebarType' => 'admin'
        ]);
    })->name('admin.verifikasi-berkas.index');

    // Admin: detail & approve/reject pendaftaran
    Route::get('/verifikasi-berkas/{id}', [App\Http\Controllers\Admin\PendaftaranController::class, 'show'])->name('admin.pendaftaran.show');
    Route::post('/verifikasi-berkas/{id}/approve', [App\Http\Controllers\Admin\PendaftaranController::class, 'approve'])->name('admin.pendaftaran.approve');
    Route::post('/verifikasi-berkas/{id}/reject', [App\Http\Controllers\Admin\PendaftaranController::class, 'reject'])->name('admin.pendaftaran.reject');

    // Admin Profile
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('admin.profile.show');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

// Logout shared
Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
