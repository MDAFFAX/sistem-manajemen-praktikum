@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-black">Edit Profile</h1>
                <p class="text-sm text-gray-600 mt-1">Perbarui informasi profil Anda</p>
            </div>
            @php
                $showRoute = match($roleType) {
                    'mahasiswa' => route('mahasiswa.profile.show'),
                    'dosen' => route('dosen.profile.show'),
                    default => route('admin.profile.show')
                };
            @endphp
            <a href="{{ $showRoute }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                ← Kembali
            </a>
        </div>

        <!-- Edit Form Card -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8">
            <form action="{{ match($roleType) {
                'mahasiswa' => route('mahasiswa.profile.update'),
                'dosen' => route('dosen.profile.update'),
                default => route('admin.profile.update')
            } }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nama_lengkap" 
                            name="nama_lengkap" 
                            value="{{ old('nama_lengkap', $user->nama_lengkap ?? '') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8bb6d9] focus:border-transparent text-black"
                            placeholder="Masukkan nama lengkap"
                        >
                        @error('nama_lengkap')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $user->email ?? '') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8bb6d9] focus:border-transparent text-black"
                            placeholder="Masukkan email"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIM (Mahasiswa) or NIP (Dosen/Admin) - Readonly -->
                    <div>
                        <label for="identifier" class="block text-sm font-medium text-gray-700 mb-2">
                            @if($roleType === 'mahasiswa')
                                NIM
                            @else
                                NIP
                            @endif
                        </label>
                        <input 
                            type="text" 
                            id="identifier" 
                            value="@if($roleType === 'mahasiswa'){{ $user->nim ?? '-' }}@else{{ $user->nip ?? '-' }}@endif"
                            readonly
                            disabled
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed"
                        >
                        <p class="mt-1 text-xs text-gray-500">Field ini tidak dapat diubah</p>
                    </div>

                    <!-- Program Studi (Mahasiswa only) -->
                    @if($roleType === 'mahasiswa')
                    <div>
                        <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-2">
                            Program Studi
                        </label>
                        <input 
                            type="text" 
                            id="program_studi" 
                            name="program_studi" 
                            value="{{ old('program_studi', $user->program_studi ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8bb6d9] focus:border-transparent text-black"
                            placeholder="Masukkan program studi"
                        >
                        @error('program_studi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif

                    <!-- Divider -->
                    <hr class="border-gray-200 my-6">

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        @php
                            $showRoute = match($roleType) {
                                'mahasiswa' => route('mahasiswa.profile.show'),
                                'dosen' => route('dosen.profile.show'),
                                default => route('admin.profile.show')
                            };
                        @endphp
                        <a href="{{ $showRoute }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold rounded-lg transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-[#8bb6d9] hover:bg-[#7aa5c8] text-black font-semibold rounded-lg transition-colors duration-200 shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
        @endif
    </div>
@endsection




