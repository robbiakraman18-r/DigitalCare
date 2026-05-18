<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalCare</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icon -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gradient-to-br from-[#f0fffd] via-[#f7fffe] to-[#ecfffb] font-[Poppins] overflow-x-hidden">

    <!-- Blur Background -->
    <div class="fixed top-0 left-0 w-72 h-72 bg-teal-200/40 blur-3xl rounded-full -z-10"></div>
    <div class="fixed bottom-0 right-0 w-72 h-72 bg-cyan-200/40 blur-3xl rounded-full -z-10"></div>

    <!-- MAIN -->
    <section class="max-w-7xl mx-auto min-h-screen px-6 lg:px-10 py-6">

        <!-- NAVBAR -->
        <nav class="flex items-center justify-between">

            <!-- LOGO -->
            <div class="flex items-center gap-3">

                <div class="w-14 h-14 mx-auto rounded-2xl bg-teal-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-teal-200">
                    🩺
                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Digital<span class="text-teal-500">Care</span>
                    </h1>

                    <p class="text-xs text-slate-500">
                        Better Healthcare, Digitally
                    </p>

                </div>

            </div>

            <!-- MENU -->
            <ul class="hidden lg:flex items-center gap-10 text-sm font-medium">

                <li>
                    <a href="#" class="text-teal-500 relative">

                        Beranda

                        <span class="absolute -bottom-2 left-0 w-full h-[3px] bg-teal-500 rounded-full"></span>

                    </a>
                </li>

                <li>
                    <a href="#" class="hover:text-teal-500 transition">
                        Kampus
                    </a>
                </li>

                <li>
                    <a href="#" class="hover:text-teal-500 transition">
                        Dokter
                    </a>
                </li>

                <li>
                    <a href="#" class="hover:text-teal-500 transition">
                        Hubungi Kami
                    </a>
                </li>

                

            </ul>

            <!-- BUTTON -->
            <div class="flex items-center gap-3">

                <a
                    href="/login"
                    class="px-5 py-2 rounded-xl border border-teal-500 text-teal-500 text-sm font-medium hover:bg-teal-50 transition"
                >
                    Masuk
                </a>

                <a
                    href="/register"
                    class="px-5 py-2 rounded-xl bg-teal-500 text-white text-sm font-medium shadow-lg shadow-teal-200 hover:bg-teal-600 hover:scale-105 transition duration-300"
>
                    Daftar
                </a>
                

            </div>

        </nav>

        <!-- HERO -->
        <div class="grid lg:grid-cols-2 gap-10 items-center mt-14">

            <!-- LEFT -->
            <div>

                <!-- BADGE -->
                <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full border border-teal-100 shadow-sm mb-6 hover:shadow-md transition">

                    <div class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></div>

                    <span class="text-xs font-medium text-teal-500">
                        Platform kesehatan terpercaya
                    </span>

                </div>

                <!-- TITLE -->
                <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight text-slate-900">

                    Kesehatan Anda,

                    <span class="text-teal-500 block relative w-fit">

                        Prioritas kami

                        <span class="absolute left-0 bottom-1 w-full h-3 bg-teal-200 rounded-full -z-10"></span>

                    </span>

                </h1>

                <!-- DESCRIPTION -->
                <p class="text-slate-600 text-base leading-relaxed mt-6 max-w-lg">

                    DigitalCare hadir untuk memberikan kemudahan
                    konsultasi dokter, booking online, rekam medis,
                    dan layanan kesehatan modern dalam satu platform.

                </p>

                <!-- FEATURES -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">

                    <!-- CARD -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-4 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                        <div class="w-11 h-11 rounded-xl bg-teal-100 flex items-center justify-center mb-3">

                            <i data-lucide="shield-check" class="text-teal-500 w-5 h-5"></i>

                        </div>

                        <h3 class="font-semibold text-sm text-slate-800">
                            Aman
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Data pasien aman terenkripsi.
                        </p>

                    </div>

                    <!-- CARD -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-4 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                        <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center mb-3">

                            <i data-lucide="clock-3" class="text-green-500 w-5 h-5"></i>

                        </div>

                        <h3 class="font-semibold text-sm text-slate-800">
                            Cepat
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Booking tanpa antri.
                        </p>

                    </div>

                    <!-- CARD -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-4 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                        <div class="w-11 h-11 rounded-xl bg-yellow-100 flex items-center justify-center mb-3">

                            <i data-lucide="stethoscope" class="text-yellow-500 w-5 h-5"></i>

                        </div>

                        <h3 class="font-semibold text-sm text-slate-800">
                            Profesional
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Dokter terpercaya & ahli.
                        </p>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="flex flex-wrap items-center gap-4 mt-10">

                    <button class="flex items-center gap-2 px-6 py-3 bg-teal-500 text-white rounded-2xl text-sm font-medium shadow-lg shadow-teal-200 hover:bg-teal-600 hover:scale-105 transition-all duration-300">

                        Buat Janji

                        <i data-lucide="arrow-right" class="w-4 h-4"></i>

                    </button>

                    <button class="flex items-center gap-2 px-6 py-3 border border-teal-500 text-teal-500 rounded-2xl text-sm font-medium hover:bg-teal-50 hover:scale-105 transition-all duration-300">

                        <i data-lucide="users" class="w-4 h-4"></i>

                        Lihat Dokter

                    </button>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative flex justify-center">

                <!-- BLUR -->
                <div class="absolute w-80 h-80 bg-teal-200/40 blur-3xl rounded-full"></div>

                <!-- FLOATING CARD -->
                <div class="absolute top-10 left-0 bg-white rounded-2xl shadow-xl p-4 border border-slate-100 z-20 animate-bounce">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">

                            <i data-lucide="calendar-check-2" class="w-5 h-5 text-green-500"></i>

                        </div>

                        <div>

                            <h4 class="text-sm font-semibold text-slate-800">
                                Booking Berhasil
                            </h4>

                            <p class="text-xs text-slate-500">
                                Jadwal dikonfirmasi
                            </p>

                        </div>

                    </div>

                </div>

                <!-- IMAGE -->
                <img
                    src="https://cdn-icons-png.flaticon.com/512/3304/3304567.png"
                    alt="Doctor"
                    class="relative z-10 w-full max-w-[380px] hover:scale-105 transition duration-500 drop-shadow-2xl"
                >

                <!-- BOTTOM CARD -->
                <div class="absolute bottom-10 right-0 bg-white rounded-2xl shadow-xl p-4 border border-slate-100 z-20 hover:scale-105 transition">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center">

                            <i data-lucide="activity" class="w-5 h-5 text-teal-500"></i>

                        </div>

                        <div>

                            <h4 class="text-sm font-semibold text-slate-800">
                                100+ Pasien
                            </h4>

                            <p class="text-xs text-slate-500">
                                Menggunakan DigitalCare
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>