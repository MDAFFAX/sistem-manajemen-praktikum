@extends('layouts.app')

@section('title', 'Lihat Daftar Pendaftaran Asisten Praktikum')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-black">Lihat Daftar Pendaftaran Asisten Praktikum</h1>
        </div>

        <!-- Table Section -->
        <div class="bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300 text-sm">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-black uppercase tracking-wider w-12">
                            No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">
                            Nama Mahasiswa
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider w-32">
                            NIM
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">
                            Program Studi
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-black uppercase tracking-wider w-20">
                            IPK
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-black uppercase tracking-wider w-28">
                            Status
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-black uppercase tracking-wider w-28">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-300">
                    @forelse($pendaftaran as $index => $item)
                        <tr>
                            <td class="px-4 py-3 text-center text-black">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-black">{{ $item->nama_lengkap ?? '-' }}</td>
                            <td class="px-4 py-3 text-black">{{ $item->nim ?? '-' }}</td>
                            <td class="px-4 py-3 text-black">{{ $item->prodi ?? '-' }}</td>
                            <td class="px-4 py-3 text-center text-black">{{ number_format($item->ipk ?? 0, 2) }}</td>
                            <td class="px-4 py-3 text-center">
                                @php
                                    $statusLower = strtolower($item->status ?? '');
                                    if ($statusLower === 'disetujui') {
                                        $statusClass = 'bg-green-100 text-green-800';
                                    } elseif ($statusLower === 'menunggu') {
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                    } elseif ($statusLower === 'ditolak') {
                                        $statusClass = 'bg-red-100 text-red-800';
                                    } else {
                                        $statusClass = 'bg-gray-100 text-gray-800';
                                    }
                                @endphp
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                    {{ ucfirst($item->status ?? '-') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('dosen.pendaftaran.show', $item->id) }}" 
                                   class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                Belum ada pendaftaran.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
