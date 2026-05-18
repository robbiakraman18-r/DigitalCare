<div class="relative" x-data="{ openNotif:false }">

    <!-- BELL -->
    <button @click="openNotif = !openNotif"
        class="relative w-12 h-12 rounded-2xl bg-white border shadow-sm flex items-center justify-center hover:scale-105 transition">

        <i data-lucide="bell" class="w-5 h-5"></i>

        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center">
            2
        </span>

    </button>

    <!-- DROPDOWN -->
    <div x-show="openNotif"
         @click.away="openNotif=false"
         x-transition
         class="absolute right-0 mt-4 w-80 bg-white rounded-3xl shadow-xl border overflow-hidden z-50">

        <div class="p-4 border-b">
            <h2 class="font-bold">Notifications</h2>
        </div>

        <a href="/dokter/jadwal" class="flex gap-3 p-4 hover:bg-slate-50">

            <i data-lucide="calendar-clock" class="text-cyan-500"></i>

            <div>
                <p class="font-semibold text-sm">Jadwal praktik hari ini</p>
                <p class="text-xs text-slate-400">08:00 - 15:00</p>
            </div>

        </a>

        <a href="/dokter/pasien" class="flex gap-3 p-4 hover:bg-slate-50">

            <i data-lucide="users" class="text-blue-500"></i>

            <div>
                <p class="font-semibold text-sm">Pasien baru masuk</p>
                <p class="text-xs text-slate-400">3 pasien menunggu</p>
            </div>

        </a>

    </div>

</div>