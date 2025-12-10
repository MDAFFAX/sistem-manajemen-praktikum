@extends('layouts.app')

@section('title', 'Kelola Data Dosen')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-black">Kelola Data Dosen</h1>
                <p class="text-sm text-gray-500">Manajemen data dosen program studi</p>
            </div>
        </div>

        <!-- Alert success -->
        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Form -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 mb-6">

        <!-- Alert success -->
        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Form -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Tambah Data Dosen</h2>
            <form action="{{ route('admin.dosen.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <input type="text" name="nama" placeholder="Nama Dosen" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <input type="text" name="nip" placeholder="NIP" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <input type="text" name="jabatan" placeholder="Jabatan" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700">
                        Tambah
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-12">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Dosen</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">NIP</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Jabatan</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($dosens as $index => $dosen)
                            <tr>
                                <td class="px-4 py-3 text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    <span class="display-nama-{{ $dosen->id }} text-gray-700">{{ $dosen->nama }}</span>
                                    <input type="text" class="edit-form-{{ $dosen->id }} w-full px-2 py-1 border border-gray-300 rounded text-sm" 
                                           value="{{ $dosen->nama }}" style="display:none;">
                                </td>
                                <td class="px-4 py-3">
                                    <span class="display-nip-{{ $dosen->id }} text-gray-700">{{ $dosen->nip }}</span>
                                    <input type="text" class="edit-form-{{ $dosen->id }} w-full px-2 py-1 border border-gray-300 rounded text-sm" 
                                           value="{{ $dosen->nip }}" style="display:none;">
                                </td>
                                <td class="px-4 py-3">
                                    <span class="display-email-{{ $dosen->id }} text-gray-700">{{ $dosen->email }}</span>
                                    <input type="email" class="edit-form-{{ $dosen->id }} w-full px-2 py-1 border border-gray-300 rounded text-sm" 
                                           value="{{ $dosen->email }}" style="display:none;">
                                </td>
                                <td class="px-4 py-3">
                                    <span class="display-jabatan-{{ $dosen->id }} text-gray-700">{{ $dosen->jabatan }}</span>
                                    <input type="text" class="edit-form-{{ $dosen->id }} w-full px-2 py-1 border border-gray-300 rounded text-sm" 
                                           value="{{ $dosen->jabatan }}" style="display:none;">
                                </td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <button type="button" onclick="toggleEditMode({{ $dosen->id }})" 
                                            class="edit-btn-{{ $dosen->id }} inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button type="button" onclick="saveEdit({{ $dosen->id }}, '{{ route('admin.dosen.update', $dosen->id) }}')" 
                                            class="save-btn-{{ $dosen->id }} inline-flex items-center px-3 py-1.5 border border-green-300 text-xs font-semibold rounded-md text-green-600 bg-white hover:bg-green-50" style="display:none;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button type="button" onclick="cancelEdit({{ $dosen->id }})" 
                                            class="cancel-btn-{{ $dosen->id }} inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50" style="display:none;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.dosen.delete', $dosen->id) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus data dosen ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-red-300 text-xs font-semibold rounded-md text-red-600 bg-white hover:bg-red-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-3 text-center text-gray-500">Tidak ada data dosen</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleEditMode(id) {
            const inputs = document.querySelectorAll('.edit-form-' + id);
            const displays = document.querySelectorAll('[class*="display-"][class*="-' + id + '"]');
            const editBtn = document.querySelector('.edit-btn-' + id);
            const saveBtn = document.querySelector('.save-btn-' + id);
            const cancelBtn = document.querySelector('.cancel-btn-' + id);

            inputs.forEach(input => input.style.display = 'block');
            displays.forEach(display => display.style.display = 'none');
            editBtn.style.display = 'none';
            saveBtn.style.display = 'inline-flex';
            cancelBtn.style.display = 'inline-flex';
        }

        function cancelEdit(id) {
            const inputs = document.querySelectorAll('.edit-form-' + id);
            const displays = document.querySelectorAll('[class*="display-"][class*="-' + id + '"]');
            const editBtn = document.querySelector('.edit-btn-' + id);
            const saveBtn = document.querySelector('.save-btn-' + id);
            const cancelBtn = document.querySelector('.cancel-btn-' + id);

            inputs.forEach(input => input.style.display = 'none');
            displays.forEach(display => display.style.display = 'inline');
            editBtn.style.display = 'inline-flex';
            saveBtn.style.display = 'none';
            cancelBtn.style.display = 'none';
        }

        function saveEdit(id, url) {
            const inputs = document.querySelectorAll('.edit-form-' + id);
            const nama_input = inputs[0];
            const nip_input = inputs[1];
            const email_input = inputs[2];
            const jabatan_input = inputs[3];

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    nama: nama_input.value,
                    nip: nip_input.value,
                    email: email_input.value,
                    jabatan: jabatan_input.value
                })
            })
            .then(async response => {
                const data = await response.json().catch(() => null);

                if (!response.ok || !data) {
                    throw new Error('Response tidak valid');
                }

                if (data.success) {
                    document.querySelector('.display-nama-' + id).textContent = nama_input.value;
                    document.querySelector('.display-nip-' + id).textContent = nip_input.value;
                    document.querySelector('.display-email-' + id).textContent = email_input.value;
                    document.querySelector('.display-jabatan-' + id).textContent = jabatan_input.value;
                    cancelEdit(id);
                } else {
                    alert(data.message || 'Terjadi kesalahan saat menyimpan data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data');
            });
        }
    </script>
@endsection








