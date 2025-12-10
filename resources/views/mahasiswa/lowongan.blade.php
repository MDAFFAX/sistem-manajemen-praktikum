@extends('layouts.app')

@section('title', 'Lowongan Asisten Praktikum')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-black">Lowongan Asisten Praktikum</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($lowongans as $lowongan)
                <div class="relative bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                    @if(strtolower($lowongan->status) === 'aktif' || strtolower($lowongan->status) === 'dibuka')
                        <div class="absolute right-3 top-3">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Dibuka</span>
                        </div>
                    @endif

                    <h2 class="text-lg font-semibold text-black mb-2">{{ $lowongan->mata_kuliah }}</h2>

                    <div class="text-sm text-gray-700 space-y-1 mb-4">
                        <div><strong>Prodi:</strong> {{ $lowongan->prodi ?? '-' }}</div>
                        <div><strong>Dosen:</strong> {{ $lowongan->dosen ?? '-' }}</div>
                        <div><strong>Kuota:</strong> {{ $lowongan->kuota }}</div>
                        <div><strong>Tgl Awal:</strong> {{ \Carbon\Carbon::parse($lowongan->tanggal_awal_pendaftaran)->format('d/m/Y') }}</div>
                        <div><strong>Tgl Akhir:</strong> {{ \Carbon\Carbon::parse($lowongan->tanggal_akhir_pendaftaran)->format('d/m/Y') }}</div>
                        <div><strong>Tahun Ajaran:</strong> {{ $lowongan->tahun_ajaran }}</div>
                    </div>

                    <div class="pt-3">
                        <a href="{{ route('mahasiswa.lowongan-asprak.form', $lowongan->id) }}" class="block w-full text-center px-4 py-2 bg-gray-100 border border-gray-300 rounded text-sm font-medium hover:bg-gray-200">Lihat Detail / Daftar</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">Belum ada lowongan yang dibuka saat ini.</div>
            @endforelse
        </div>
    </div>
@endsection
