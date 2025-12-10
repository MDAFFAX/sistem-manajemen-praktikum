<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendaftaranAsprak;

class PendaftaranController extends Controller
{
    public function show($id)
    {
        $pendaftaran = PendaftaranAsprak::with([])->find($id);
        if (!$pendaftaran) {
            return redirect()->route('admin.verifikasi-berkas.index')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        // load lowongan info
        $lowongan = \DB::table('lowongan_asisten_praktikums')->where('id', $pendaftaran->lowongan_id)->first();

        return view('admin.pendaftaran.detail', [
            'pendaftaran' => $pendaftaran,
            'lowongan' => $lowongan,
        ]);
    }

    public function approve($id)
    {
        $pendaftaran = PendaftaranAsprak::find($id);
        if (!$pendaftaran) {
            return redirect()->route('admin.verifikasi-berkas.index')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $pendaftaran->status = 'Disetujui';
        $pendaftaran->save();

        return redirect()->route('admin.verifikasi-berkas.index')->with('success', 'Pendaftaran disetujui.');
    }

    public function reject($id)
    {
        $pendaftaran = PendaftaranAsprak::find($id);
        if (!$pendaftaran) {
            return redirect()->route('admin.verifikasi-berkas.index')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $pendaftaran->status = 'Ditolak';
        $pendaftaran->save();

        return redirect()->route('admin.verifikasi-berkas.index')->with('success', 'Pendaftaran ditolak.');
    }
}
