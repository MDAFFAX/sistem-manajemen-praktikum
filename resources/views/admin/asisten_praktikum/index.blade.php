@extends('layouts.app')

@section('title', 'Kelola Data Asisten Praktikum')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-black">Kelola Data Asisten Praktikum</h1>
                    <p class="text-sm text-gray-500">Manajemen data asisten praktikum program studi</p>
                </div>
            </div>

            <!-- Button Tambah Asisten -->
            <button
                type="button"
                onclick="openCreateModal()"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
            >
                <span class="mr-2 text-lg leading-none">+</span>
                Tambah Data Asisten
            </button>
        </div>

        <!-- Alert success -->
        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Section -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">
                            Id asprak
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                            Nim
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                            Periode mulai
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                            Periode selesai
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">
                            Status
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data dummy -->
                    <tr>
                        <td class="px-4 py-3 text-gray-700">1</td>
                        <td class="px-4 py-3 text-gray-700">60703232292</td>
                        <td class="px-4 py-3 text-gray-700">22-09-2025</td>
                        <td class="px-4 py-3 text-gray-700">03-01-2026</td>
                        <td class="px-4 py-3 text-gray-700">Aktif</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <button
                                type="button"
                                onclick="openEditModal({
                                    id: 1,
                                    nim: '60703232292',
                                    periode_mulai: '2025-09-22',
                                    periode_selesai: '2026-01-03',
                                    status: 'Aktif'
                                })"
                                class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Edit
                            </button>
                            <button
                                type="button"
                                onclick=\"alert('Ini contoh data dummy, bukan dari database.');\"
                                class="inline-flex items-center px-3 py-1.5 border border-red-300 text-xs font-semibold rounded-md text-red-600 bg-white hover:bg-red-50"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>

                    {{-- Data dari database --}}
                    @foreach($asistens as $index => $asisten)
                        <tr>
                            <td class="px-4 py-3 text-gray-700">{{ $asisten->id }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $asisten->nim }}</td>
                            <td class="px-4 py-3 text-gray-700">
                                {{ \Carbon\Carbon::parse($asisten->periode_mulai)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-gray-700">
                                {{ \Carbon\Carbon::parse($asisten->periode_selesai)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $asisten->status }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <button
                                    type="button"
                                    onclick='openEditModal(@json($asisten))'
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                >
                                    Edit
                                </button>

                                <form action="{{ route('admin.asisten-praktikum.delete', $asisten->id) }}" method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="button"
                                        onclick="confirmDelete(this.form)"
                                        class="inline-flex items-center px-3 py-1.5 border border-red-300 text-xs font-semibold rounded-md text-red-600 bg-white hover:bg-red-50"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Asisten -->
    <div id="asisten-modal-backdrop"
         class="fixed inset-0 bg-black bg-opacity-30 hidden items-center justify-center z-40">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 id="asisten-modal-title" class="text-lg font-semibold text-black">
                    Tambah Data Asisten
                </h2>
                <button type="button" onclick="closeAsistenModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="asisten-form" method="POST" action="{{ route('admin.asisten-praktikum.store') }}"
                  class="px-6 py-4 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="asisten-form-method" value="POST">

                <div>
                    <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">
                        Nim
                    </label>
                    <input type="text" id="nim" name="nim"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           required>
                </div>

                <div>
                    <label for="periode_mulai" class="block text-sm font-medium text-gray-700 mb-1">
                        Periode mulai
                    </label>
                    <input type="date" id="periode_mulai" name="periode_mulai"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           required>
                </div>

                <div>
                    <label for="periode_selesai" class="block text-sm font-medium text-gray-700 mb-1">
                        Periode selesai
                    </label>
                    <input type="date" id="periode_selesai" name="periode_selesai"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           required>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                        Status
                    </label>
                    <select id="status" name="status"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            required>
                        <option value="">Pilih Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </form>

            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button"
                        onclick="closeAsistenModal()"
                        class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="button"
                        onclick="document.getElementById('asisten-form').submit()"
                        class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <script>
        function openCreateModal() {
            const form = document.getElementById('asisten-form');
            const methodInput = document.getElementById('asisten-form-method');
            const title = document.getElementById('asisten-modal-title');

            form.action = "{{ route('admin.asisten-praktikum.store') }}";
            methodInput.value = 'POST';
            form.reset();

            title.textContent = 'Tambah Data Asisten';
            const backdrop = document.getElementById('asisten-modal-backdrop');
            backdrop.classList.remove('hidden');
            backdrop.classList.add('flex');
        }

        function openEditModal(asisten) {
            const form = document.getElementById('asisten-form');
            const methodInput = document.getElementById('asisten-form-method');
            const title = document.getElementById('asisten-modal-title');

            form.action = "{{ route('admin.asisten-praktikum.update', ['id' => '__ID__']) }}".replace('__ID__', asisten.id);
            methodInput.value = 'PUT';

            document.getElementById('nim').value = asisten.nim;
            document.getElementById('periode_mulai').value = asisten.periode_mulai;
            document.getElementById('periode_selesai').value = asisten.periode_selesai;
            document.getElementById('status').value = asisten.status;

            title.textContent = 'Edit Data Asisten';
            const backdrop = document.getElementById('asisten-modal-backdrop');
            backdrop.classList.remove('hidden');
            backdrop.classList.add('flex');
        }

        function closeAsistenModal() {
            const backdrop = document.getElementById('asisten-modal-backdrop');
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
        }

        function confirmDelete(form) {
            if (confirm('Yakin ingin menghapus data asisten ini?')) {
                form.submit();
            }
        }
    </script>
@endsection







