@extends('layouts.dokter')

@section('title', 'Janji Temu')
@section('subtitle', 'Manajemen Janji Temu Pasien')

@section('content')

@if(session('success'))
<div id="toast-success" class="fixed top-8 right-8 z-[9999]">
    <div class="bg-white shadow-xl border border-green-100 rounded-[24px] p-5 flex items-center gap-4 min-w-[340px]">
        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
            <i data-lucide="check-circle-2" class="w-6 h-6 text-green-600"></i>
        </div>
        <div>
            <h2 class="font-bold text-slate-800">Berhasil</h2>
            <p class="text-sm text-slate-500">{{ session('success') }}</p>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div id="toast-error" class="fixed top-8 right-8 z-[9999]">
    <div class="bg-white shadow-xl border border-red-100 rounded-[24px] p-5 flex items-center gap-4 min-w-[340px]">
        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
            <i data-lucide="circle-x" class="w-6 h-6 text-red-500"></i>
        </div>
        <div>
            <h2 class="font-bold text-slate-800">Gagal</h2>
            <p class="text-sm text-slate-500">{{ session('error') }}</p>
        </div>
    </div>
</div>
@endif

<script>
setTimeout(()=>{
    const success=document.getElementById('toast-success');
    if(success){ success.style.opacity="0"; setTimeout(()=>success.remove(),500); }
    const error=document.getElementById('toast-error');
    if(error){ error.style.opacity="0"; setTimeout(()=>error.remove(),500); }
},3000);
</script>

<div x-data="{ detailModal:false, selected:null }" class="space-y-6">

    <!-- HEADER -->
    <div class="relative overflow-hidden rounded-[30px] bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-white shadow-lg">
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold leading-tight">Janji Temu</h1>
                <p class="mt-1 text-teal-100 text-sm">
                    {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                </p>
            </div>

            <form method="POST" action="{{ route('dokter.next') }}">
                @csrf
                <button class="px-5 py-3 rounded-2xl bg-white text-teal-600 font-semibold text-sm hover:bg-teal-50 transition inline-flex items-center gap-2">
                    <i data-lucide="chevrons-right" class="w-4 h-4"></i>
                    Panggil Pasien Berikutnya
                </button>
            </form>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white/10"></div>
    </div>

    @php
        $total = $appointments->count();
        $pending = $appointments->where('status_janji', 'pending')->count();
        $called = $appointments->where('status_janji', 'called')->count();
        $consultation = $appointments->where('status_janji', 'in_consultation')->count();
        $completed = $appointments->where('status_janji', 'completed')->count();
        $cancelled = $appointments->where('status_janji', 'cancelled')->count();
    @endphp

    <!-- STATS -->
    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-4">

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Total</p>
            <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $total }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Menunggu</p>
            <h2 class="text-2xl font-bold mt-1 text-yellow-600">{{ $pending }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Dipanggil</p>
            <h2 class="text-2xl font-bold mt-1 text-blue-600">{{ $called }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Sedang diperiksa</p>
            <h2 class="text-2xl font-bold mt-1 text-purple-600">{{ $consultation }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Selesai</p>
            <h2 class="text-2xl font-bold mt-1 text-green-600">{{ $completed }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Dibatalkan</p>
            <h2 class="text-2xl font-bold mt-1 text-slate-500">{{ $cancelled }}</h2>
        </div>

    </div>

    <!-- MAIN CARD -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- FILTER -->
        <div class="p-5 border-b border-slate-100">
            <form method="GET" class="flex flex-col lg:flex-row gap-3 items-end">

                <div class="relative w-full lg:w-64">
                    <label class="block text-xs text-slate-400 mb-1">Cari Pasien</label>
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-4 top-[42px] -translate-y-1/2"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nama pasien..."
                        class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm">
                </div>

                <div class="relative w-full lg:w-48">
                    <label class="block text-xs text-slate-400 mb-1">Status</label>
                    <select
                        name="status"
                        class="w-full pl-4 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm appearance-none">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="called" {{ request('status') == 'called' ? 'selected' : '' }}>Dipanggil</option>
                        <option value="in_consultation" {{ request('status') == 'in_consultation' ? 'selected' : '' }}>Sedang diperiksa</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <div class="relative w-full lg:w-56">
                    <label class="block text-xs text-slate-400 mb-1">Tanggal</label>
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400 absolute left-4 top-[42px] -translate-y-1/2"></i>
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ $tanggal }}"
                        class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm">
                </div>

                <button
                    type="submit"
                    class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm transition whitespace-nowrap">
                    Filter
                </button>

                <a href="{{ route('dokter.appointment') }}"
                   class="px-4 py-3 rounded-2xl border border-slate-200 text-sm text-slate-500 hover:bg-slate-50 transition whitespace-nowrap">
                    Hari Ini
                </a>

            </form>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">No. Antrian</th>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Pasien</th>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Jam Konsultasi</th>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Keluhan</th>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Status</th>
                        <th class="text-center px-6 py-4 text-xs text-slate-400 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($appointments as $item)
                        @php
                            $badgeClass = match($item->status_janji) {
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'called' => 'bg-blue-100 text-blue-700',
                                'in_consultation' => 'bg-purple-100 text-purple-700',
                                'completed' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-slate-200 text-slate-500',
                                default => 'bg-slate-100 text-slate-600',
                            };
                            $labelStatus = match($item->status_janji) {
                                'pending' => 'Menunggu',
                                'called' => 'Dipanggil',
                                'in_consultation' => 'Sedang diperiksa',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                                default => ucfirst($item->status_janji),
                            };
                            $isLocked = in_array($item->status_janji, ['completed', 'cancelled']);
                        @endphp
                        <tr class="hover:bg-slate-50 transition {{ $isLocked ? 'opacity-60' : '' }}">

                            <!-- NO ANTRIAN -->
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 font-bold flex items-center justify-center">
                                    #{{ $item->nomor_antrian }}
                                </div>
                            </td>

                            <!-- PASIEN -->
                            <td class="px-6 py-4">
                                <button
                                    type="button"
                                    @click="detailModal=true; selected={{ Js::from($item) }}"
                                    class="font-semibold text-slate-800 hover:text-teal-600 transition text-left">
                                    {{ $item->pasien->user->nama ?? $item->pasien->nama ?? '-' }}
                                </button>
                            </td>

                            <!-- JAM -->
                            <td class="px-6 py-4 text-slate-600">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="clock" class="w-4 h-4 text-slate-300"></i>
                                    {{ $item->jam_konsultasi ? \Carbon\Carbon::parse($item->jam_konsultasi)->format('H:i') : '-' }}
                                </div>
                            </td>

                            <!-- KELUHAN -->
                            <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                                {{ $item->keluhan_utama }}
                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-xl text-xs font-semibold {{ $badgeClass }}">
                                    {{ $labelStatus }}
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    @if($item->status_janji == 'pending')
                                        <form action="{{ route('dokter.panggil', $item->id_janji) }}" method="POST">
                                            @csrf
                                            <button class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl text-xs whitespace-nowrap">
                                                Panggil
                                            </button>
                                        </form>

                                    @elseif($item->status_janji == 'called')
                                        <form action="{{ route('dokter.start', $item->id_janji) }}" method="POST">
                                            @csrf
                                            <button class="px-3 py-2 bg-teal-500 hover:bg-teal-600 text-white rounded-xl text-xs whitespace-nowrap">
                                                Periksa
                                            </button>
                                        </form>

                                    @elseif($item->status_janji == 'in_consultation')
                                        <a href="{{ route('dokter.diagnosis', $item->id_janji) }}"
                                           class="px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-xl text-xs whitespace-nowrap inline-block">
                                            Lanjutkan
                                        </a>

                                    @elseif($item->status_janji == 'completed')
                                        <span class="px-3 py-2 text-green-600 text-xs italic whitespace-nowrap">
                                            Selesai diperiksa
                                        </span>

                                    @elseif($item->status_janji == 'cancelled')
                                        <span class="px-3 py-2 text-slate-400 text-xs italic whitespace-nowrap">
                                            Dibatalkan
                                        </span>
                                    @endif

                                    @if(in_array($item->status_janji, ['pending', 'called']))
                                        <form action="{{ route('dokter.cancel', $item->id_janji) }}" method="POST"
                                              onsubmit="return confirm('Batalkan janji temu pasien ini?')">
                                            @csrf
                                            <button class="w-9 h-9 rounded-xl border border-red-200 flex items-center justify-center hover:bg-red-50 transition">
                                                <i data-lucide="x" class="w-4 h-4 text-red-500"></i>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <i data-lucide="calendar-x" class="w-10 h-10 text-slate-200"></i>
                                    <p class="text-slate-400 text-sm">Tidak ada janji temu pada tanggal ini</p>
                                    <p class="text-xs text-slate-300">
                                        {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- MODAL DETAIL -->
    <div
        x-show="detailModal"
        x-transition
        class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4"
        style="display:none;"
    >
        <div @click.away="detailModal=false"
             class="w-full max-w-2xl bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- HEADER -->
            <div class="bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-white flex items-center justify-between">
                <h2 class="text-xl font-bold">Detail Pasien</h2>
                <button @click="detailModal=false" class="text-white/80 hover:text-white text-2xl leading-none">&times;</button>
            </div>

            <!-- BODY -->
            <div class="p-6 space-y-4">

                <h3 class="text-lg font-bold text-slate-800">
                    <span x-text="selected?.pasien?.user?.nama ?? selected?.pasien?.nama"></span>
                </h3>

                <div class="grid grid-cols-2 gap-4 text-sm">

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">No RM</p>
                        <p class="font-semibold" x-text="selected?.pasien?.no_rm"></p>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">Jenis Kelamin</p>
                        <p class="font-semibold" x-text="selected?.pasien?.gender"></p>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">Tanggal Lahir</p>
                        <p class="font-semibold" x-text="selected?.pasien?.birth_date"></p>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">Nomor Telepon</p>
                        <p class="font-semibold" x-text="selected?.pasien?.phone_number"></p>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">No. Antrian</p>
                        <p class="font-semibold" x-text="selected?.nomor_antrian"></p>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">Status</p>
                        <p class="font-semibold" x-text="selected?.status_janji"></p>
                    </div>

                </div>

                <div class="p-4 bg-slate-50 rounded-xl">
                    <p class="text-slate-400 text-sm">Keluhan Utama</p>
                    <p class="font-medium text-slate-700" x-text="selected?.keluhan_utama"></p>
                </div>

                <button @click="detailModal=false"
                        class="w-full mt-2 py-3 bg-slate-900 text-white rounded-xl">
                    Tutup
                </button>

            </div>

        </div>
    </div>

</div>
@endsection