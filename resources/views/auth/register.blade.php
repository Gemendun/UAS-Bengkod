<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik | Register</title>

    <!-- Google Font: Instrument Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    
    <!-- Vite Assets (Tailwind v4) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: radial-gradient(circle at center, #24468d 0%, #112349 100%);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-[480px] bg-white rounded-[24px] shadow-2xl p-8 md:p-10 transition-all duration-300 hover:shadow-[0_20px_50px_rgba(0,0,0,0.3)] my-6">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 rounded-full bg-[#1b3074] flex items-center justify-center border-4 border-white shadow-md">
                <svg width="40" height="40" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="42" stroke="white" stroke-width="6" />
                    <!-- Stylized b -->
                    <path d="M38 28V72H52C61.3888 72 69 64.3888 69 55C69 45.6112 61.3888 38 52 38H38" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                    <!-- Stylized small k inside loop of b -->
                    <path d="M48 48V62M48 55H52L57 48M52 55L57 62" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <!-- Title & Subtitle -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-[#14234f] tracking-tight">Poliklinik</h1>
            <p class="text-sm text-slate-400 mt-1 font-medium">Buat akun baru</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
        <div class="mb-5 p-3 rounded-xl bg-red-50 text-red-600 text-sm border border-red-100">
            <ul class="list-disc pl-5 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Register -->
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                <div class="relative rounded-xl shadow-xs">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <span class="fas fa-user text-slate-400 text-sm"></span>
                    </div>
                    <input type="text" name="nama" id="nama" 
                        class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border-0 focus:ring-2 focus:ring-[#24408e] focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 text-sm transition-all outline-none" 
                        placeholder="Masukkan nama lengkap..." required value="{{ old('nama') }}">
                </div>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                <div class="relative rounded-xl shadow-xs">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <span class="fas fa-envelope text-slate-400 text-sm"></span>
                    </div>
                    <input type="email" name="email" id="email" 
                        class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border-0 focus:ring-2 focus:ring-[#24408e] focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 text-sm transition-all outline-none" 
                        placeholder="Masukkan email..." required value="{{ old('email') }}">
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat</label>
                <div class="relative rounded-xl shadow-xs">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <span class="fas fa-map-marker-alt text-slate-400 text-sm"></span>
                    </div>
                    <input type="text" name="alamat" id="alamat" 
                        class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border-0 focus:ring-2 focus:ring-[#24408e] focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 text-sm transition-all outline-none" 
                        placeholder="Masukkan alamat..." required value="{{ old('alamat') }}">
                </div>
            </div>

            <!-- No. HP & No. KTP (Side by Side) -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="no_hp" class="block text-sm font-semibold text-slate-700 mb-1.5">No. HP</label>
                    <div class="relative rounded-xl shadow-xs">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="fas fa-phone text-slate-400 text-sm"></span>
                        </div>
                        <input type="text" name="no_hp" id="no_hp" 
                            class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border-0 focus:ring-2 focus:ring-[#24408e] focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 text-sm transition-all outline-none" 
                            placeholder="No. HP..." required value="{{ old('no_hp') }}">
                    </div>
                </div>
                <div>
                    <label for="no_ktp" class="block text-sm font-semibold text-slate-700 mb-1.5">No. KTP</label>
                    <div class="relative rounded-xl shadow-xs">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="fas fa-id-card text-slate-400 text-sm"></span>
                        </div>
                        <input type="text" name="no_ktp" id="no_ktp" 
                            class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border-0 focus:ring-2 focus:ring-[#24408e] focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 text-sm transition-all outline-none" 
                            placeholder="No. KTP..." required value="{{ old('no_ktp') }}">
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                <div class="relative rounded-xl shadow-xs">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <span class="fas fa-lock text-slate-400 text-sm"></span>
                    </div>
                    <input type="password" name="password" id="password" 
                        class="block w-full pl-10 pr-10 py-2.5 bg-slate-50 border-0 focus:ring-2 focus:ring-[#24408e] focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 text-sm transition-all outline-none" 
                        placeholder="Password..." required>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" onclick="togglePasswordVisibility('password', 'password-toggle-icon')" class="text-slate-400 hover:text-slate-600 focus:outline-none">
                            <span id="password-toggle-icon" class="fas fa-eye text-sm"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password</label>
                <div class="relative rounded-xl shadow-xs">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <span class="fas fa-lock text-slate-400 text-sm"></span>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                        class="block w-full pl-10 pr-10 py-2.5 bg-slate-50 border-0 focus:ring-2 focus:ring-[#24408e] focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 text-sm transition-all outline-none" 
                        placeholder="Ulangi password..." required>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'confirm-password-toggle-icon')" class="text-slate-400 hover:text-slate-600 focus:outline-none">
                            <span id="confirm-password-toggle-icon" class="fas fa-eye text-sm"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-[#24408e] hover:bg-[#1a306c] text-white py-3 px-4 rounded-xl font-semibold text-sm transition-all duration-200 flex items-center justify-center shadow-lg shadow-[#24408e]/20 active:scale-[0.98]">
                <span class="fas fa-user-plus mr-2"></span> Register
            </button>
        </form>

        <!-- Footer -->
        <div class="text-center mt-6 text-sm text-slate-400 font-medium">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-[#24408e] font-bold hover:underline">Login</a>
        </div>
    </div>

    <!-- Password visibility toggle script -->
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>