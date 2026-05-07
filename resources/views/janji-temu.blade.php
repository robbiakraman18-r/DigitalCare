<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janji Temu - DigitalCare</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- LUCIDE -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- ALPINE -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gradient-to-br from-[#f4fbfb] to-[#eef7f7] font-[Inter] min-h-screen flex overflow-x-hidden"
      x-data="{ openProfile:false }">

    <!-- BLUR -->
    <div class="fixed top-0 left-0 w-72 h-72 bg-teal-200/30 blur-3xl rounded-full -z-10"></div>
    <div class="fixed bottom-0 right-0 w-96 h-96 bg-cyan-200/30 blur-3xl rounded-full -z-10"></div>

    <!-- SIDEBAR -->
    <aside class="group fixed left-0 top-0 h-screen w-20 hover:w-72 bg-white/90 backdrop-blur-xl border-r border-white shadow-xl transition-all duration-300 z-50 flex flex-col justify-between">

        <div>

            <!-- LOGO -->
            <div class="flex items-center gap-3 p-5 border-b border-slate-100">

                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-teal-200">
                    <i data-lucide="heart-pulse" class="w-6 h-6 text-white"></i>
                </div>

                <div class="hidden group-hover:block">
                    <h1 class="font-bold text-slate-800 text-lg">
                        Digital<span class="text-teal-500">Care</span>
                    </h1>

                    <p class="text-xs text-slate-400">
                        Better Healthcare
                    </p>
                </div>

            </div>

            <!-- MENU -->
            <nav class="mt-6 px-3 space-y-2">

                <!-- DASHBOARD -->
                <a href="/dashboard/pasien"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Dashboard
                    </span>

                </a>

                <!-- APPOINTMENT -->
                <a href="/janji-temu"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg shadow-teal-200 transition">

                    <i data-lucide="calendar-check-2" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Janji Temu
                    </span>

                </a>

                <!-- MEDICAL -->
                <a href="/riwayat"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="file-heart" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Riwayat Medis
                    </span>

                </a>

                <!-- PAYMENT -->
                <a href="/payment"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="wallet" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Payment
                    </span>

                </a>

                <!-- INFO -->
                <a href="/info-klinik"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="hospital" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Info Klinik
                    </span>

                </a>

            </nav>

        </div>

        <!-- LOGOUT -->
        <div class="p-3">

            <a href="/"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-red-50 text-red-500 transition">

                <i data-lucide="log-out" class="w-5 h-5"></i>

                <span class="hidden group-hover:block font-medium">
                    Logout
                </span>

            </a>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 ml-20 p-6 lg:p-8">

        <!-- TOPBAR -->
        <div class="flex justify-between items-center mb-8">

            <!-- TITLE -->
            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Janji Temu
                </h1>

                <p class="text-slate-500 mt-1">
                    Buat jadwal konsultasi dengan dokter
                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- NOTIF -->
                <button class="relative w-12 h-12 rounded-2xl bg-white shadow-md border border-slate-100 flex items-center justify-center hover:scale-105 transition">

                    <i data-lucide="bell" class="w-5 h-5 text-slate-600"></i>

                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500"></span>

                </button>

                <!-- PROFILE -->
                <div class="relative">

                    <button @click="openProfile = !openProfile"
                    class="flex items-center gap-3 bg-white rounded-2xl pl-3 pr-4 py-2 shadow-md border border-slate-100 hover:shadow-lg transition">

                        <img src="https://i.pravatar.cc/100"
                        class="w-10 h-10 rounded-xl object-cover">

                        <div class="hidden md:block text-left">

                            <h3 class="font-semibold text-slate-700 text-sm">
                                Rizki A
                            </h3>

                            <p class="text-xs text-slate-400">
                                Pasien
                            </p>

                        </div>

                    </button>

                    <!-- DROPDOWN -->
                    <div x-show="openProfile"
                    x-transition
                    @click.away="openProfile = false"
                    class="absolute right-0 mt-3 w-72 bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden"
                    style="display:none;">

                        <!-- HEADER -->
                        <div class="p-5 bg-gradient-to-r from-teal-500 to-cyan-500 text-white">

                            <div class="flex items-center gap-3">

                                <img src="https://i.pravatar.cc/100"
                                class="w-14 h-14 rounded-2xl border-2 border-white">

                                <div>
                                    <h2 class="font-bold">
                                        Rizki A
                                    </h2>

                                    <p class="text-sm text-white/80">
                                        rizki@gmail.com
                                    </p>
                                </div>

                            </div>

                        </div>

                        <!-- MENU -->
                        <div class="p-3">

                            <a href="/profil"
                            class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-teal-50 transition text-slate-700">

                                <i data-lucide="user-pen" class="w-5 h-5 text-teal-500"></i>

                                <span class="font-medium">
                                    Edit Profil
                                </span>

                            </a>

                            <a href="/logout"
                            class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-red-50 transition text-red-500">

                                <i data-lucide="log-out" class="w-5 h-5"></i>

                                <span class="font-medium">
                                    Logout
                                </span>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- GRID -->
        <div class="grid lg:grid-cols-3 gap-6">

            <!-- LEFT -->
            <div class="lg:col-span-2 bg-white rounded-[30px] p-6 shadow-xl border border-white">

                <!-- TITLE -->
                <div class="flex items-center gap-3 mb-8">

                    <div class="w-12 h-12 rounded-2xl bg-teal-100 flex items-center justify-center">
                        <i data-lucide="calendar-plus" class="w-6 h-6 text-teal-500"></i>
                    </div>

                    <div>
                        <h2 class="font-bold text-slate-800 text-xl">
                            Make Appointment
                        </h2>

                        <p class="text-sm text-slate-500">
                            Isi detail untuk booking appointment
                        </p>
                    </div>

                </div>

                <!-- FORM -->
                <form class="space-y-6">

                    <!-- PERSONAL -->
                    <div>

                        <div class="flex items-center gap-2 mb-4">

                            <div class="w-7 h-7 rounded-full bg-teal-500 text-white text-sm flex items-center justify-center font-semibold">
                                1
                            </div>

                            <h3 class="font-semibold text-slate-800">
                                Personal Information
                            </h3>

                        </div>

                        <div class="grid md:grid-cols-2 gap-4">

                            <input type="text"
                            placeholder="Nama Lengkap"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none">

                            <input type="text"
                            placeholder="No. ID"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none">

                            <input type="date"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none">

                            <select class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none">

                                <option>Jenis Kelamin</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>

                            </select>

                            <input type="email"
                            placeholder="Email"
                            class="md:col-span-2 w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none">

                        </div>

                    </div>

                    <!-- DETAIL -->
                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- APPOINTMENT -->
                        <div>

                            <div class="flex items-center gap-2 mb-4">

                                <div class="w-7 h-7 rounded-full bg-teal-500 text-white text-sm flex items-center justify-center font-semibold">
                                    2
                                </div>

                                <h3 class="font-semibold text-slate-800">
                                    Appointment Details
                                </h3>

                            </div>

                            <div class="space-y-4">

                                <input type="date"
                                class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none">

                                <select class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none">

                                    <option>Pilih Dokter</option>
                                    <option>dr. Andi</option>
                                    <option>dr. Sarah</option>

                                </select>

                            </div>

                        </div>

                        <!-- VISIT -->
                        <div>

                            <div class="flex items-center gap-2 mb-4">

                                <div class="w-7 h-7 rounded-full bg-teal-500 text-white text-sm flex items-center justify-center font-semibold">
                                    3
                                </div>

                                <h3 class="font-semibold text-slate-800">
                                    Visit Details
                                </h3>

                            </div>

                            <textarea
                            rows="5"
                            placeholder="Alasan Kunjungan"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none resize-none"></textarea>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button
                    type="submit"
                    class="w-full py-4 rounded-2xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-semibold shadow-lg shadow-teal-200 hover:scale-[1.01] transition">

                        Book Appointment

                    </button>

                </form>

            </div>

            <!-- RIGHT -->
            <div class="space-y-6">

                <!-- STATUS -->
                <div class="bg-gradient-to-br from-teal-500 to-cyan-500 rounded-[30px] p-6 text-white shadow-xl">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">
                            <i data-lucide="badge-check" class="w-6 h-6"></i>
                        </div>

                        <div>

                            <h3 class="font-bold text-lg">
                                Appointment Status
                            </h3>

                            <p class="text-sm text-white/80">
                                You have an appointment today
                            </p>

                        </div>

                    </div>

                    <!-- CARD -->
                    <div class="bg-white text-slate-700 rounded-3xl p-5 space-y-3">

                        <h4 class="font-bold">
                            Booking Confirmation
                        </h4>

                        <div class="space-y-2 text-sm">

                            <p><span class="font-semibold">Nama :</span> Rizki A</p>

                            <p><span class="font-semibold">Email :</span> rizki@gmail.com</p>

                            <p><span class="font-semibold">Tanggal :</span> 26 Mei 2026</p>

                            <p><span class="font-semibold">Dokter :</span> dr. Andi</p>

                        </div>

                    </div>

                </div>

                <!-- QUEUE -->
                <div class="bg-white rounded-[30px] p-6 shadow-xl">

                    <h3 class="font-bold text-slate-800 mb-6">
                        Nomor Antrian
                    </h3>

                    <div class="bg-gradient-to-br from-teal-100 to-cyan-100 rounded-3xl p-10 text-center">

                        <p class="text-slate-500 text-sm mb-3">
                            Nomor Antrian
                        </p>

                        <h1 class="text-5xl font-extrabold text-teal-600 tracking-wider">
                            D01-001
                        </h1>

                    </div>

                    <p class="text-center text-slate-500 mt-5 font-medium">
                        Waiting to be called
                    </p>

                </div>

            </div>

        </div>

    </main>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>