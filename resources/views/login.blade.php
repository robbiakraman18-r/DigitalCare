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

    <!-- LEFT IMAGE -->
    <div class="hidden md:block relative">

        <img
            src="/images/medical.jpg"
            class="w-full h-full object-cover"
        >

        <div class="absolute inset-0 bg-gradient-to-br from-teal-500/80 to-cyan-500/60 flex flex-col justify-center px-10">

            <div class="backdrop-blur-md bg-white/10 border border-white/20 p-6 rounded-3xl">

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

    <!-- RIGHT FORM -->
    <div class="flex items-center justify-center p-8 lg:p-10">

        <div class="w-full max-w-sm">

            <!-- LOGO -->
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

            <!-- TITLE -->
            <div class="mb-6">

                <h3 class="text-2xl font-bold text-slate-800">
                    Login
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Masuk untuk melanjutkan akun anda
                </p>

            </div>

            <!-- FORM -->
            <form>

                <!-- EMAIL -->
                <div class="mb-4">

                    <input
                        type="email"
                        placeholder="Email"
                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-teal-500 outline-none transition"
                    >

                </div>

                <!-- PASSWORD -->
                <div class="mb-3">

                    <input
                        type="password"
                        placeholder="Password"
                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-teal-500 outline-none transition"
                    >

                </div>

                <!-- FORGOT -->
                <div class="text-right mb-6">

                    <a href="/forgot-password" class="text-sm text-teal-600 hover:underline">
                        Lupa password?
                    </a>

                </div>

                <!-- BUTTON -->
                <button
                    type="button"
                    onclick="window.location.href='/dashboard/pasien'"
                    class="w-full py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold shadow-lg shadow-teal-200 transition duration-300"
                >
                    LOGIN
                </button>

                <!-- DIVIDER -->
                <div class="flex items-center gap-3 my-6">

                    <div class="h-px bg-slate-200 flex-1"></div>

                    <span class="text-sm text-slate-400">
                        atau
                    </span>

                    <div class="h-px bg-slate-200 flex-1"></div>

                </div>

                <!-- REGISTER -->
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

</body>
</html>