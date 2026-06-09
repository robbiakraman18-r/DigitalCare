@extends('layouts.dokter')

@section('title', 'Appointments')

@section('subtitle', 'Today’s and tomorrow’s patient appointments')

@section('content')

<div x-data="{ detailModal:false, selected:null }" class="space-y-6">

    <!-- CARD -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 px-6 py-5 text-white">
            <h2 class="text-2xl font-bold">Appointments</h2>
            <p class="text-sm text-teal-100 mt-1">Patient appointment data.</p>
        </div>

        <!-- CONTENT -->
        <div class="p-6">

            <!-- SEARCH + ACTION -->
<div class="flex flex-col lg:flex-row justify-between gap-4 mb-6">

    <!-- SEARCH -->
    <form method="GET" class="w-full lg:w-1/3">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search patient..."
            class="w-full px-4 py-3 rounded-2xl border focus:ring-2 focus:ring-teal-500 outline-none"
        >
    </form>

    <!-- ACTION -->
    <div class="flex flex-col gap-3">

        <!-- DATE PICKER -->
        <form method="GET">

            <label class="block text-xs text-slate-500 mb-1">
                Select Date
            </label>

            <input
                type="date"
                name="tanggal"
                value="{{ request('tanggal', now()->format('Y-m-d')) }}"
                min="{{ now()->format('Y-m-d') }}"
                onchange="this.form.submit()"
                class="px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm"
            >

        </form>

        <!-- NEXT BUTTON -->
        <form method="POST" action="{{ route('dokter.next') }}">
            @csrf
            <button class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
                ▶ Next Patient
            </button>
        </form>

    </div>

</div>

            <!-- LIST -->
            <div class="space-y-4">

                @foreach($appointments as $item)

                <div class="group bg-white border rounded-2xl p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:shadow-md transition">

                    <!-- LEFT -->
                    <div class="flex items-center gap-4 cursor-pointer"
                        @click="if('{{ $item->status_janji }}' !== 'completed') { detailModal=true; selected={{ Js::from($item) }} }">

                        <!-- NUMBER -->
                        <div class="relative group">

                            <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-teal-50 text-teal-600 font-bold text-lg cursor-pointer">
                                #{{ $item->nomor_antrian }}
                            </div>

                            @if($item->status_janji != 'completed')
                            <div class="absolute left-14 top-1/2 -translate-y-1/2 w-64 bg-white border shadow-lg rounded-xl p-3 opacity-0 group-hover:opacity-100 transition z-50">

                                <p class="text-xs text-slate-400">Patient Info</p>

                                <p class="font-semibold text-slate-800">
                                    {{ $item->pasien->user->name ?? $item->pasien->nama }}
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $item->keluhan_utama }}
                                </p>

                                <p class="text-xs text-slate-400 mt-2">
                                    Status: {{ ucfirst($item->status_janji) }}
                                </p>

                            </div>
                            @endif

                        </div>

                        <!-- INFO -->
<div class="space-y-2">

    <!-- NAME -->
    <div class="font-semibold text-slate-800 text-base">
        {{ $item->pasien->user->name ?? $item->pasien->nama }}
    </div>

    <!-- COMPLAINT -->
    <div class="text-sm text-slate-500">
        {{ $item->keluhan_utama }}
    </div>

    <!-- META INFO -->
    <div class="flex flex-wrap gap-2 text-xs mt-2">
        <!-- JAM -->
        <span class="px-2 py-1 rounded-lg bg-slate-100 text-slate-600">

            @if(isset($item->jadwal->jam_mulai))
                {{ \Carbon\Carbon::parse($item->jadwal->jam_mulai)->format('H:i') }}
            @elseif(isset($item->jam_janji))
                {{ \Carbon\Carbon::parse($item->jam_janji)->format('H:i') }}
            @else
                -
            @endif

        </span>

        <!-- STATUS QUICK -->
        <span class="px-2 py-1 rounded-lg
            @if($item->status_janji == 'pending') bg-yellow-50 text-yellow-700
            @elseif($item->status_janji == 'called') bg-blue-50 text-blue-700
            @elseif($item->status_janji == 'in_consultation') bg-purple-50 text-purple-700
            @else bg-green-50 text-green-700
            @endif
        ">
            {{ ucfirst(str_replace('_',' ', $item->status_janji)) }}
        </span>

    </div>

</div>

                    </div>

                    <!-- RIGHT -->
                    <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4">

                        <!-- STATUS -->
                        <div>
                            @if($item->status_janji == 'pending')
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">Waiting</span>

                            @elseif($item->status_janji == 'called')
                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">Called</span>

                            @elseif($item->status_janji == 'in_consultation')
                                <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">In Consultation</span>

                            @elseif($item->status_janji == 'completed')
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Done</span>
                            @endif
                        </div>

                        <!-- ACTION -->
                        <div class="flex gap-2">

                            @if($item->status_janji == 'pending')

                                <form action="{{ route('dokter.panggil', $item->id_janji) }}" method="POST">
                                    @csrf
                                    <button class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl text-xs">
                                        Panggil
                                    </button>
                                </form>

                            @elseif($item->status_janji == 'called')

                                <form action="{{ route('dokter.start', $item->id_janji) }}" method="POST">
                                    @csrf
                                    <button class="px-3 py-2 bg-teal-500 hover:bg-teal-600 text-white rounded-xl text-xs">
                                        Periksa
                                    </button>
                                </form>

                            @elseif($item->status_janji == 'in_consultation')

    <a href="{{ route('dokter.diagnosis', $item->id_janji) }}"
        class="px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-xl text-xs inline-block">
        Lanjutkan Pemeriksaan
    </a>

@endif

                        </div>
                    </div>

                </div>

                @endforeach

            </div>

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
            <div class="bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-white">
                <h2 class="text-xl font-bold">Patient Detail</h2>
            </div>

            <!-- BODY -->
            <div class="p-6 space-y-4">

                <!-- NAME -->
                <h3 class="text-lg font-bold text-slate-800">
                    <span x-text="selected?.pasien?.user?.name ?? selected?.pasien?.nama"></span>
                </h3>

                <!-- GRID -->
                <div class="grid grid-cols-2 gap-4 text-sm">

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">No RM</p>
                        <p class="font-semibold" x-text="selected?.pasien?.no_rm"></p>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">Gender</p>
                        <p class="font-semibold" x-text="selected?.pasien?.gender"></p>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">Birth Date</p>
                        <p class="font-semibold" x-text="selected?.pasien?.birth_date"></p>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl">
                        <p class="text-slate-400">Phone</p>
                        <p class="font-semibold" x-text="selected?.pasien?.phone_number"></p>
                    </div>

                </div>

                <!-- COMPLAINT -->
                <div class="p-4 bg-slate-50 rounded-xl">
                    <p class="text-slate-400 text-sm">Complaint</p>
                    <p class="font-medium text-slate-700" x-text="selected?.keluhan_utama"></p>
                </div>

                <!-- CLOSE -->
                <button @click="detailModal=false"
                        class="w-full mt-2 py-3 bg-slate-900 text-white rounded-xl">
                    Close
                </button>

            </div>

        </div>
    </div>

</div>

@endsection