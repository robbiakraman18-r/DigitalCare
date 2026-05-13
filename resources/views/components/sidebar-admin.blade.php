<aside class="group fixed left-0 top-0 h-screen w-20 hover:w-72 bg-white/90 backdrop-blur-xl border-r border-white shadow-xl transition-all duration-500 ease-in-out z-50 flex flex-col overflow-hidden">

    <!-- SCROLL -->
    <div class="flex-1 overflow-y-auto overflow-x-hidden admin-scroll">

        <!-- LOGO -->
        <div class="flex items-center gap-4 px-5 py-6 border-b border-slate-100 sticky top-0 bg-white/90 backdrop-blur-xl z-10">

            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-cyan-200 shrink-0">
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
        <nav class="mt-6 px-3 space-y-2 pb-10">

            <!-- DASHBOARD -->
            <a href="/dashboard-admin"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('dashboard-admin')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                @if(request()->is('admin-dashboard'))

                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-l-full bg-white"></div>

                @endif

                <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Dashboard
                </span>

            </a>

            <a href="/admin-user-management"
class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
{{ request()->is('admin-user-management')
? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
: 'text-slate-600 hover:bg-teal-50' }}">

    @if(request()->is('admin-user-management'))

    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-l-full bg-white"></div>

    @endif

    <i data-lucide="user-cog" class="w-5 h-5 shrink-0"></i>

    <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
        User Management
    </span>

</a>
            
<!-- SCHEDULE MANAGEMENT -->
<a href="/admin-schedule-management"
class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
{{ request()->is('admin-schedule-management')
? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
: 'text-slate-600 hover:bg-teal-50' }}">

    @if(request()->is('admin-schedule-management'))

    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-l-full bg-white"></div>

    @endif

    <i data-lucide="calendar-clock" class="w-5 h-5 shrink-0"></i>

    <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
        Schedule Management
    </span>

</a>
            <!-- APPOINTMENT -->
            <a href="/admin-appointment"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin-appointment')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">

                @if(request()->is('admin-appointment'))

                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-l-full bg-white"></div>

                @endif

                <i data-lucide="clipboard-list" class="w-5 h-5 shrink-0"></i>

                <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
                    Appointment
                </span>

            </a>

            
            <!-- MEDICAL RECORDS -->
            <a href="/admin-medical-records"
            class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('admin-medical-records')
            ? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
            : 'text-slate-600 hover:bg-teal-50' }}">
            
            @if(request()->is('admin-medical-records'))
            
            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-l-full bg-white"></div>
            
            @endif

    <i data-lucide="file-heart" class="w-5 h-5 shrink-0"></i>

    <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
        Medical Records
    </span>

</a>

<!-- REPORTS -->
<a href="/admin-reports"
class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
{{ request()->is('admin-reports')
? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
: 'text-slate-600 hover:bg-teal-50' }}">

    @if(request()->is('admin-reports'))

    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-l-full bg-white"></div>

    @endif

    <i data-lucide="chart-column-big" class="w-5 h-5 shrink-0"></i>

    <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
        Reports
    </span>

</a>




<!-- PAYMENTS -->
<a href="/admin-payments"
class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
{{ request()->is('admin-payments')
? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
: 'text-slate-600 hover:bg-teal-50' }}">

@if(request()->is('admin-payments'))

<div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-l-full bg-white"></div>

@endif

<i data-lucide="wallet" class="w-5 h-5 shrink-0"></i>

<span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
    Payments
</span>

</a>

            <!-- SIDEBAR SETTINGS -->
<a href="/admin-settings"
class="relative flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
{{ request()->is('admin-settings')
? 'bg-teal-500 text-white shadow-lg shadow-cyan-200'
: 'text-slate-600 hover:bg-teal-50' }}">

    @if(request()->is('admin-settings'))

    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-l-full bg-white"></div>

    @endif

    <i data-lucide="settings-2" class="w-5 h-5 shrink-0"></i>

    <span class="font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300">
        Settings
    </span>

</a>

        </nav>

    </div>

    <!-- LOGOUT -->
    <div class="p-4 border-t border-slate-100 bg-white/90 backdrop-blur-xl">

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

<!-- SCROLLBAR -->
<style>

.admin-scroll::-webkit-scrollbar{
    width:6px;
}

.admin-scroll::-webkit-scrollbar-thumb{
    background:#cbd5e1;
    border-radius:999px;
}

.admin-scroll::-webkit-scrollbar-thumb:hover{
    background:#94a3b8;
}

.admin-scroll::-webkit-scrollbar-track{
    background:transparent;
}

</style>