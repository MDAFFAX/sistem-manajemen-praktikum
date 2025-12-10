@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-black">Profile Saya</h1>
                <p class="text-sm text-gray-600 mt-1">Informasi profil pengguna</p>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 mb-6">
            <!-- Profile Header: Avatar + Name + Role -->
            <div class="flex flex-col items-center mb-8 pb-8 border-b border-gray-200">
                <!-- Avatar -->
                <div class="w-24 h-24 bg-[#8bb6d9] rounded-full flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <!-- Name -->
                <h2 class="text-2xl font-bold text-black mb-2">{{ $user->nama_lengkap ?? '-' }}</h2>
                <!-- Role Badge -->
                <span class="inline-flex items-center px-4 py-1 text-sm font-semibold rounded-full bg-[#8bb6d9] text-black">
                    {{ $role }}
                </span>
            </div>

            <!-- Profile Information Table -->
            <div class="space-y-4">
                <!-- Nama Lengkap -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-3 border-b border-gray-100">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-base text-black font-semibold">{{ $user->nama_lengkap ?? '-' }}</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-3 border-b border-gray-100">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-base text-black font-semibold">{{ $user->email ?? '-' }}</p>
                    </div>
                </div>

                <!-- NIM (Mahasiswa) or NIP (Dosen/Admin) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-3 border-b border-gray-100">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700">
                            @if($roleType === 'mahasiswa')
                                NIM
                            @else
                                NIP
                            @endif
                        </label>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-base text-black font-semibold">
                            @if($roleType === 'mahasiswa')
                                {{ $user->nim ?? '-' }}
                            @else
                                {{ $user->nip ?? '-' }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Program Studi (Mahasiswa only) -->
                @if($roleType === 'mahasiswa')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-3 border-b border-gray-100">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-base text-black font-semibold">{{ $user->program_studi ?? '-' }}</p>
                    </div>
                </div>
                @endif

                <!-- Jabatan (Dosen only) -->
                @if($roleType === 'dosen' && isset($user->jabatan))
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-3 border-b border-gray-100">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-base text-black font-semibold">{{ $user->jabatan }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            @php
                $editRoute = match($roleType) {
                    'mahasiswa' => route('mahasiswa.profile.edit'),
                    'dosen' => route('dosen.profile.edit'),
                    default => route('admin.profile.edit')
                };
            @endphp
            <a href="{{ $editRoute }}" class="inline-flex items-center justify-center px-6 py-3 bg-[#8bb6d9] hover:bg-[#7aa5c8] text-black font-semibold rounded-lg transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Profil
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors duration-200 shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
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




