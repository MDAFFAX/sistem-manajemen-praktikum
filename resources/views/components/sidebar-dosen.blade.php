@php
    $activeMenu = $activeMenu ?? 'dashboard';
    
    $menuItems = [
        [
            'id' => 'pendaftaran',
            'label' => 'Lihat Daftar Pendaftaran Asisten Praktikum',
            'icon' => 'users-list',
            'route' => route('dosen.pendaftaran.index')
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
                    @elseif($item['icon'] === 'users-list')
                        <!-- Icon 3 orang dengan garis horizontal (list) -->
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    @endif
                </div>
                <!-- Label -->
                <span class="text-black font-medium text-sm {{ $activeMenu === $item['id'] ? 'font-bold' : '' }}">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>

