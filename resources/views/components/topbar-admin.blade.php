<!-- resources/views/components/topbar-admin.blade.php -->

<header class="flex justify-between items-center px-5 lg:px-8 py-6">

    <!-- LEFT -->
    <div>

        <h1 class="text-3xl font-bold text-slate-800">
            {{ $title }}
        </h1>

        <p class="text-slate-400 text-sm mt-1">
            {{ $subtitle }}
        </p>

    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        <!-- NOTIFICATION -->
        <div class="relative" x-data="{ openNotif:false }">

            <!-- BUTTON -->
            <button
            @click="openNotif = !openNotif"
            class="relative w-12 h-12 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center hover:scale-105 transition">

                <i data-lucide="bell" class="w-5 h-5 text-slate-700"></i>

                <!-- BADGE -->
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-semibold">
                    4
                </span>

            </button>

            <!-- DROPDOWN -->
            <div
            x-show="openNotif"
            @click.away="openNotif=false"
            x-transition
            class="absolute right-0 mt-4 w-[360px] bg-white rounded-[28px] shadow-2xl border border-slate-100 overflow-hidden z-50"
            style="display:none;">

                <!-- HEADER -->
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">

                    <div>

                        <h2 class="font-bold text-slate-800">
                            Notifikasi Admin
                        </h2>

                        <p class="text-xs text-slate-400 mt-1">
                            Aktivitas terbaru klinik
                        </p>

                    </div>

                    <span class="px-3 py-1 rounded-xl bg-red-100 text-red-500 text-xs font-semibold">
                        4 Baru
                    </span>

                </div>

                <!-- ITEM -->
                <a href="/admin-appointment"
                class="flex gap-4 px-5 py-4 hover:bg-slate-50 transition border-b border-slate-100">

                    <div class="w-11 h-11 rounded-2xl bg-yellow-100 flex items-center justify-center shrink-0">

                        <i data-lucide="clipboard-list" class="w-5 h-5 text-yellow-500"></i>

                    </div>

                    <div class="flex-1">

                        <div class="flex items-center justify-between">

                            <h3 class="font-semibold text-sm text-slate-800">
                                Appointment Baru
                            </h3>

                            <span class="text-[11px] text-slate-400">
                                2m
                            </span>

                        </div>

                        <p class="text-sm text-slate-500 mt-1">
                            3 pasien melakukan booking konsultasi hari ini.
                        </p>

                    </div>

                </a>

                <!-- ITEM -->
                <a href="/admin-dokter"
                class="flex gap-4 px-5 py-4 hover:bg-slate-50 transition border-b border-slate-100">

                    <div class="w-11 h-11 rounded-2xl bg-cyan-100 flex items-center justify-center shrink-0">

                        <i data-lucide="stethoscope" class="w-5 h-5 text-cyan-500"></i>

                    </div>

                    <div class="flex-1">

                        <div class="flex items-center justify-between">

                            <h3 class="font-semibold text-sm text-slate-800">
                                Dokter Online
                            </h3>

                            <span class="text-[11px] text-slate-400">
                                10m
                            </span>

                        </div>

                        <p class="text-sm text-slate-500 mt-1">
                            Dr. Rizki memulai jadwal praktik pagi.
                        </p>

                    </div>

                </a>

                <!-- ITEM -->
                <a href="/admin-pasien"
                class="flex gap-4 px-5 py-4 hover:bg-slate-50 transition border-b border-slate-100">

                    <div class="w-11 h-11 rounded-2xl bg-teal-100 flex items-center justify-center shrink-0">

                        <i data-lucide="users" class="w-5 h-5 text-teal-500"></i>

                    </div>

                    <div class="flex-1">

                        <div class="flex items-center justify-between">

                            <h3 class="font-semibold text-sm text-slate-800">
                                Pasien Baru
                            </h3>

                            <span class="text-[11px] text-slate-400">
                                25m
                            </span>

                        </div>

                        <p class="text-sm text-slate-500 mt-1">
                            Data pasien baru berhasil ditambahkan.
                        </p>

                    </div>

                </a>

                <!-- ITEM -->
                <a href="/admin-laporan"
                class="flex gap-4 px-5 py-4 hover:bg-slate-50 transition">

                    <div class="w-11 h-11 rounded-2xl bg-green-100 flex items-center justify-center shrink-0">

                        <i data-lucide="file-text" class="w-5 h-5 text-green-500"></i>

                    </div>

                    <div class="flex-1">

                        <div class="flex items-center justify-between">

                            <h3 class="font-semibold text-sm text-slate-800">
                                Laporan Klinik
                            </h3>

                            <span class="text-[11px] text-slate-400">
                                1j
                            </span>

                        </div>

                        <p class="text-sm text-slate-500 mt-1">
                            Laporan harian klinik berhasil dibuat.
                        </p>

                    </div>

                </a>

            </div>

        </div>

        <!-- PROFILE -->
        <div class="relative">

            <button
            @click="openProfile = !openProfile"
            class="flex items-center gap-3 bg-white px-3 py-2 rounded-2xl border border-slate-100 shadow-sm hover:bg-slate-50 transition-all duration-300">

                <img
                src="https://i.pravatar.cc/100?img=68"
                class="w-10 h-10 rounded-xl object-cover">

                <div class="hidden md:block text-left">

                    <h3 class="text-sm font-semibold text-slate-800">
                        Admin Klinik
                    </h3>

                    <p class="text-xs text-slate-400">
                        Administrator
                    </p>

                </div>

            </button>

            <!-- DROPDOWN -->
            <div
            x-show="openProfile"
            x-transition.scale.origin.top.right
            @click.away="openProfile = false"
            class="absolute right-0 mt-4 w-72 bg-white rounded-[28px] shadow-2xl border border-slate-100 p-5 z-50"
            style="display:none;">

                <!-- PROFILE -->
                <div class="flex items-center gap-4">

                    <img
                    src="https://i.pravatar.cc/100?img=68"
                    class="w-14 h-14 rounded-2xl object-cover">

                    <div>

                        <h2 class="font-bold text-slate-800">
                            Admin Klinik
                        </h2>

                        <p class="text-sm text-slate-400">
                            admin@doctorcare.com
                        </p>

                    </div>

                </div>

                <!-- INFO -->
                <div class="mt-5 pt-4 border-t border-slate-100 space-y-3 text-sm">

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            ID Admin
                        </span>

                        <span class="font-medium text-slate-700">
                            ADM-001
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            Role
                        </span>

                        <span class="font-medium text-teal-500">
                            Super Admin
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            Status
                        </span>

                        <span class="font-medium text-green-500">
                            Aktif
                        </span>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-5">

                    <a href="/profil-admin"
                    class="w-full flex items-center justify-center gap-2 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold transition">

                        <i data-lucide="user-circle-2" class="w-5 h-5"></i>

                        Lihat Profil

                    </a>

                </div>

            </div>

        </div>

    </div>

</header>