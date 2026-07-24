<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DigitalCare</title>

    @vite('resources/css/app.css')

    <style>
        input::-ms-reveal,
        input::-ms-clear {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#f0fffd] via-[#f8fffe] to-[#ecfffb] flex items-center justify-center p-6">

<div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2">

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
                    Layanan Kesehatan yang Lebih Baik secara Digital
                </p>
            </div>

            <div class="mb-6">
                <h3 class="text-2xl font-bold text-slate-800">
                    Register
                </h3>
                <p class="text-sm text-slate-500 mt-1">
                    Buat akun baru untuk memulai
                </p>
            </div>

            @if ($errors->any())
                <div id="errorAlert" class="mb-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-600 text-xs relative transition-all duration-300">
                    <div class="flex items-center justify-between mb-1">
                        <span class="font-bold flex items-center gap-1">
                            ⚠️ Gagal Mendaftar:
                        </span>
                        <button type="button" onclick="document.getElementById('errorAlert').remove()" class="text-red-400 hover:text-red-600 font-bold text-sm focus:outline-none">
                            ✕
                        </button>
                    </div>
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ str_replace(['The nama field', 'The email field', 'The password field', 'has already been taken'], ['Kolom nama', 'Kolom email', 'Kolom password', 'sudah terdaftar'], $error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST">
                @csrf

                <div class="mb-4">
                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Nama Lengkap"
                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-teal-500 outline-none transition"
                        required
                    >
                </div>

                <div class="mb-4 relative flex items-center">
                    <div class="absolute left-4 text-slate-400 font-medium select-none pointer-events-none">
                        @
                    </div>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Alamat Email Aktif"
                        class="w-full pl-10 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-teal-500 outline-none transition"
                        required
                    >
                </div>

                <div class="mb-4 relative flex items-center">
                    <input
                        type="password"
                        name="password"
                        id="passwordField"
                        minlength="8"
                        placeholder="Password (Minimal 8 karakter)"
                        class="w-full pl-4 pr-12 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-teal-500 outline-none transition"
                        required
                    >
                    <button
                        type="button"
                        id="toggleButton"
                        class="absolute right-4 text-slate-400 hover:text-teal-500 transition focus:outline-none"
                    >
                        <svg id="eyeOpenIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg id="eyeCloseIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold shadow-lg shadow-teal-200 transition duration-300"
                >
                    DAFTAR
                </button>

                <div class="flex items-center gap-3 my-6">
                    <div class="h-px bg-slate-200 flex-1"></div>
                    <span class="text-sm text-slate-400">atau</span>
                    <div class="h-px bg-slate-200 flex-1"></div>
                </div>

                <button
                    type="button"
                    onclick="window.location.href='/login'"
                    class="w-full py-3 rounded-2xl border border-teal-500 text-teal-600 font-medium hover:bg-teal-50 transition"
                >
                    Sudah Punya Akun?
                </button>

            </form>

        </div>

    </div>

    <div class="hidden md:block relative overflow-hidden bg-slate-900">

    <img 
        src="/images/clinic_design.png" 
        alt="DigitalCare Clinic" 
        class="absolute inset-0 w-full h-full object-cover opacity-80"
    >

    <div class="absolute inset-0 bg-gradient-to-br from-teal-600/80 via-teal-600/50 to-cyan-700/60 flex flex-col justify-center px-12">

        <div class="backdrop-blur-xl bg-white/10 border border-white/20 p-8 rounded-[32px] shadow-2xl">

            <h1 class="text-4xl font-extrabold text-white leading-tight">
                Join DigitalCare
            </h1>

            <p class="text-white/90 mt-4 text-sm leading-relaxed">
                Nikmati pengalaman layanan kesehatan digital kampus yang modern,
                cepat, dan terintegrasi langsung dalam satu platform praktis.
            </p>

            <div class="mt-6 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 text-white text-[10px] font-semibold tracking-wider uppercase backdrop-blur-md">

                <span class="w-1.5 h-1.5 bg-cyan-300 rounded-full animate-pulse"></span>

                PoliBatam Smart Campus Clinic

            </div>

        </div>

    </div>

</div>

</div>

@vite('resources/js/register.js')

</body>
</html>