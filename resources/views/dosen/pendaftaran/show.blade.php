@extends('layouts.app')

@section('title', 'Detail Berkas Pendaftaran')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-black">Detail Berkas Pendaftaran</h1>
                <p class="text-sm text-gray-600 mt-1">Detail pendaftaran untuk verifikasi</p>
            </div>
            <a href="{{ route('dosen.pendaftaran.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                ← Kembali
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8">
            <!-- Info Pribadi Section -->
            <div class="space-y-6">
                <!-- Row 1: Nama Lengkap & NIM -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <p class="text-base text-black font-semibold">{{ $pendaftaran->nama_lengkap ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                        <p class="text-base text-black font-semibold">{{ $pendaftaran->nim ?? '-' }}</p>
                    </div>
                </div>

                <!-- Row 2: Kelas & IPK -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <p class="text-base text-black font-semibold">{{ $pendaftaran->kelas ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">IPK</label>
                        <p class="text-base text-black font-semibold">{{ number_format($pendaftaran->ipk ?? 0, 2) }}</p>
                    </div>
                </div>

                <!-- Row 3: Nomor HP & Mata Kuliah -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                        <p class="text-base text-black font-semibold">{{ $pendaftaran->nomor_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mata Kuliah</label>
                        <p class="text-base text-black font-semibold">
                            {{ $pendaftaran->mata_kuliah ?? '-' }}
                        </p>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="border-gray-200 my-6">

                <!-- Dokumen Pendukung Section -->
                <div>
                    <h3 class="text-lg font-semibold text-black mb-4">Dokumen Pendukung</h3>
                    <div class="space-y-3">
                        <!-- Curriculum Vitae -->
                        @if($pendaftaran->cv_path)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-black">Curriculum Vitae</p>
                                        <p class="text-xs text-gray-500">PDF</p>
                                    </div>
                                </div>
                                <a href="{{ route('dosen.pendaftaran.download', [$pendaftaran->id, 'cv']) }}" class="px-4 py-2 text-blue-600 hover:text-blue-800 font-semibold text-sm hover:underline">
                                    Download
                                </a>
                            </div>
                        @endif

                        <!-- Transkrip Nilai -->
                        @if($pendaftaran->transkrip_path)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-black">Transkrip Nilai</p>
                                        <p class="text-xs text-gray-500">PDF</p>
                                    </div>
                                </div>
                                <a href="{{ route('dosen.pendaftaran.download', [$pendaftaran->id, 'transkrip']) }}" class="px-4 py-2 text-blue-600 hover:text-blue-800 font-semibold text-sm hover:underline">
                                    Download
                                </a>
                            </div>
                        @endif

                        <!-- Jadwal Kelas -->
                        @if($pendaftaran->jadwal_kelas_path)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-black">Jadwal Kelas</p>
                                        <p class="text-xs text-gray-500">PDF</p>
                                    </div>
                                </div>
                                <a href="{{ route('dosen.pendaftaran.download', [$pendaftaran->id, 'jadwal']) }}" class="px-4 py-2 text-blue-600 hover:text-blue-800 font-semibold text-sm hover:underline">
                                    Download
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Status Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Status Pendaftaran</p>
                            @php
                                $statusLower = strtolower($pendaftaran->status ?? '');
                                if ($statusLower === 'disetujui') {
                                    $statusClass = 'bg-green-100 text-green-800';
                                    $statusLabel = 'Disetujui';
                                } elseif ($statusLower === 'ditolak') {
                                    $statusClass = 'bg-red-100 text-red-800';
                                    $statusLabel = 'Ditolak';
                                } else {
                                    $statusClass = 'bg-gray-100 text-gray-800';
                                    $statusLabel = 'Menunggu';
                                }
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
