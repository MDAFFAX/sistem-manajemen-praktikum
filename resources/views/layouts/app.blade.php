<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Simprak</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'system-ui', 'sans-serif'],
                        },
                    },
                },
            };
        </script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap" rel="stylesheet">
    @endif
</head>
<body class="min-h-screen bg-gray-50 font-sans">
    <div class="flex flex-col h-screen">
        <!-- Header -->
        @include('components.header', ['role' => $role ?? 'Admin'])
        
        <div class="flex flex-1 overflow-hidden">
            <!-- Sidebar -->
            @php
                $sidebarType = $sidebarType ?? 'admin';
            @endphp
            
            @if($sidebarType === 'dosen')
                @include('components.sidebar-dosen', ['activeMenu' => $activeMenu ?? 'dashboard'])
            @elseif($sidebarType === 'mahasiswa')
                @include('components.sidebar-mahasiswa', ['activeMenu' => $activeMenu ?? 'dashboard'])
            @else
                @include('components.sidebar', ['activeMenu' => $activeMenu ?? 'dashboard'])
            @endif
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-white p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
    @stack('scripts')
</html>

