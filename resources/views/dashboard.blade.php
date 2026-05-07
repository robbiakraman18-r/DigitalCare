<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pasien - DigitalCare</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ICON -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- ALPINE -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
class="bg-gradient-to-br from-[#f0fffd] via-[#f8fffe] to-[#ecfffb] min-h-screen font-[Inter] flex overflow-x-hidden"
x-data="{ openProfile:false, logoutModal:false }">

    <!-- BLUR -->
    <div class="fixed top-0 left-0 w-72 h-72 bg-teal-200/40 blur-3xl rounded-full -z-10"></div>
    <div class="fixed bottom-0 right-0 w-80 h-80 bg-cyan-200/40 blur-3xl rounded-full -z-10"></div>

    <!-- SIDEBAR -->
    <aside class="group fixed left-0 top-0 h-screen w-20 hover:w-72 bg-white/90 backdrop-blur-xl border-r border-white shadow-xl transition-all duration-300 z-50 flex flex-col justify-between overflow-hidden">

        <div>

            <!-- LOGO -->
            <div class="flex items-center gap-4 px-5 py-6 border-b border-slate-100">

                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-teal-200">
                    <i data-lucide="heart-pulse" class="w-6 h-6 text-white"></i>
                </div>

                <div class="hidden group-hover:block">

                    <h1 class="text-xl font-bold text-slate-800">
                        Digital<span class="text-teal-500">Care</span>
                    </h1>

                    <p class="text-xs text-slate-400">
                        Smart Healthcare
                    </p>

                </div>

            </div>

            <!-- MENU -->
            <nav class="mt-6 px-3 space-y-2">

                <a href="/dashboard/pasien"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl bg-teal-500 text-white shadow-lg shadow-teal-200">

                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Dashboard
                    </span>

                </a>

                <a href="/janji-temu"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="calendar-days" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Janji Temu
                    </span>

                </a>

                <a href="/riwayat"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="file-heart" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Rekam Medis
                    </span>

                </a>

                <a href="/payment"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">
                <i data-lucide="wallet" class="w-5 h-5"></i>
                <span class="hidden group-hover:block font-medium">
                    Payment
                </span>
            </a>

                    


                <a href="/info-klinik"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="building-2" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Info Klinik
                    </span>

                </a>

            </nav>

        </div>

        <!-- LOGOUT -->
        <div class="p-4">

            <button
            @click="logoutModal = true"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl text-red-500 hover:bg-red-50 transition">

                <i data-lucide="log-out" class="w-5 h-5"></i>

                <span class="hidden group-hover:block font-medium">
                    Logout
                </span>

            </button>

        </div>

    </aside>

    <!-- MAIN -->
    <div class="flex-1 ml-20">

        <!-- TOPBAR -->
        <header class="flex justify-between items-center px-6 lg:px-10 py-6">

            <!-- LEFT -->
            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Halo, Rizki 👋
                </h1>

                <p class="text-slate-500 mt-1">
                    Selamat datang kembali di DigitalCare
                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- NOTIFICATION -->
                <button class="relative w-12 h-12 rounded-2xl bg-white shadow-sm border border-slate-100 flex items-center justify-center hover:bg-slate-50 transition">

                    <i data-lucide="bell" class="w-5 h-5 text-slate-600"></i>

                    <span class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-red-500 text-white text-[10px] flex items-center justify-center font-semibold">
                        2
                    </span>

                </button>

                <!-- PROFILE -->
                <div class="relative">

                    <button
                    @click="openProfile = !openProfile"
                    class="flex items-center gap-3 bg-white px-3 py-2 rounded-2xl shadow-sm border border-slate-100 hover:bg-slate-50 transition">

                        <img
                        src="https://i.pravatar.cc/100"
                        class="w-10 h-10 rounded-xl object-cover">

                        <div class="hidden md:block text-left">

                            <h3 class="text-sm font-semibold text-slate-800">
                                Rizki A
                            </h3>

                            <p class="text-xs text-slate-400">
                                Pasien
                            </p>

                        </div>

                    </button>

                    <!-- DROPDOWN -->
                    <div
                    x-show="openProfile"
                    x-transition
                    @click.away="openProfile = false"
                    class="absolute right-0 mt-4 w-72 bg-white rounded-3xl shadow-2xl border border-slate-100 p-5"
                    style="display:none;">

                        <div class="flex items-center gap-4">

                            <img
                            src="https://i.pravatar.cc/100"
                            class="w-14 h-14 rounded-2xl">

                            <div>

                                <h2 class="font-bold text-slate-800">
                                    Rizki A
                                </h2>

                                <p class="text-sm text-slate-400">
                                    rizki@email.com
                                </p>

                            </div>

                        </div>

                        <div class="mt-5 space-y-3 text-sm border-t pt-4">

                            <div class="flex justify-between">
                                <span class="text-slate-400">NIM</span>
                                <span class="font-medium">12345678</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-400">Status</span>
                                <span class="font-medium text-teal-500">
                                    Pasien
                                </span>
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="mt-5 space-y-3">

                            <a href="/profil"
                            class="flex items-center justify-center gap-2 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-medium transition">

                                <i data-lucide="user-cog" class="w-4 h-4"></i>

                                Edit Profil

                            </a>

                            <button
                            @click="logoutModal = true"
                            class="w-full flex items-center justify-center gap-2 py-3 rounded-2xl border border-red-200 text-red-500 hover:bg-red-50 transition">

                                <i data-lucide="log-out" class="w-4 h-4"></i>

                                Logout

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="px-6 lg:px-10 pb-10">

            <!-- HERO -->
            <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-teal-500 to-cyan-500 p-8 lg:p-10 shadow-2xl shadow-teal-200">

                <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 grid lg:grid-cols-2 gap-10 items-center">

                    <!-- LEFT -->
                    <div>

                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-lg border border-white/20 text-white text-sm mb-6">

                            <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>

                            Sistem kesehatan aktif

                        </div>

                        <h1 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                            Kelola kesehatan Anda dengan lebih mudah
                        </h1>

                        <p class="text-white/90 mt-5 leading-relaxed max-w-xl">
                            Booking dokter, lihat rekam medis, resep obat,
                            dan notifikasi klinik dalam satu dashboard modern.
                        </p>

                        <div class="flex flex-wrap gap-4 mt-8">

                            <a href="/buat-janji"
                            class="px-6 py-3 rounded-2xl bg-white text-teal-600 font-semibold shadow-lg hover:scale-105 transition">

                                Buat Janji

                            </a>

                            <a href="/riwayat"
                            class="px-6 py-3 rounded-2xl border border-white/40 text-white font-semibold hover:bg-white/10 transition">

                                Rekam Medis

                            </a>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="relative flex justify-center">

                        <img
                        src="https://cdn-icons-png.flaticon.com/512/3304/3304567.png"
                        class="w-full max-w-[340px] drop-shadow-2xl relative z-10">

                        <!-- FLOAT -->
                        <div class="absolute top-5 left-0 bg-white p-4 rounded-3xl shadow-2xl animate-bounce">

                            <div class="flex items-center gap-3">

                                <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">
                                    <i data-lucide="calendar-check-2" class="text-green-500"></i>
                                </div>

                                <div>

                                    <h3 class="font-bold text-slate-800">
                                        Booking Berhasil
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        Jadwal dikonfirmasi
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

                <!-- REKAM MEDIS -->
                <div class="bg-white rounded-3xl p-6 shadow-lg border border-white">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-slate-400 text-sm">
                                Rekam Medis
                            </p>

                            <h2 class="text-4xl font-bold text-slate-800 mt-2">
                                5
                            </h2>

                        </div>

                        <div class="w-16 h-16 rounded-3xl bg-green-100 flex items-center justify-center">
                            <i data-lucide="file-heart" class="text-green-500 w-8 h-8"></i>
                        </div>

                    </div>

                </div>

                <!-- NOTIFIKASI -->
                <div class="bg-white rounded-3xl p-6 shadow-lg border border-white">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-slate-400 text-sm">
                                Notifikasi
                            </p>

                            <h2 class="text-4xl font-bold text-slate-800 mt-2">
                                3
                            </h2>

                        </div>

                        <div class="w-16 h-16 rounded-3xl bg-yellow-100 flex items-center justify-center">
                            <i data-lucide="bell-ring" class="text-yellow-500 w-8 h-8"></i>
                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

    <!-- LOGOUT MODAL -->
    <div
    x-show="logoutModal"
    x-transition
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50"
    style="display:none;">

        <div class="bg-white rounded-3xl p-8 w-full max-w-sm">

            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto">

                <i data-lucide="log-out" class="text-red-500"></i>

            </div>

            <h2 class="text-2xl font-bold text-center text-slate-800 mt-5">
                Logout?
            </h2>

            <p class="text-center text-slate-500 mt-2">
                Apakah Anda yakin ingin keluar?
            </p>

            <div class="grid grid-cols-2 gap-4 mt-8">

                <button
                @click="logoutModal = false"
                class="py-3 rounded-2xl border border-slate-300 font-medium hover:bg-slate-50 transition">

                    Batal

                </button>

                <a href="/login"
                class="py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white text-center font-medium transition">

                    Logout

                </a>

            </div>

        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>