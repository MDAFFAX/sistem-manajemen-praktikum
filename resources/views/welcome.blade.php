<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simprak</title>

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
<body class="min-h-screen flex flex-col bg-white font-sans">
    <header class="h-[60px] bg-[#64B5F6] flex items-center justify-center shadow-sm">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
            Simprak<span class="text-[#E53935]">.</span>
        </h1>
    </header>

    <main class="flex-1 flex items-center justify-center px-4">
        <section class="w-full max-w-xs bg-[#e0e0e0] rounded-md border border-[#cccccc] shadow-sm">
            <div class="divide-y divide-[#c9c9c9]">
                <button type="button" onclick="window.location.href='/login?role=admin'" class="w-full bg-[#e0e0e0] hover:bg-[#d5d5d5] transition-colors text-center py-3 font-semibold text-slate-900">
                    Admin
                </button>
                <button type="button" onclick="window.location.href='/login?role=dosen'" class="w-full bg-[#e0e0e0] hover:bg-[#d5d5d5] transition-colors text-center py-3 font-semibold text-slate-900">
                    Dosen
                </button>
                <button type="button" onclick="window.location.href='/login?role=mahasiswa'" class="w-full bg-[#e0e0e0] hover:bg-[#d5d5d5] transition-colors text-center py-3 font-semibold text-slate-900">
                    Mahasiswa
                </button>
            </div>
        </section>
    </main>
</body>
</html>
