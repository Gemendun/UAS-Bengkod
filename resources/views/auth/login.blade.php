<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik | Log in</title>

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
    <div class="w-full max-w-[420px] bg-white rounded-[24px] shadow-2xl p-8 md:p-10 transition-all duration-300 hover:shadow-[0_20px_50px_rgba(0,0,0,0.3)]">
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
            <p class="text-sm text-slate-400 mt-1 font-medium">Masuk ke akun Anda</p>
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

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="post">
            @csrf
            
            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <div class="relative rounded-xl shadow-xs">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <span class="fas fa-envelope text-slate-400 text-sm"></span>
                    </div>
                    <input type="email" name="email" id="email" 
                        class="block w-full pl-10 pr-4 py-3 bg-slate-50 border-0 focus:ring-2 focus:ring-[#24408e] focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 text-sm transition-all outline-none" 
                        placeholder="Masukkan email..." required value="{{ old('email') }}">
                </div>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <div class="relative rounded-xl shadow-xs">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <span class="fas fa-lock text-slate-400 text-sm"></span>
                    </div>
                    <input type="password" name="password" id="password" 
                        class="block w-full pl-10 pr-10 py-3 bg-slate-50 border-0 focus:ring-2 focus:ring-[#24408e] focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 text-sm transition-all outline-none" 
                        placeholder="Masukkan password..." required>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" onclick="togglePasswordVisibility('password', 'password-toggle-icon')" class="text-slate-400 hover:text-slate-600 focus:outline-none">
                            <span id="password-toggle-icon" class="fas fa-eye text-sm"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-xs text-slate-500 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-[#24408e] border-slate-300 rounded-sm focus:ring-[#24408e] mr-2">
                    Ingat saya
                </label>
                <a href="#" class="text-xs font-semibold text-[#24408e] hover:underline">Lupa Password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-[#24408e] hover:bg-[#1a306c] text-white py-3 px-4 rounded-xl font-semibold text-sm transition-all duration-200 flex items-center justify-center shadow-lg shadow-[#24408e]/20 active:scale-[0.98]">
                <span class="fas fa-sign-in-alt mr-2"></span> Login
            </button>
        </form>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-slate-400 font-medium">
            Belum punya akun? <a href="{{ route('register') }}" class="text-[#24408e] font-bold hover:underline">Register</a>
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
