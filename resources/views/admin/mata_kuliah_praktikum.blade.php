@extends('layouts.app')

@section('title', 'Kelola Data Mata Kuliah Praktikum')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-black">Kelola Data Mata Kuliah Praktikum</h1>
                    <p class="text-sm text-gray-500">Manajemen data mata kuliah praktikum program studi</p>
                </div>
            </div>

            <!-- Button Tambah Mata Kuliah -->
            <button
                type="button"
                onclick="openMkCreateModal()"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
            >
                <span class="mr-2 text-lg leading-none">+</span>
                Tambah Mata Kuliah
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
                            No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                            Kode Mata Kuliah
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Mata Kuliah
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-20">
                            SKS
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    {{-- Data dari database --}}
                    @foreach($mataKuliah as $index => $mk)
                        <tr>
                            <td class="px-4 py-3 text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $mk->kode }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $mk->nama }}</td>
                            <td class="px-4 py-3 text-center text-gray-700">{{ $mk->sks }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <button type="button"
                                        onclick='openMkEditModal(@json($mk))'
                                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Edit
                                </button>

                                <form action="{{ route('admin.mata-kuliah.delete', $mk->id) }}" method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            onclick="confirmMkDelete(this.form)"
                                            class="inline-flex items-center px-3 py-1.5 border border-red-300 text-xs font-semibold rounded-md text-red-600 bg-white hover:bg-red-50">
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

    <!-- Modal MK -->
    <div id="mk-modal-backdrop"
         class="fixed inset-0 bg-black bg-opacity-30 hidden items-center justify-center z-40">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 id="mk-modal-title" class="text-lg font-semibold text-black">
                    Tambah Mata Kuliah Praktikum
                </h2>
                <button type="button" onclick="closeMkModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="mk-form" method="POST" action="{{ route('admin.mata-kuliah.store') }}"
                  class="px-6 py-4 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="mk-form-method" value="POST">

                <div>
                    <label for="kode" class="block text-sm font-medium text-gray-700 mb-1">
                        Kode Mata Kuliah
                    </label>
                    <input type="text" id="kode" name="kode"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           required>
                </div>

                <div>
                    <label for="nama_mk" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Mata Kuliah
                    </label>
                    <input type="text" id="nama_mk" name="nama"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           required>
                </div>

                <div>
                    <label for="sks" class="block text-sm font-medium text-gray-700 mb-1">
                        SKS
                    </label>
                    <input type="number" id="sks" name="sks" min="1" max="10"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           required>
                </div>
            </form>

            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button"
                        onclick="closeMkModal()"
                        class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="button"
                        onclick="document.getElementById('mk-form').submit()"
                        class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <script>
        function openMkCreateModal() {
            const form = document.getElementById('mk-form');
            const methodInput = document.getElementById('mk-form-method');
            const title = document.getElementById('mk-modal-title');

            form.action = "{{ route('admin.mata-kuliah.store') }}";
            methodInput.value = 'POST';
            form.reset();

            title.textContent = 'Tambah Mata Kuliah Praktikum';
            const backdrop = document.getElementById('mk-modal-backdrop');
            backdrop.classList.remove('hidden');
            backdrop.classList.add('flex');
        }

        function openMkEditModal(mk) {
            const form = document.getElementById('mk-form');
            const methodInput = document.getElementById('mk-form-method');
            const title = document.getElementById('mk-modal-title');

            form.action = "{{ route('admin.mata-kuliah.update', ['id' => '__ID__']) }}".replace('__ID__', mk.id);
            methodInput.value = 'PUT';

            document.getElementById('kode').value = mk.kode;
            document.getElementById('nama_mk').value = mk.nama;
            document.getElementById('sks').value = mk.sks;

            title.textContent = 'Edit Mata Kuliah Praktikum';
            const backdrop = document.getElementById('mk-modal-backdrop');
            backdrop.classList.remove('hidden');
            backdrop.classList.add('flex');
        }

        function closeMkModal() {
            const backdrop = document.getElementById('mk-modal-backdrop');
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
        }

        function confirmMkDelete(form) {
            if (confirm('Yakin ingin menghapus mata kuliah praktikum ini?')) {
                form.submit();
            }
        }

        // dummy delete helper removed — no-op function removed to match dosen template
    </script>
@endsection


