<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAsprak extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_asprak';

    protected $fillable = [
        'lowongan_id',
        'nim',
        'nama_lengkap',
        'kelas',
        'ipk',
        'nomor_hp',
        'cv_path',
        'transkrip_path',
        'jadwal_kelas_path',
        'status',
        'tanggal_daftar',
    ];
}
