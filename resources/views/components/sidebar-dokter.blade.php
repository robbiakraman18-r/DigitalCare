<aside class="group fixed left-0 top-0 h-screen w-20 hover:w-72 bg-white/90 backdrop-blur-xl border-r border-white shadow-xl transition-all duration-500 ease-in-out z-50 flex flex-col justify-between overflow-hidden">

    <div>

        <!-- LOGO -->
        <div class="flex items-center gap-4 px-5 py-6 border-b border-slate-100">

            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-teal-200 shrink-0">
                🩺
            </div>

            <div class="opacity-0 group-hover:opacity-100 transition-all duration-500 whitespace-nowrap">

                <h1 class="text-xl font-bold text-slate-800">
                    Digital<span class="text-teal-500">Care</span>
                </h1>

                <p class="text-xs text-slate-400">
                    Better Healthcare, Digitally
                </p>

            </div>

        </div>

        <!-- MENU -->
        <nav class="mt-6 px-3 space-y-2">

            <!-- DASHBOARD -->
            <a href="/dokter-dashboard"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300 hover:scale-[1.02]
            {{ request()->is('dokter-dashboard')
            ? 'bg-teal-500 text-white shadow-lg shadow-teal-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Dashboard
                </span>

            </a>

            <!-- JADWAL -->
            <a href="/jadwal-praktik"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('jadwal-praktik')
            ? 'bg-teal-500 text-white shadow-lg shadow-teal-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="calendar-days" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Jadwal Praktik
                </span>

            </a>

            <!-- APPOINTMENT -->
            <a href="/appointment"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('appointment')
            ? 'bg-teal-500 text-white shadow-lg shadow-teal-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="clipboard-list" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Appointment
                </span>

            </a>


            <!-- PASIEN -->
            <a href="/dokter-pasien"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('dokter-pasien') || request()->is('dokter/detail-pasien')
            ? 'bg-teal-500 text-white shadow-lg shadow-teal-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="users" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Data Pasien
                </span>

            </a>


            <!-- INFO -->
            <a href="/info-klinik-dokter"
            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('info-klinik-dokter')
            ? 'bg-teal-500 text-white shadow-lg shadow-teal-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="building-2" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Info Klinik
                </span>

            </a>

        </nav>

    </div>

    <!-- LOGOUT -->
    <div class="p-4">

        <button
        @click="logoutModal = true"
        class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl text-red-500 hover:bg-red-50 transition-all duration-300">

            <i data-lucide="log-out" class="w-5 h-5 shrink-0"></i>

            <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                Logout
            </span>

        </button>

    </div>

</aside>