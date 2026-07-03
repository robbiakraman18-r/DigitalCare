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
        <h1 class="text-3xl font-bold text-slate-800">@yield('title')</h1>
        <p class="text-slate-400 text-sm mt-1">@yield('subtitle')</p>
    </div>

    <div class="flex items-center gap-4">

        <!-- NOTIFICATION -->
        <div class="relative" x-data="{ openNotif: false }">

            <button @click="openNotif = !openNotif"
                class="relative w-12 h-12 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center hover:scale-105 transition">
                <i data-lucide="bell" class="w-5 h-5 text-slate-700"></i>
                @if($notifTotalUnreadPasien > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-semibold">
                    {{ $notifTotalUnreadPasien }}
                </span>
                @endif
            </button>

            <div x-show="openNotif" @click.away="openNotif = false" x-transition
                class="absolute right-0 mt-4 w-[360px] bg-white rounded-[28px] shadow-2xl border border-slate-100 overflow-hidden z-50"
                style="display:none;">

                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                    <div>
                        <h2 class="font-bold text-slate-800">Notifikasi</h2>
                        <p class="text-xs text-slate-400 mt-1">Update terbaru kamu</p>
                    </div>
                    @if($notifTotalUnreadPasien > 0)
                    <span class="px-3 py-1 rounded-xl bg-red-100 text-red-500 text-xs font-semibold">
                        {{ $notifTotalUnreadPasien }} Baru
                    </span>
                    @endif
                </div>

                @include('components.notifikasi-pasien')

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
                    <p class="text-xs text-slate-400">Pasien</p>
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
                            ID Pasien
                        </span>
                        <span class="font-semibold text-slate-700">@php $pasien = auth()->user()->pasien; @endphp
PAS-{{ $pasien ? str_pad($pasien->id_pasien, 3, '0', STR_PAD_LEFT) : '—' }}</span>
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
                    <a href="{{ route('profile.show') }}"
                        class="w-full flex items-center justify-center gap-2 py-2.5 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold text-sm transition">
                        <i data-lucide="user-circle-2" class="w-4 h-4"></i>
                        Lihat Profil
                    </a>
                </div>

            </div>

        </div>

    </div>

</header>