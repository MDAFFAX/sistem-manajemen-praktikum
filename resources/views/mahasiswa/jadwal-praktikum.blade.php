@extends('layouts.app')

@section('title', 'Jadwal Praktikum')

@section('content')
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-black">Jadwal Praktikum</h1>
                <p class="text-sm text-gray-600 mt-1">Jadwal yang ditetapkan oleh admin</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">NIM Asisten</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Hari</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Jam</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Ruang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $jadwal)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-800">{{ $jadwal->kode_mata_kuliah }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $jadwal->nim }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $jadwal->hari }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $jadwal->jam }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $jadwal->ruang }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada jadwal praktikum yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection




