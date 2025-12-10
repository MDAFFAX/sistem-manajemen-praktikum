@extends('layouts.app')

@section('title', 'Lihat Status Seleksi')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- No back link: this page is the dedicated 'Lihat Status Seleksi' page -->

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <h2 class="text-lg font-semibold mb-3">Lihat Status Seleksi</h2>

            @if(count($pendaftaran) === 0)
                <p class="text-sm text-gray-500">Belum ada pendaftaran.</p>
            @else
                <div class="space-y-4">
                    @foreach($pendaftaran as $p)
                        <div class="border border-gray-100 rounded p-3 flex items-center justify-between">
                            <div>
                                <div class="text-sm font-semibold">{{ $p->nama_lengkap }}</div>
                                <div class="text-xs text-gray-600">NIM: {{ $p->nim }} &middot; IPK: {{ number_format($p->ipk ?? 0, 2) }}</div>
                                <div class="text-xs text-gray-600">Tanggal Daftar: {{ \Carbon\Carbon::parse($p->tanggal_daftar ?? $p->created_at)->format('d/m/Y') }}</div>
                            </div>
                            <div class="text-sm">
                                <span class="px-2 py-1 text-xs font-medium rounded {{ $p->status === 'Menunggu' ? 'bg-orange-100 text-orange-800' : ($p->status === 'Disetujui' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">{{ $p->status }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
