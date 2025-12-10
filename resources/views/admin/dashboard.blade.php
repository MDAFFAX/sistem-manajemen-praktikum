@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Message -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-black">Selamat datang, Admin Prodi</h1>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl">
        <!-- Total Dosen Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Total Dosen</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $totalDosen }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Mata Kuliah Praktikum Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Mata Kuliah Praktikum</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $totalMataKuliah }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 1.27l.642 1.694c.5 1.304 1.675 2.231 3.11 2.231h1.799l-1.476 1.251c-1.036.876-1.476 2.318-1.142 3.683l.642 1.694-1.476-1.251c-1.04-.876-2.518-.876-3.558 0l-1.476 1.251.642-1.694c.334-1.365-.106-2.808-1.142-3.683L6.447 4.92h1.799c1.435 0 2.61-.927 3.11-2.231l.642-1.694z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Lowongan Asisten Praktikum Aktif Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Lowongan Asisten Praktikum Aktif</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $totalLowonganAktif }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-purple-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 6h-2.18c.11-.31.18-.645.18-1a2.996 2.996 0 0 0-5.815-.5H9.615A2.997 2.997 0 0 0 3.82 5c0 .355.07.69.18 1H4c-1.1 0-2 .9-2 2v3h2.26c.585 1.957 2.306 3.5 4.74 3.5s4.155-1.543 4.74-3.5H20V8c0-1.1-.9-2-2-2m-3-2c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Berkas Perlu Verifikasi Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Berkas Perlu Verifikasi</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $berkasMenunggu }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-orange-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endsection
















