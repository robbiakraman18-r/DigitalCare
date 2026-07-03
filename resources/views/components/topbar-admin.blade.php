@php
    $nama    = auth()->user()->nama;
    $email   = auth()->user()->email;
    $userId  = auth()->user()->id;

    $inisial = collect(explode(' ', $nama))
        ->filter()
        ->take(2)
        ->map(fn($w) => strtoupper(substr($w, 0, 1)))
        ->join('');
@endphp

<header class="flex justify-between items-center px-5 lg:px-8 py-6">

    <div>
        <h1 class="text-3xl font-bold text-slate-800">{{ $title }}</h1>
        <p class="text-slate-400 text-sm mt-1">{{ $subtitle }}</p>
    </div>

    <div class="flex items-center gap-4">

        <!-- NOTIFICATION -->
        <div class="relative" x-data="{ openNotif: false }">

            <button @click="openNotif = !openNotif"
                class="relative w-12 h-12 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center hover:scale-105 transition">
                <i data-lucide="bell" class="w-5 h-5 text-slate-700"></i>
                @if($notifTotalUnreadAdmin > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-semibold">
                    {{ $notifTotalUnreadAdmin }}
                </span>
                @endif
            </button>

            <div x-show="openNotif" @click.away="openNotif = false" x-transition
                class="absolute right-0 mt-4 w-[360px] bg-white rounded-[28px] shadow-2xl border border-slate-100 overflow-hidden z-50"
                style="display:none;">

                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                    <div>
                        <h2 class="font-bold text-slate-800">Notifikasi Admin</h2>
                        <p class="text-xs text-slate-400 mt-1">Aktivitas terbaru klinik</p>
                    </div>
                    @if($notifTotalUnreadAdmin > 0)
                    <span class="px-3 py-1 rounded-xl bg-red-100 text-red-500 text-xs font-semibold">
                        {{ $notifTotalUnreadAdmin }} Baru
                    </span>
                    @endif
                </div>

                @if($notifikasiListAdmin->isEmpty())

                <div class="p-6 text-center text-slate-400">
                    Tidak ada notifikasi
                </div>

                @else

                @foreach($notifikasiListAdmin as $notif)

                <a href="{{ route('admin.notifikasi.read', $notif) }}"
                   class="flex gap-4 px-5 py-4 hover:bg-slate-50 transition border-b border-slate-100">

                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0
                        @switch($notif->tipe)
                            @case('appointment') bg-yellow-100 @break
                            @case('dokter') bg-cyan-100 @break
                            @case('pasien') bg-teal-100 @break
                            @case('laporan') bg-green-100 @break
                            @default bg-slate-100
                        @endswitch
                    ">

                        @switch($notif->tipe)

                            @case('appointment')
                                <i data-lucide="clipboard-list" class="w-5 h-5 text-yellow-500"></i>
                                @break

                            @case('dokter')
                                <i data-lucide="stethoscope" class="w-5 h-5 text-cyan-500"></i>
                                @break

                            @case('pasien')
                                <i data-lucide="users" class="w-5 h-5 text-teal-500"></i>
                                @break

                            @case('laporan')
                                <i data-lucide="file-text" class="w-5 h-5 text-green-500"></i>
                                @break

                            @default
                                <i data-lucide="bell" class="w-5 h-5 text-slate-500"></i>

                        @endswitch

                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-sm text-slate-800">{{ $notif->judul }}</h3>
                            <span class="text-[11px] text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-slate-500 mt-1">{{ $notif->pesan }}</p>
                    </div>

                </a>

                @endforeach

                @endif

            </div>

        </div>

        <!-- PROFILE -->
        <div class="relative" x-data="{ openProfile: false }">

            <button @click="openProfile = !openProfile"
                class="flex items-center gap-3 bg-white px-3 py-2 rounded-2xl border border-slate-100 shadow-sm hover:bg-slate-50 transition-all duration-300">

                <div class="w-10 h-10 rounded-xl bg-teal-500 flex items-center justify-center text-white font-bold text-sm shrink-0">
                    {{ $inisial }}
                </div>

                <div class="hidden md:block text-left">
                    <h3 class="text-sm font-semibold text-slate-800">{{ $nama }}</h3>
                    <p class="text-xs text-slate-400">Administrator</p>
                </div>

                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 hidden md:block"></i>

            </button>

            <!-- DROPDOWN -->
            <div x-show="openProfile" x-transition.scale.origin.top.right @click.away="openProfile = false"
                class="absolute right-0 mt-4 w-72 bg-white rounded-[28px] shadow-2xl border border-slate-100 overflow-hidden z-50"
                style="display:none;">

                <!-- HEADER -->
                <div class="p-5 bg-teal-500">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-white font-bold text-xl">
                            {{ $inisial }}
                        </div>
                        <div>
                            <h2 class="font-bold text-white">{{ $nama }}</h2>
                            <p class="text-teal-100 text-xs mt-0.5">{{ $email }}</p>
                        </div>
                    </div>
                </div>

                <!-- INFO -->
                <div class="px-5 py-4 space-y-3 text-sm">

                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 flex items-center gap-2">
                            <i data-lucide="id-card" class="w-4 h-4"></i>
                            ID Admin
                        </span>
                        <span class="font-semibold text-slate-700">ADM-{{ str_pad($userId, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            Role
                        </span>
                        <span class="text-xs bg-teal-100 text-teal-600 px-2 py-0.5 rounded-full font-semibold">Super Admin</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 flex items-center gap-2">
                            <i data-lucide="activity" class="w-4 h-4"></i>
                            Status
                        </span>
                        <span class="text-xs bg-teal-100 text-teal-600 px-2 py-0.5 rounded-full font-semibold">Aktif</span>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="px-5 pb-5">
                    <a href="{{ route('admin.profile') }}"
                        class="w-full flex items-center justify-center gap-2 py-2.5 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold text-sm transition">
                        <i data-lucide="user-circle-2" class="w-4 h-4"></i>
                        Lihat Profil
                    </a>
                </div>

            </div>

        </div>

    </div>

</header>