@php
    $dokter = auth()->user()->dokter;

    $foto = $dokter->foto_profil
        ? asset('storage/' . $dokter->foto_profil)
        : 'https://ui-avatars.com/api/?name=' . urlencode($dokter->nama_dokter);
@endphp

<header class="flex justify-between items-center px-6 lg:px-10 py-6">

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

            <button
            @click="openNotif = !openNotif"
            class="relative w-12 h-12 rounded-2xl bg-white border shadow-sm flex items-center justify-center hover:scale-105 transition">

                <i data-lucide="bell" class="w-5 h-5"></i>

                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center">
                    2
                </span>

            </button>

            <div
            x-show="openNotif"
            @click.away="openNotif=false"
            x-transition
            class="absolute right-0 mt-4 w-80 bg-white rounded-3xl shadow-xl border overflow-hidden z-50"
            style="display:none;">

                <div class="p-4 border-b">
                    <h2 class="font-bold">Notifications</h2>
                </div>

                <a href="{{ route('dokter.jadwal') }}" class="flex gap-3 p-4 hover:bg-slate-50">
                    <i data-lucide="calendar-check" class="text-teal-500"></i>
                    <div>
                        <p class="font-semibold text-sm">Jadwal konsultasi baru</p>
                        <p class="text-xs text-slate-400">Hari ini pukul 10:00</p>
                    </div>
                </a>

                <a href="{{ route('dokter.pasien') }}" class="flex gap-3 p-4 hover:bg-slate-50">
                    <i data-lucide="users" class="text-cyan-500"></i>
                    <div>
                        <p class="font-semibold text-sm">Pasien baru masuk</p>
                        <p class="text-xs text-slate-400">Ruang konsultasi 2</p>
                    </div>
                </a>

            </div>

        </div>

        <!-- PROFILE -->
        <div class="relative" x-data="{ openProfile:false }">

            <button
            @click="openProfile = !openProfile"
            class="flex items-center gap-3 bg-white px-3 py-2 rounded-2xl shadow-sm border border-slate-100 hover:bg-slate-50 transition-all duration-300">

                <img
                src="{{ $foto }}"
                class="w-10 h-10 rounded-xl object-cover">

                <div class="hidden md:block text-left">

                    <h3 class="text-sm font-semibold text-slate-800">
                        {{ $dokter->nama_dokter }}
                    </h3>

                    <p class="text-xs text-slate-400">
                        {{ auth()->user()->email }}
                    </p>

                </div>

            </button>

            <!-- DROPDOWN -->
            <div
            x-show="openProfile"
            x-transition.scale.origin.top.right
            @click.away="openProfile = false"
            class="absolute right-0 mt-4 w-72 bg-white rounded-3xl shadow-2xl border border-slate-100 p-5 z-50"
            style="display:none;">

                <div class="flex items-center gap-4">

                    <img
                    src="{{ $foto }}"
                    class="w-14 h-14 rounded-2xl object-cover">

                    <div>

                        <h2 class="font-bold text-slate-800">
                            {{ $dokter->nama_dokter }}
                        </h2>

                        <p class="text-sm text-slate-400">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                </div>

                <!-- INFO -->
                <div class="mt-5 space-y-3 text-sm border-t pt-4">

                    <div class="flex justify-between">
                        <span class="text-slate-400">ID Dokter</span>
                        <span class="font-medium">
                            DOC-{{ str_pad($dokter->id_dokter,3,'0',STR_PAD_LEFT) }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Status</span>
                        <span class="font-medium text-teal-500">
                            {{ ucfirst($dokter->status_ketersediaan) }}
                        </span>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-5">

                    <a href="{{ route('dokter.profile') }}"
                    class="flex items-center justify-center gap-2 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-medium transition-all duration-300">

                        <i data-lucide="user" class="w-4 h-4"></i>
                        Lihat Profil

                    </a>

                </div>

            </div>

        </div>

    </div>

</header>