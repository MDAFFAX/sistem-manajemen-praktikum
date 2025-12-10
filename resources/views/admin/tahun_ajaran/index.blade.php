@extends('layouts.app')

@section('title', 'Kelola Data Tahun Ajaran')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-black">Kelola Data Tahun Ajaran</h1>
                    <p class="text-sm text-gray-500">Manajemen data tahun ajaran program studi</p>
                </div>
            </div>

            <!-- Button Tambah Tahun Ajaran -->
            <button
                type="button"
                onclick="openCreateModal()"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
            >
                <span class="mr-2 text-lg leading-none">+</span>
                Tambah Tahun Ajaran
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
                            Tahun Ajaran
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                            Semester
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                            Status
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data dummy statis sesuai permintaan -->
                    <tr>
                        <td class="px-4 py-3 text-gray-700">1</td>
                        <td class="px-4 py-3 text-gray-700">2025/2026</td>
                        <td class="px-4 py-3 text-gray-700">Ganjil</td>
                        <td class="px-4 py-3 text-gray-700">Aktif</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <!-- Tombol Edit -->
                            <button
                                type="button"
                                onclick="openEditModal({
                                    id: 1,
                                    tahun_ajaran: '2025/2026',
                                    semester: 'Ganjil',
                                    status: 'Aktif'
                                })"
                                class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="#" method="POST" class="inline">
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
                    <tr>
                        <td class="px-4 py-3 text-gray-700">2</td>
                        <td class="px-4 py-3 text-gray-700">2024/2025</td>
                        <td class="px-4 py-3 text-gray-700">Genap</td>
                        <td class="px-4 py-3 text-gray-700">Nonaktif</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <!-- Tombol Edit -->
                            <button
                                type="button"
                                onclick="openEditModal({
                                    id: 2,
                                    tahun_ajaran: '2024/2025',
                                    semester: 'Genap',
                                    status: 'Nonaktif'
                                })"
                                class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="#" method="POST" class="inline">
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

                    {{-- Contoh iterasi jika nanti sudah pakai data dari database --}}
                    @foreach($tahunAjarans as $index => $tahunAjaran)
                        <tr>
                            <td class="px-4 py-3 text-gray-700">{{ count($tahunAjarans) - $index + 2 }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $tahunAjaran->tahun_ajaran }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $tahunAjaran->semester }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $tahunAjaran->status }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <button
                                    type="button"
                                    onclick='openEditModal(@json($tahunAjaran))'
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                >
                                    Edit
                                </button>

                                <form action="{{ route('admin.tahun-ajaran.delete', $tahunAjaran->id) }}" method="POST"
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
    <div id="tahun-ajaran-modal-backdrop"
         class="fixed inset-0 bg-black bg-opacity-30 hidden items-center justify-center z-40">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 id="tahun-ajaran-modal-title" class="text-lg font-semibold text-black">
                    Tambah Tahun Ajaran
                </h2>
                <button type="button" onclick="closeTahunAjaranModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="tahun-ajaran-form" method="POST" action="{{ route('admin.tahun-ajaran.store') }}" class="px-6 py-4 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="tahun-ajaran-form-method" value="POST">

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
                    <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">
                        Semester
                    </label>
                    <select id="semester" name="semester"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           required>
                        <option value="">Pilih Semester</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
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
                        onclick="closeTahunAjaranModal()"
                        class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="button"
                        onclick="document.getElementById('tahun-ajaran-form').submit()"
                        class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <script>
        function openCreateModal() {
            const form = document.getElementById('tahun-ajaran-form');
            const methodInput = document.getElementById('tahun-ajaran-form-method');
            const title = document.getElementById('tahun-ajaran-modal-title');

            form.action = "{{ route('admin.tahun-ajaran.store') }}";
            methodInput.value = 'POST';

            form.reset();

            title.textContent = 'Tambah Tahun Ajaran';
            document.getElementById('tahun-ajaran-modal-backdrop').classList.remove('hidden');
            document.getElementById('tahun-ajaran-modal-backdrop').classList.add('flex');
        }

        function openEditModal(tahunAjaran) {
            const form = document.getElementById('tahun-ajaran-form');
            const methodInput = document.getElementById('tahun-ajaran-form-method');
            const title = document.getElementById('tahun-ajaran-modal-title');

            form.action = "{{ route('admin.tahun-ajaran.update', ['id' => '__ID__']) }}".replace('__ID__', tahunAjaran.id);
            methodInput.value = 'PUT';

            document.getElementById('tahun_ajaran').value = tahunAjaran.tahun_ajaran;
            document.getElementById('semester').value = tahunAjaran.semester;
            document.getElementById('status').value = tahunAjaran.status;

            title.textContent = 'Edit Tahun Ajaran';
            document.getElementById('tahun-ajaran-modal-backdrop').classList.remove('hidden');
            document.getElementById('tahun-ajaran-modal-backdrop').classList.add('flex');
        }

        function closeTahunAjaranModal() {
            const backdrop = document.getElementById('tahun-ajaran-modal-backdrop');
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
        }

        function confirmDelete(form) {
            if (confirm('Yakin ingin menghapus data tahun ajaran ini?')) {
                form.submit();
            }
        }
    </script>
@endsection







