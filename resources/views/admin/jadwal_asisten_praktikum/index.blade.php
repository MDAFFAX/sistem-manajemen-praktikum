@extends('layouts.app')

@section('title', 'Menetapkan Jadwal Asisten Praktikum')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-black">Menetapkan Jadwal Asisten Praktikum</h1>
                    <p class="text-sm text-gray-500">Kelola jadwal kerja asisten praktikum per mata kuliah</p>
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

        <!-- Add New Schedule Section -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Tambah Jadwal Baru</h2>
                <form action="{{ route('admin.jadwal-asisten.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2">Mata Kuliah</label>
                        <input type="text" name="kode_mata_kuliah" placeholder="e.g., Pemrograman Dasar" 
                               class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                               required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2">NIM Asisten</label>
                        <input type="text" name="nim" placeholder="e.g., 2021101001" 
                               class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                               required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2">Hari</label>
                        <select name="hari" class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2">Jam</label>
                        <input type="text" name="jam" placeholder="e.g., 08:00 - 10:00" 
                               class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                               required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2">Ruang</label>
                        <input type="text" name="ruang" placeholder="e.g., Lab A-101" 
                               class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                               required>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md text-sm transition">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Schedule Table -->
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
                            <th class="px-6 py-3 text-center font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $jadwal)
                            <tr id="row-{{ $jadwal->id }}" class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-800">
                                    <span class="display-kode-{{ $jadwal->id }}">{{ $jadwal->kode_mata_kuliah }}</span>
                                    <input type="text" class="edit-form-{{ $jadwal->id }} edit-input" name="kode_mata_kuliah" value="{{ $jadwal->kode_mata_kuliah }}" style="display:none; width:100%; padding: 0.375rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 0.875rem;">
                                </td>
                                <td class="px-6 py-4 text-gray-800">
                                    <span class="display-nim-{{ $jadwal->id }}">{{ $jadwal->nim }}</span>
                                    <input type="text" class="edit-form-{{ $jadwal->id }} edit-input" name="nim" value="{{ $jadwal->nim }}" style="display:none; width:100%; padding: 0.375rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 0.875rem;">
                                </td>
                                <td class="px-6 py-4 text-gray-800">
                                    <span class="display-hari-{{ $jadwal->id }}">{{ $jadwal->hari }}</span>
                                    <select class="edit-form-{{ $jadwal->id }} edit-input" name="hari" style="display:none; width:100%; padding: 0.375rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 0.875rem;">
                                        <option value="Senin" {{ $jadwal->hari === 'Senin' ? 'selected' : '' }}>Senin</option>
                                        <option value="Selasa" {{ $jadwal->hari === 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                        <option value="Rabu" {{ $jadwal->hari === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                        <option value="Kamis" {{ $jadwal->hari === 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                        <option value="Jumat" {{ $jadwal->hari === 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                        <option value="Sabtu" {{ $jadwal->hari === 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 text-gray-800">
                                    <span class="display-jam-{{ $jadwal->id }}">{{ $jadwal->jam }}</span>
                                    <input type="text" class="edit-form-{{ $jadwal->id }} edit-input" name="jam" value="{{ $jadwal->jam }}" style="display:none; width:100%; padding: 0.375rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 0.875rem;">
                                </td>
                                <td class="px-6 py-4 text-gray-800">
                                    <span class="display-ruang-{{ $jadwal->id }}">{{ $jadwal->ruang }}</span>
                                    <input type="text" class="edit-form-{{ $jadwal->id }} edit-input" name="ruang" value="{{ $jadwal->ruang }}" style="display:none; width:100%; padding: 0.375rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 0.875rem;">
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Edit Button -->
                                        <button type="button" class="edit-btn-{{ $jadwal->id }} inline-flex items-center px-3 py-1 text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-md transition"
                                                onclick="toggleEditMode({{ $jadwal->id }})">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>

                                        <!-- Save Button (hidden by default) -->
                                        <button type="button" class="save-btn-{{ $jadwal->id }} inline-flex items-center px-3 py-1 text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 rounded-md transition"
                                                style="display:none;" onclick="saveEdit({{ $jadwal->id }})">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>

                                        <!-- Cancel Button (hidden by default) -->
                                        <button type="button" class="cancel-btn-{{ $jadwal->id }} inline-flex items-center px-3 py-1 text-xs font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-md transition"
                                                style="display:none;" onclick="cancelEdit({{ $jadwal->id }})">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.jadwal-asisten.delete', $jadwal->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-md transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada jadwal asisten praktikum. Silakan tambahkan jadwal baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function toggleEditMode(id) {
    // Hide display text and show input fields
    document.querySelector('.display-kode-' + id).style.display = 'none';
    document.querySelector('.display-nim-' + id).style.display = 'none';
    document.querySelector('.display-hari-' + id).style.display = 'none';
    document.querySelector('.display-jam-' + id).style.display = 'none';
    document.querySelector('.display-ruang-' + id).style.display = 'none';

    // Show inputs
    const inputs = document.querySelectorAll('.edit-form-' + id);
    inputs.forEach(input => {
        input.style.display = 'inline';
    });

    // Hide edit button, show save/cancel
    document.querySelector('.edit-btn-' + id).style.display = 'none';
    document.querySelector('.save-btn-' + id).style.display = 'inline-flex';
    document.querySelector('.cancel-btn-' + id).style.display = 'inline-flex';
}

function cancelEdit(id) {
    // Show display text and hide inputs
    document.querySelector('.display-kode-' + id).style.display = 'inline';
    document.querySelector('.display-nim-' + id).style.display = 'inline';
    document.querySelector('.display-hari-' + id).style.display = 'inline';
    document.querySelector('.display-jam-' + id).style.display = 'inline';
    document.querySelector('.display-ruang-' + id).style.display = 'inline';

    // Hide inputs
    const inputs = document.querySelectorAll('.edit-form-' + id);
    inputs.forEach(input => {
        input.style.display = 'none';
    });

    // Show edit button, hide save/cancel
    document.querySelector('.edit-btn-' + id).style.display = 'inline-flex';
    document.querySelector('.save-btn-' + id).style.display = 'none';
    document.querySelector('.cancel-btn-' + id).style.display = 'none';
}

function saveEdit(id) {
    const kodeMatKul = document.querySelector('input[name="kode_mata_kuliah"].edit-form-' + id).value;
    const nim = document.querySelector('input[name="nim"].edit-form-' + id).value;
    const hari = document.querySelector('select[name="hari"].edit-form-' + id).value;
    const jam = document.querySelector('input[name="jam"].edit-form-' + id).value;
    const ruang = document.querySelector('input[name="ruang"].edit-form-' + id).value;

    // Send AJAX request
    fetch('{{ route("admin.jadwal-asisten.update", ":id") }}'.replace(':id', id), {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            kode_mata_kuliah: kodeMatKul,
            nim: nim,
            hari: hari,
            jam: jam,
            ruang: ruang
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update display
            document.querySelector('.display-kode-' + id).textContent = kodeMatKul;
            document.querySelector('.display-nim-' + id).textContent = nim;
            document.querySelector('.display-hari-' + id).textContent = hari;
            document.querySelector('.display-jam-' + id).textContent = jam;
            document.querySelector('.display-ruang-' + id).textContent = ruang;

            // Hide inputs and show display
            document.querySelector('.display-kode-' + id).style.display = 'inline';
            document.querySelector('.display-nim-' + id).style.display = 'inline';
            document.querySelector('.display-hari-' + id).style.display = 'inline';
            document.querySelector('.display-jam-' + id).style.display = 'inline';
            document.querySelector('.display-ruang-' + id).style.display = 'inline';

            const inputs = document.querySelectorAll('.edit-form-' + id);
            inputs.forEach(input => {
                input.style.display = 'none';
            });

            // Show edit button, hide save/cancel
            document.querySelector('.edit-btn-' + id).style.display = 'inline-flex';
            document.querySelector('.save-btn-' + id).style.display = 'none';
            document.querySelector('.cancel-btn-' + id).style.display = 'none';

            // Show success message
            alert('Jadwal berhasil diperbarui!');
        } else {
            alert('Terjadi kesalahan saat menyimpan jadwal.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan: ' + error.message);
    });
}
</script>
@endpush







