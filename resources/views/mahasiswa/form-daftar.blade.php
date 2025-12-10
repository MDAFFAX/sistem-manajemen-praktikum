@extends('layouts.app')

@section('title', 'Detail Lowongan / Daftar')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('mahasiswa.lowongan-asprak.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Kembali ke Lowongan</a>
        </div>

        @if(!$lowongan)
            <div class="bg-white p-6 rounded shadow-sm text-center">
                <h2 class="text-lg font-semibold">Lowongan tidak tersedia</h2>
                <p class="text-sm text-gray-500">Lowongan mungkin telah dihapus oleh admin.</p>
            </div>
        @else
            @if(!empty($closed) && $closed)
                <div class="bg-white p-6 rounded shadow-sm text-center">
                    <h2 class="text-lg font-semibold">Lowongan Ditutup</h2>
                    <p class="text-sm text-gray-500">Lowongan ini sudah ditutup dan tidak dapat didaftarkan.</p>
                </div>
            @else
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm mb-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h1 class="text-xl font-semibold">{{ $lowongan->mata_kuliah }}</h1>
                        </div>
                        <div>
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Dibuka</span>
                        </div>
                    </div>

                    <div class="mt-4 text-sm text-gray-700 space-y-1">
                        <div><strong>Prodi:</strong> {{ $lowongan->prodi ?? '-' }}</div>
                        <div><strong>Dosen:</strong> {{ $lowongan->dosen ?? '-' }}</div>
                        <div><strong>Kuota:</strong> {{ $lowongan->kuota }}</div>
                        <div><strong>Tgl Awal Pendaftaran:</strong> {{ \Carbon\Carbon::parse($lowongan->tanggal_awal_pendaftaran)->format('d/m/Y') }}</div>
                        <div><strong>Tgl Akhir Pendaftaran:</strong> {{ \Carbon\Carbon::parse($lowongan->tanggal_akhir_pendaftaran)->format('d/m/Y') }}</div>
                        <div><strong>Tahun Ajaran:</strong> {{ $lowongan->tahun_ajaran }}</div>
                        <div><strong>Status:</strong> {{ $lowongan->status }}</div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                    @if(session('error'))
                        <div class="mb-4 text-sm text-red-700 bg-red-50 p-3 rounded">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="mb-4 text-sm text-green-700 bg-green-50 p-3 rounded">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('mahasiswa.lowongan-asprak.submit', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIM</label>
                                <input type="text" name="nim" value="{{ old('nim') }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                @error('nim')<div class="text-xs text-red-600">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                @error('nama_lengkap')<div class="text-xs text-red-600">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                                <input type="text" name="kelas" value="{{ old('kelas') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                @error('kelas')<div class="text-xs text-red-600">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">IPK</label>
                                <input type="number" step="0.01" name="ipk" value="{{ old('ipk') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                @error('ipk')<div class="text-xs text-red-600">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                                <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                @error('nomor_hp')<div class="text-xs text-red-600">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Upload CV (PDF)</label>
                                <input type="file" name="cv" accept="application/pdf" required
                                       class="mt-1 block w-full text-sm text-gray-600">
                                @error('cv')<div class="text-xs text-red-600">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Upload Transkrip Nilai (PDF)</label>
                                <input type="file" name="transkrip" accept="application/pdf" required
                                       class="mt-1 block w-full text-sm text-gray-600">
                                @error('transkrip')<div class="text-xs text-red-600">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Upload Jadwal Kelas (PDF)</label>
                                <input type="file" name="jadwal_kelas" accept="application/pdf" required
                                       class="mt-1 block w-full text-sm text-gray-600">
                                @error('jadwal_kelas')<div class="text-xs text-red-600">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('mahasiswa.lowongan-asprak.index') }}" class="px-4 py-2 text-sm border rounded bg-white">Batal</a>
                            <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded">Daftar Sekarang</button>
                        </div>
                    </form>
                </div>
             @endif
         @endif
     </div>
 @endsection
