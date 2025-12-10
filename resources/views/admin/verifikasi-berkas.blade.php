@extends('layouts.app')

@section('title', 'Verifikasi Berkas Pendaftaran')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-black">Verifikasi Berkas Pendaftaran</h1>
                    <p class="text-sm text-gray-500">Review dan verifikasi berkas pendaftaran asisten praktikum</p>
                </div>
            </div>
        </div>

        @php
            $menungguCount = \DB::table('pendaftaran_asprak')->where('status', 'Menunggu')->count();
            $disetujuiCount = \DB::table('pendaftaran_asprak')->where('status', 'Disetujui')->count();
            $ditolakCount = \DB::table('pendaftaran_asprak')->where('status', 'Ditolak')->count();
        @endphp

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Menunggu Verifikasi -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Menunggu Verifikasi</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $menungguCount }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Disetujui -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Disetujui</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $disetujuiCount }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Ditolak -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Ditolak</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $ditolakCount }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4">
                <div class="rounded-md bg-green-50 p-4 border border-green-100">
                    <p class="text-sm text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4">
                <div class="rounded-md bg-red-50 p-4 border border-red-100">
                    <p class="text-sm text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Daftar Berkas Pendaftaran - Tabbed -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Daftar Berkas Pendaftaran</h2>
                    <!-- empty right area to keep header balanced -->
                    <div></div>
                </div>

                @php
                    $menunggu = \DB::table('pendaftaran_asprak as p')
                        ->join('lowongan_asisten_praktikums as l', 'p.lowongan_id', '=', 'l.id')
                        ->where('p.status', 'Menunggu')
                        ->select('p.*', 'l.mata_kuliah')
                        ->orderBy('p.created_at', 'desc')
                        ->get();

                    $disetujui = \DB::table('pendaftaran_asprak as p')
                        ->join('lowongan_asisten_praktikums as l', 'p.lowongan_id', '=', 'l.id')
                        ->where('p.status', 'Disetujui')
                        ->select('p.*', 'l.mata_kuliah')
                        ->orderBy('p.updated_at', 'desc')
                        ->get();

                    $ditolak = \DB::table('pendaftaran_asprak as p')
                        ->join('lowongan_asisten_praktikums as l', 'p.lowongan_id', '=', 'l.id')
                        ->where('p.status', 'Ditolak')
                        ->select('p.*', 'l.mata_kuliah')
                        ->orderBy('p.updated_at', 'desc')
                        ->get();
                @endphp

                <!-- Tabs -->
                <div class="mb-6">
                    <nav class="flex space-x-3" role="tablist" aria-label="Verifikasi Tabs">
                        <button class="tab-btn px-4 py-2 rounded-full border text-sm font-medium bg-white text-gray-700" data-target="#menunggu-list" aria-selected="true">Menunggu ({{ $menunggu->count() }})</button>
                        <button class="tab-btn px-4 py-2 rounded-full border text-sm font-medium bg-white text-gray-700" data-target="#disetujui-list" aria-selected="false">Disetujui ({{ $disetujui->count() }})</button>
                        <button class="tab-btn px-4 py-2 rounded-full border text-sm font-medium bg-white text-gray-700" data-target="#ditolak-list" aria-selected="false">Ditolak ({{ $ditolak->count() }})</button>
                    </nav>
                </div>

                <div id="menunggu-list">
                    @forelse($menunggu as $item)
                        <div class="bg-white border border-gray-200 rounded-lg p-5 mb-4">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">{{ strtoupper(substr($item->nama_lengkap,0,1)) }}</div>
                                    <div>
                                        <div class="flex items-center space-x-3">
                                            <h3 class="text-base font-semibold text-gray-900">{{ $item->nama_lengkap }}</h3>
                                            <span class="text-xs px-2 py-1 rounded-full bg-orange-100 text-orange-800">{{ $item->status }}</span>
                                        </div>
                                        <div class="text-sm text-gray-500 mt-1">NIM: {{ $item->nim }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.pendaftaran.show', $item->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-4 text-sm text-gray-600">
                                <div>
                                    <div class="text-xs text-gray-500">Mata Kuliah</div>
                                    <div class="font-medium text-gray-800">{{ $item->mata_kuliah }}</div>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">IPK</div>
                                    <div class="font-medium text-gray-800">{{ number_format($item->ipk ?? 0, 2) }}</div>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Tanggal Daftar</div>
                                    <div class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($item->tanggal_daftar ?? $item->created_at)->format('d/m/Y') }}</div>
                                </div>
                            </div>

                            @if(!empty($item->catatan))
                                <div class="mt-4 bg-gray-50 border border-gray-100 rounded p-3 text-sm text-gray-600">Catatan: {{ $item->catatan }}</div>
                            @endif
                        </div>
                    @empty
                        <div class="text-sm text-gray-500">Tidak ada pendaftar menunggu.</div>
                    @endforelse
                </div>

                <div id="disetujui-list" class="hidden">
                    @forelse($disetujui as $item)
                        <div class="bg-white border border-gray-200 rounded-lg p-5 mb-4">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-semibold">{{ strtoupper(substr($item->nama_lengkap,0,1)) }}</div>
                                    <div>
                                        <div class="flex items-center space-x-3">
                                            <h3 class="text-base font-semibold text-gray-900">{{ $item->nama_lengkap }}</h3>
                                            <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">{{ $item->status }}</span>
                                        </div>
                                        <div class="text-sm text-gray-500 mt-1">NIM: {{ $item->nim }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.pendaftaran.show', $item->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-gray-500">Tidak ada pendaftar disetujui.</div>
                    @endforelse
                </div>

                <div id="ditolak-list" class="hidden">
                    @forelse($ditolak as $item)
                        <div class="bg-white border border-gray-200 rounded-lg p-5 mb-4">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-700 font-semibold">{{ strtoupper(substr($item->nama_lengkap,0,1)) }}</div>
                                    <div>
                                        <div class="flex items-center space-x-3">
                                            <h3 class="text-base font-semibold text-gray-900">{{ $item->nama_lengkap }}</h3>
                                            <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-800">{{ $item->status }}</span>
                                        </div>
                                        <div class="text-sm text-gray-500 mt-1">NIM: {{ $item->nim }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.pendaftaran.show', $item->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-gray-500">Tidak ada pendaftar ditolak.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function(){
    const buttons = document.querySelectorAll('.tab-btn');
    function activate(btn){
        buttons.forEach(b => {
            b.classList.remove('bg-blue-50','text-blue-600','border-blue-600');
            b.classList.add('bg-white','text-gray-700');
            b.setAttribute('aria-selected','false');
        });
        btn.classList.remove('bg-white');
        btn.classList.add('bg-blue-50','text-blue-600','border-blue-600');
        btn.setAttribute('aria-selected','true');

        const target = btn.getAttribute('data-target');
        ['#menunggu-list','#disetujui-list','#ditolak-list'].forEach(id => {
            const el = document.querySelector(id);
            if(!el) return;
            if(id === target) el.classList.remove('hidden'); else el.classList.add('hidden');
        });
    }

    buttons.forEach(btn => btn.addEventListener('click', function(e){ activate(btn); }));

    // initialize
    const active = document.querySelector('.tab-btn[aria-selected="true"]') || document.querySelector('.tab-btn');
    if(active) activate(active);
})();
</script>
@endpush






