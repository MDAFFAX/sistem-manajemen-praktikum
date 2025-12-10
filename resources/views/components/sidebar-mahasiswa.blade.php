@php
    $activeMenu = $activeMenu ?? 'dashboard';
    
    $menuItems = [
        [
            'id' => 'jadwal-praktikum',
            'label' => 'Jadwal Praktikum',
            'icon' => 'calendar-clock',
            'route' => route('mahasiswa.jadwal-praktikum')
        ],
        [
            'id' => 'lowongan-asprak',
            'label' => 'Lowongan Asisten Praktikum',
            'icon' => 'document',
            'route' => route('mahasiswa.lowongan-asprak.index')
        ],
        [
            'id' => 'status-seleksi',
            'label' => 'Lihat status seleksi',
            'icon' => 'checklist',
            'route' => route('mahasiswa.status-seleksi')
        ],
    ];
@endphp

<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    <nav class="flex-1 py-4">
        @foreach($menuItems as $item)
            <a href="{{ $item['route'] }}" 
               class="flex items-center space-x-3 px-6 py-3 {{ $activeMenu === $item['id'] ? 'bg-[#d9d9d9]' : 'hover:bg-gray-50' }} transition-colors">
                <!-- Icon -->
                <div class="flex-shrink-0">
                    @if($item['icon'] === 'home')
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    @elseif($item['icon'] === 'calendar-clock')
                        <!-- Icon kalender dengan clock -->
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @elseif($item['icon'] === 'document')
                        <!-- Icon dokumen dengan garis horizontal -->
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    @elseif($item['icon'] === 'checklist')
                        <!-- Icon checklist dengan 3 checkmark -->
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    @endif
                </div>
                <!-- Label -->
                <span class="text-black font-medium text-sm {{ $activeMenu === $item['id'] ? 'font-bold' : '' }}">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>











