@extends('layouts.app')

@section('title', 'Kelola Lowongan Asisten Praktikum')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-black">Kelola Lowongan Asisten Praktikum</h1>
                    <p class="text-sm text-gray-500">Manajemen lowongan asisten praktikum program studi</p>
                </div>
            </div>

            <!-- Button Tambah Lowongan -->
            <button
                type="button"
                onclick="openCreateModal()"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
            >
                <span class="mr-2 text-lg leading-none">+</span>
                Tambah Lowongan
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
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">
                            No
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Mata Kuliah
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                            Prodi
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-48">
                            Dosen
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">
                            Tahun Ajaran
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                            Tgl. Awal Pendaftaran
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                            Tgl. Akhir Pendaftaran
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-20">
                            Kuota
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    {{-- Jika ada data di database, tampilkan di bawah ini --}}
                    @foreach($lowongans as $lowongan)
                        <tr>
                            <td class="px-4 py-3 text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $lowongan->mata_kuliah }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $lowongan->prodi ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $lowongan->dosen ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $lowongan->tahun_ajaran }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($lowongan->tanggal_awal_pendaftaran)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($lowongan->tanggal_akhir_pendaftaran)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $lowongan->kuota }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <button
                                    type="button"
                                    onclick='openEditModal(@json($lowongan))'
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                >
                                    Edit
                                </button>

                                <form action="{{ route('admin.lowongan-asprak.delete', $lowongan->id) }}" method="POST"
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

    <!-- Modal Backdrop -->
    <div id="lowongan-modal-backdrop"
         class="fixed inset-0 bg-black bg-opacity-30 hidden items-center justify-center z-40">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 id="lowongan-modal-title" class="text-lg font-semibold text-black">
                    Tambah Lowongan
                </h2>
                <button type="button" onclick="closeLowonganModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="lowongan-form" method="POST" action="{{ route('admin.lowongan-asprak.store') }}" class="px-6 py-4 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="lowongan-form-method" value="POST">

                <div>
                    <label for="mata_kuliah" class="block text-sm font-medium text-gray-700 mb-1">
                        Mata Kuliah
                    </label>
                    <input type="text" id="mata_kuliah" name="mata_kuliah"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="Contoh: Pemrograman Web"
                           required>
                </div>

                <div>
                    <label for="prodi" class="block text-sm font-medium text-gray-700 mb-1">
                        Prodi
                    </label>
                    <input type="text" id="prodi" name="prodi"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="Contoh: Teknologi Informasi"
                    >
                </div>

                <div>
                    <label for="dosen" class="block text-sm font-medium text-gray-700 mb-1">
                        Dosen
                    </label>
                    <input type="text" id="dosen" name="dosen"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="Contoh: Bapak/Ibu Nama Dosen"
                           required>
                </div>

                <div>
                    <label for="tahun_ajaran" class="block text-sm font-medium text-gray-700 mb-1">
                        Tahun Ajaran
                    </label>
                    <input type="text" id="tahun_ajaran" name="tahun_ajaran"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="Contoh: 2025/2026"
                           required>
                </div>

                <div>
                    <label for="tanggal_awal_pendaftaran" class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Awal Pendaftaran
                    </label>
                    <input type="date" id="tanggal_awal_pendaftaran" name="tanggal_awal_pendaftaran"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           required>
                </div>

                <div>
                    <label for="tanggal_akhir_pendaftaran" class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Akhir Pendaftaran
                    </label>
                    <input type="date" id="tanggal_akhir_pendaftaran" name="tanggal_akhir_pendaftaran"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           required>
                </div>

                <div>
                    <label for="kuota" class="block text-sm font-medium text-gray-700 mb-1">
                        Kuota
                    </label>
                    <input type="number" id="kuota" name="kuota"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="Contoh: 3"
                           min="1"
                           required>
                </div>

            </form>

            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button"
                        onclick="closeLowonganModal()"
                        class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="button"
                        onclick="document.getElementById('lowongan-form').submit()"
                        class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <script>
        function openCreateModal() {
            const form = document.getElementById('lowongan-form');
            const methodInput = document.getElementById('lowongan-form-method');
            const title = document.getElementById('lowongan-modal-title');

            form.action = "{{ route('admin.lowongan-asprak.store') }}";
            methodInput.value = 'POST';

            form.reset();

            title.textContent = 'Tambah Lowongan';
            document.getElementById('lowongan-modal-backdrop').classList.remove('hidden');
            document.getElementById('lowongan-modal-backdrop').classList.add('flex');
        }

        function openEditModal(lowongan) {
            const form = document.getElementById('lowongan-form');
            const methodInput = document.getElementById('lowongan-form-method');
            const title = document.getElementById('lowongan-modal-title');

            form.action = "{{ route('admin.lowongan-asprak.update', ['id' => '__ID__']) }}".replace('__ID__', lowongan.id);
            methodInput.value = 'PUT';

            document.getElementById('mata_kuliah').value = lowongan.mata_kuliah;
            document.getElementById('prodi').value = lowongan.prodi || '';
            document.getElementById('dosen').value = lowongan.dosen || '';
            document.getElementById('tahun_ajaran').value = lowongan.tahun_ajaran;
            document.getElementById('tanggal_awal_pendaftaran').value = lowongan.tanggal_awal_pendaftaran;
            document.getElementById('tanggal_akhir_pendaftaran').value = lowongan.tanggal_akhir_pendaftaran;
            document.getElementById('kuota').value = lowongan.kuota;

            title.textContent = 'Edit Lowongan';
            document.getElementById('lowongan-modal-backdrop').classList.remove('hidden');
            document.getElementById('lowongan-modal-backdrop').classList.add('flex');
        }

        function closeLowonganModal() {
            const backdrop = document.getElementById('lowongan-modal-backdrop');
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
        }

        function confirmDelete(form) {
            if (confirm('Yakin ingin menghapus data lowongan ini?')) {
                form.submit();
            }
        }
    </script>
@endsection







