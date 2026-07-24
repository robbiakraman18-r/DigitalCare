@php
    $isDashboard = request()->routeIs('pasien.dashboard');

    $isJanjiTemu =
        request()->routeIs('pasien.buat-janji') ||
        request()->routeIs('pasien.janji-temu') ||
        request()->routeIs('pasien.on-going');

    $isRekamMedis =
        request()->is('pasien/listrekam-medis*') ||
        request()->is('pasien/detail-rekam-medis*') ||
        request()->is('pasien/download-rekam-medis*');

    $isInfoKlinik = request()->is('pasien/info-klinik*');

    $isHelp = request()->routeIs('pasien.help');
@endphp
<aside class="group fixed left-0 top-0 h-screen w-20 hover:w-72 bg-white/90 backdrop-blur-xl border-r border-white shadow-xl transition-all duration-500 ease-in-out z-50 flex flex-col justify-between overflow-hidden">

    <div>
        <div class="flex items-center gap-4 px-5 py-6 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-teal-200 shrink-0">
                🩺
            </div>

            <div class="opacity-0 group-hover:opacity-100 transition-all duration-500 whitespace-nowrap">
                <h1 class="text-xl font-bold text-slate-800">
                    Digital<span class="text-teal-500">Care</span>
                </h1>
                <p class="text-xs text-slate-400 whitespace-nowrap">
                    Layanan Kesehatan Digital
                </p>
            </div>
        </div>

        <nav class="mt-6 px-3 space-y-2">
            <!-- MENU UTAMA -->
            <div class="px-4 pt-2 pb-1">
                <p class="text-[11px] uppercase tracking-widest text-slate-400 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                    Menu Utama
                </p>
            </div>

            <a href="{{ route('pasien.dashboard') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300 hover:scale-[1.02]
            {{ $isDashboard
            ? 'bg-teal-500 text-white shadow-lg shadow-teal-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Dashboard
                </span>
            </a>

            <a href="{{ route('pasien.buat-janji') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ $isJanjiTemu
            ? 'bg-teal-500 text-white shadow-lg shadow-teal-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="calendar-days" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Janji Temu
                </span>
            </a>

            <a href="{{ url('/pasien/listrekam-medis') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ $isRekamMedis
            ? 'bg-teal-500 text-white shadow-lg shadow-teal-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="file-heart" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Rekam Medis
                </span>
            </a>

            <!-- MENU UTAMA -->
            <div class="px-4 pt-2 pb-1">
                <p class="text-[11px] uppercase tracking-widest text-slate-400 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                    Menu Tambahan
                </p>
            </div>

            <!-- HELP -->
            <a href="{{ route('pasien.complaint') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ $isHelp
            ? 'bg-teal-500 text-white shadow-lg shadow-teal-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="help-circle" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Bantuan
                </span>
            </a>

        </nav>
    </div>

    <div class="p-4">
        <button
        @click="logoutModal = true"
        class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl text-red-500 hover:bg-red-50 transition-all duration-300">

            <i data-lucide="log-out" class="w-5 h-5 shrink-0"></i>

            <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                Keluar
            </span>
        </button>
    </div>

</aside>