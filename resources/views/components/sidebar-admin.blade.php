<aside class="group fixed left-0 top-0 h-screen w-20 hover:w-72 bg-white/90 backdrop-blur-xl border-r border-white shadow-xl transition-all duration-500 ease-in-out z-50 flex flex-col overflow-hidden">

    <div class="flex-1 overflow-y-auto overflow-x-hidden admin-scroll scrollbar-hide">

        <!-- LOGO -->
        <div class="flex items-center gap-4 px-5 py-6 border-b border-slate-100 sticky top-0 bg-white/90 backdrop-blur-xl z-10">

            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-cyan-200 shrink-0">
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

        <!-- MENU -->
        <nav class="mt-6 px-3 space-y-2 pb-20">

            <!-- MENU UTAMA -->
            <div class="px-4 pt-2 pb-1">
                <p class="text-[11px] uppercase tracking-widest text-slate-400 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                    Menu Utama
                </p>
            </div>

            <!-- DASHBOARD -->
            <a href="/admin/dashboard"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin/dashboard')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Dashboard
                </span>

            </a>

            <!-- USER MANAGEMENT -->
            <a href="/admin/user-management"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin/user-management')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="user-cog" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Manajemen Pengguna
                </span>

            </a>

            <!-- SCHEDULE MANAGEMENT -->
            <a href="/admin/schedule-management"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin/schedule-management')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="calendar-clock" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Manajemen Jadwal
                </span>

            </a>

            <!-- APPOINTMENT -->
            <a href="/admin/appointment"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin/appointment')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="clipboard-list" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Janji Temu
                </span>

            </a>

            <!-- MEDICAL RECORDS -->
            <a href="/admin/medical-records"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin/medical-records')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="file-heart" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Rekam Medis
                </span>
            </a>

            <!-- REPORTS -->
            <a href="/admin/reports"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin/reports')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="chart-column-big" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Laporan
                </span>
            </a>


            <!-- COMPLAINT -->
            <a href="/admin/complaint"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin/complaint')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                @if(request()->is('admin/complaint'))
                @endif

                <i data-lucide="message-square-warning" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Keluhan
                </span>
            </a>

            <!-- MENU TAMBAHAN -->
            <div class="px-4 pt-2 pb-1">
                <p class="text-[11px] uppercase tracking-widest text-slate-400 opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                    Menu Tambahan
                </p>
            </div>

            <!-- SETTINGS -->
            <a href="/admin/settings"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin/settings')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                <i data-lucide="settings-2" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Pengaturan
                </span>
            </a>

        </nav>

    </div>

    <!-- LOGOUT -->
    <div class="p-4 border-t border-slate-100">

        <button
            @click="logoutModal=true"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl text-red-500 hover:bg-red-50 transition-all duration-300">

            <i data-lucide="log-out" class="w-5 h-5 shrink-0"></i>

            <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                Keluar
            </span>

        </button>

    </div>

</aside>