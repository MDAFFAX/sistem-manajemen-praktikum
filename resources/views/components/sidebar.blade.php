@php
    $activeMenu = $activeMenu ?? 'dashboard';
    
    $menuItems = [
        [
            'id' => 'dashboard',
            'label' => 'Dashboard',
            'icon' => 'home',
            'route' => '/admin/dashboard'
        ],
        [
            'id' => 'kelola-dosen',
            'label' => 'Kelola Data Dosen',
            'icon' => 'user-document',
            'route' => route('admin.dosen.index')
        ],
        [
            'id' => 'kelola-mata-kuliah',
            'label' => 'Kelola Data Mata Kuliah Praktikum',
            'icon' => 'document-cap',
            'route' => route('admin.mata-kuliah.index')
        ],
        [
            'id' => 'kelola-tahun-ajaran',
            'label' => 'Kelola Data Tahun Ajaran',
            'icon' => 'book',
            'route' => route('admin.tahun-ajaran.index')
        ],
        [
            'id' => 'kelola-lowongan',
            'label' => 'Kelola Lowongan Asisten Praktikum',
            'icon' => 'briefcase',
            'route' => route('admin.lowongan-asprak.index')
        ],
        [
            'id' => 'verifikasi-berkas',
            'label' => 'Verifikasi Berkas Pendaftaran',
            'icon' => 'document',
            'route' => route('admin.verifikasi-berkas.index')
        ],
        [
            'id' => 'kelola-asisten',
            'label' => 'Kelola Data Asisten Praktikum',
            'icon' => 'user-search',
            'route' => route('admin.asisten-praktikum.index')
        ],
        [
            'id' => 'jadwal-asisten',
            'label' => 'Menetapkan Jadwal Asisten Praktikum',
            'icon' => 'calendar',
            'route' => route('admin.jadwal-asisten.index')
        ],
    ];
@endphp

<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    <nav class="flex-1 py-4">
        @foreach($menuItems as $item)
            <a href="{{ $item['route'] }}" 
               class="flex items-center space-x-3 px-6 py-3 {{ $activeMenu === $item['id'] ? 'bg-gray-100' : 'hover:bg-gray-50' }} transition-colors">
                <!-- Icon -->
                <div class="flex-shrink-0">
                    @if($item['icon'] === 'home')
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    @elseif($item['icon'] === 'user-document')
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    @elseif($item['icon'] === 'document-cap')
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    @elseif($item['icon'] === 'book')
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    @elseif($item['icon'] === 'briefcase')
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    @elseif($item['icon'] === 'document')
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    @elseif($item['icon'] === 'user-search')
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    @elseif($item['icon'] === 'calendar')
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endif
                </div>
                <!-- Label -->
                <span class="text-black font-medium text-sm">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>

