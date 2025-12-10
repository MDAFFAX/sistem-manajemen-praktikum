@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h2 class="text-xl font-semibold">Detail Berkas Pendaftaran</h2>
                    <p class="text-sm text-gray-600">Detail pendaftaran untuk verifikasi</p>
                </div>
                <div>
                    <a href="{{ route('admin.verifikasi-berkas.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Kembali</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-600">Nama Lengkap</p>
                    <div class="font-medium">{{ $pendaftaran->nama_lengkap }}</div>
                </div>
                <div>
                    <p class="text-sm text-gray-600">NIM</p>
                    <div class="font-medium">{{ $pendaftaran->nim }}</div>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Kelas</p>
                    <div class="font-medium">{{ $pendaftaran->kelas ?? '-' }}</div>
                </div>
                <div>
                    <p class="text-sm text-gray-600">IPK</p>
                    <div class="font-medium">{{ number_format($pendaftaran->ipk ?? 0, 2) }}</div>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Nomor HP</p>
                    <div class="font-medium">{{ $pendaftaran->nomor_hp ?? '-' }}</div>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Mata Kuliah</p>
                    <div class="font-medium">{{ $lowongan->mata_kuliah ?? '-' }}</div>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Dokumen Pendukung</p>
                <div class="space-y-2">
                    <div class="flex items-center justify-between border rounded p-3">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <div class="text-sm font-medium">Curriculum Vitae</div>
                                <div class="text-xs text-gray-500">PDF</div>
                            </div>
                        </div>
                        <div>
                                @if($pendaftaran->cv_path)
                                    <a href="{{ route('dosen.pendaftaran.download', [$pendaftaran->id, 'cv']) }}" class="text-blue-600 hover:underline">Download</a>
                                @else
                                    <span class="text-sm text-gray-500">-</span>
                                @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-between border rounded p-3">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <div class="text-sm font-medium">Transkrip Nilai</div>
                                <div class="text-xs text-gray-500">PDF</div>
                            </div>
                        </div>
                        <div>
                            @if($pendaftaran->transkrip_path)
                                <a href="{{ route('dosen.pendaftaran.download', [$pendaftaran->id, 'transkrip']) }}" class="text-blue-600 hover:underline">Download</a>
                            @else
                                <span class="text-sm text-gray-500">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-between border rounded p-3">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <div class="text-sm font-medium">Jadwal Kelas</div>
                                <div class="text-xs text-gray-500">PDF</div>
                            </div>
                        </div>
                        <div>
                            @if($pendaftaran->jadwal_kelas_path)
                                <a href="{{ route('dosen.pendaftaran.download', [$pendaftaran->id, 'jadwal']) }}" class="text-blue-600 hover:underline">Download</a>
                            @else
                                <span class="text-sm text-gray-500">-</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                @if($pendaftaran->status === 'Menunggu')
                    <form action="{{ route('admin.pendaftaran.reject', $pendaftaran->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm bg-red-50 text-red-700 border rounded">Tolak</button>
                    </form>

                    <form action="{{ route('admin.pendaftaran.approve', $pendaftaran->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded">Setujui</button>
                    </form>
                @else
                    <span class="px-3 py-2 text-sm font-medium rounded {{ $pendaftaran->status === 'Disetujui' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $pendaftaran->status }}</span>
                @endif
            </div>
        </div>
    </div>
@endsection
