@php
    $role = $role ?? 'Admin';
@endphp

<header class="w-full bg-[#8bb6d9] h-16 flex items-center justify-between px-6 shadow-sm">
    <!-- Left: Home Icon + Role -->
    <div class="flex items-center space-x-3">
        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-black font-semibold text-lg">{{ $role }}</span>
    </div>

    <!-- Center: Logo -->
    <div class="flex-1 flex justify-center">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
            Simprak<span class="text-[#E53935]">.</span>
        </h1>
    </div>

    <!-- Right: Profile Icon & Logout -->
    <div class="flex items-center space-x-4">
        @php
            $currentRole = strtolower(session('role') ?? 'admin');
            $profileRoute = match($currentRole) {
                'mahasiswa' => route('mahasiswa.profile.show'),
                'dosen' => route('dosen.profile.show'),
                default => route('admin.profile.show')
            };
        @endphp
        <a href="{{ $profileRoute }}" class="flex items-center hover:opacity-80 transition-opacity" title="Profile">
            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="flex items-center hover:opacity-80 transition-opacity" title="Logout">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </form>
    </div>
</header>
















