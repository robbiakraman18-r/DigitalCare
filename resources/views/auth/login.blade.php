<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DigitalCare</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gradient-to-br from-[#f0fffd] via-[#f8fffe] to-[#ecfffb] flex items-center justify-center p-6">

<div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2">

    <div class="hidden md:block relative overflow-hidden bg-slate-900">
        
        <img 
            src="/images/clinic_design.png" 
            alt="DigitalCare Clinic" 
            class="absolute inset-0 w-full h-full object-cover opacity-80"
        >

        <div class="absolute inset-0 bg-gradient-to-br from-teal-600/80 via-teal-600/50 to-cyan-700/60 flex flex-col justify-center px-10">

            <div class="backdrop-blur-md bg-white/10 border border-white/20 p-6 rounded-3xl shadow-xl">

                <h1 class="text-4xl font-bold text-white leading-tight">
                    Welcome Back
                </h1>

                <p class="text-white/90 mt-4 text-sm leading-relaxed">
                    Akses layanan kesehatan digital dengan mudah,
                    cepat, dan aman bersama DigitalCare.
                </p>

            </div>

        </div>

    </div>

    <div class="flex items-center justify-center p-8 lg:p-10">

        <div class="w-full max-w-sm">

            <div class="text-center mb-7">

                <div class="w-14 h-14 mx-auto rounded-2xl bg-teal-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-teal-200">
                    🩺
                </div>

                <h2 class="mt-4 text-2xl font-bold text-slate-800">
                    DigitalCare
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Better Healthcare, Digitally
                </p>

            </div>

            <div class="mb-6">

                <h3 class="text-2xl font-bold text-slate-800">
                    Login
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Masuk untuk melanjutkan akun anda
                </p>

            </div>

            <form action="/login" method="POST">
                @csrf

                @if (session('success'))
                    <div class="mb-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 text-emerald-700 text-sm shadow-sm animate-fade-in">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-emerald-600 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-2xl bg-red-50 border border-red-100 text-red-600 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="mb-4 relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400 group-focus-within:text-teal-500 transition-colors">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan Email"
                        pattern=".+@gmail\.com"
                        class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-teal-500 outline-none transition"
                        required
                    >
                </div>

                <div class="mb-3 relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400 group-focus-within:text-teal-500 transition-colors">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </div>
                    <input
                    id="password"
                    type="password"
                    name="password"
                    minlength="8"
                    placeholder="Password minimal 8 karakter"
                        class="w-full pl-12 pr-12 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-teal-500 outline-none transition"
                        required
                    >
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-teal-500 transition-colors">
                        <svg id="eye-show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg id="eye-hide" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 17.772 17.772M6.228 6.228 3 3m14.772 14.772 3 3M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                </div>

                <div class="text-right mb-6">
                    <a href="/forgot-password" class="text-sm text-teal-600 hover:underline">
                        Lupa password?
                    </a>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold shadow-lg shadow-teal-200 transition duration-300"
                >
                    LOGIN
                </button>

                <div class="flex items-center gap-3 my-6">
                    <div class="h-px bg-slate-200 flex-1"></div>
                    <span class="text-sm text-slate-400">atau</span>
                    <div class="h-px bg-slate-200 flex-1"></div>
                </div>

                <button
                    type="button"
                    onclick="window.location.href='/register'"
                    class="w-full py-3 rounded-2xl border border-teal-500 text-teal-600 font-medium hover:bg-teal-50 transition"
                >
                    Buat Akun Baru
                </button>

            </form>

        </div>

    </div>

</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeShow = document.getElementById('eye-show');
        const eyeHide = document.getElementById('eye-hide');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeShow.classList.add('hidden');
            eyeHide.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeShow.classList.remove('hidden');
            eyeHide.classList.add('hidden');
        }
    }
</script>

</body>
</html>