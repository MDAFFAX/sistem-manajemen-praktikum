<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Simprak</title>

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
    <!-- Header -->
    <header class="w-full bg-[#8bb6d9] flex items-center justify-center py-4">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
            Simprak<span class="text-[#E53935]">.</span>
        </h1>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-[350px] flex flex-col items-center space-y-6">
            <!-- Login Title -->
            <h2 class="text-3xl font-bold text-slate-900 uppercase tracking-wide" id="loginTitle">
                LOGIN
            </h2>

            <!-- Login Form -->
            <form method="POST" action="/login" class="w-full space-y-4">
                @csrf

                <!-- Hidden Input Role -->
                <input type="hidden" name="role" id="rolefield">
                
                <!-- Username Input -->
                <div class="w-full">
                    <input 
                        type="text" 
                        name="username" 
                        id="username"
                        placeholder="Username" 
                        class="w-full max-w-[350px] bg-[#e0e0e0] border border-gray-300 rounded-md px-4 py-3 text-slate-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#64A7D8] focus:border-transparent"
                        required
                    >
                </div>

                <!-- Password Input -->
                <div class="w-full">
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        placeholder="Password" 
                        class="w-full max-w-[350px] bg-[#e0e0e0] border border-gray-300 rounded-md px-4 py-3 text-slate-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#64A7D8] focus:border-transparent"
                        required
                    >
                </div>

                <!-- Login Button -->
                <button 
                    type="submit" 
                    class="w-full max-w-[350px] bg-[#64A7D8] hover:bg-[#5596c7] text-black font-semibold uppercase tracking-wide rounded-md py-3 transition-colors duration-200 shadow-sm"
                >
                    LOGIN
                </button>
            </form>
        </div>
    </main>

    <script>
        // Read role parameter from URL
        const urlParams = new URLSearchParams(window.location.search);
        const role = urlParams.get('role');
        const loginTitle = document.getElementById('loginTitle');
        const roleField = document.getElementById('rolefield');

        // Update login title and set role field
        if (role) {
            const roleLower = role.toLowerCase();
            const roleMap = {
                'admin': 'LOGIN ADMIN',
                'dosen': 'LOGIN DOSEN',
                'mahasiswa': 'LOGIN MAHASISWA'
            };
            
            const title = roleMap[roleLower];
            if (title) {
                loginTitle.textContent = title;
            }

            // Set hidden input role (pastikan lowercase)
            roleField.value = roleLower;
            
            // Debug: log untuk memastikan role ter-set
            console.log('Role set to:', roleField.value);
        } else {
            // Jika tidak ada role di URL, set default atau tampilkan error
            console.warn('No role parameter found in URL');
        }
        
        // Pastikan role tetap ter-set saat form di-submit
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!roleField.value) {
                e.preventDefault();
                alert('Silakan pilih role terlebih dahulu dari halaman utama.');
                window.location.href = '/';
                return false;
            }
            console.log('Submitting form with role:', roleField.value);
        });
    </script>
</body>
</html>

