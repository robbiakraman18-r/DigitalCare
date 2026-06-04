@extends('layouts.dokter')

@section('title', 'Appointments')

@section('subtitle', 'Today’s and tomorrow’s patient appointments')

@section('content')

<div
x-data="{ detailModal:false, selected:null }"
class="space-y-6">

    <!-- CARD -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 px-6 py-5 text-white">

            <h2 class="text-2xl font-bold">
                Appointments
            </h2>

            <p class="text-sm text-teal-100 mt-1">
                Patient appointment data.
            </p>

        </div>

        <!-- CONTENT -->
        <div class="p-6">

            <div class="flex flex-col lg:flex-row justify-between gap-4 mb-6">

    {{-- SEARCH --}}
    <form method="GET" class="w-full lg:w-1/3">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search patient..."
            class="w-full px-4 py-3 rounded-2xl border focus:ring-2 focus:ring-teal-500"
        >
    </form>

    {{-- ACTION BUTTON --}}
    <div class="flex gap-3">

        <a href="?filter=today"
           class="px-4 py-2 rounded-xl bg-teal-500 text-white text-sm">
            Today
        </a>

        <a href="?filter=tomorrow"
           class="px-4 py-2 rounded-xl bg-slate-100 text-slate-600 text-sm">
            Tomorrow
        </a>

        <form method="POST" action="{{ route('dokter.next') }}">
            @csrf
            <button class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">
                ▶ Next Patient
            </button>
        </form>

    </div>

</div>

            <div class="space-y-3">

@foreach($appointments as $item)

<div class="flex items-center justify-between p-4 border rounded-2xl hover:bg-slate-50 transition">

    <!-- LEFT -->
    <div class="flex items-center gap-4 cursor-pointer"
         @click="detailModal=true; selected={{ Js::from($item) }}">

        <div class="text-2xl font-black text-teal-600">
            #{{ $item->nomor_antrian }}
        </div>

        <div>
            <div class="font-semibold text-slate-800">
                {{ $item->pasien->user->name ?? $item->pasien->nama }}
            </div>

            <div class="text-sm text-slate-500">
                {{ $item->keluhan_utama }}
            </div>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-3">

        @if($item->status_janji == 'pending')
            <span class="px-3 py-1 rounded-xl bg-yellow-100 text-yellow-600 text-xs">
                Waiting
            </span>

        @elseif($item->status_janji == 'called')
            <span class="px-3 py-1 rounded-xl bg-blue-100 text-blue-600 text-xs">
                Called
            </span>

        @elseif($item->status_janji == 'in_consultation')
            <span class="px-3 py-1 rounded-xl bg-purple-100 text-purple-600 text-xs">
                In Consultation
            </span>

        @elseif($item->status_janji == 'completed')
            <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs">
                Done
            </span>

        @else
            <span class="px-3 py-1 rounded-xl bg-red-100 text-red-600 text-xs">
                Cancelled
            </span>
        @endif

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
class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4"
style="display:none;">

    <!-- CARD -->
    <div
    @click.away="detailModal=false"
    class="relative w-full max-w-2xl bg-white rounded-[30px] shadow-2xl overflow-hidden">

        <!-- CLOSE -->
        <button
        @click="detailModal=false"
        class="absolute top-5 right-5 w-10 h-10 rounded-xl bg-white shadow-md hover:bg-slate-100 flex items-center justify-center transition z-20">

            <i data-lucide="x" class="w-5 h-5 text-slate-600"></i>

        </button>

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 p-6 rounded-t-[30px] text-white">

            <h2 class="text-2xl font-bold">
                Appointment Details
            </h2>

            <p class="text-sm text-teal-100 mt-1">
                Complete patient appointment information
            </p>

        </div>

        <!-- BODY -->
        <div class="p-6 space-y-5">

            <!-- PROFILE -->
            <div class="flex items-center gap-4">

                <img
                src="https://i.pravatar.cc/120?img=15"
                class="w-16 h-16 rounded-2xl object-cover border-4 border-teal-100">

                <div>

                    <h3 class="text-xl font-bold text-slate-800">
                        <span x-text="selected?.pasien?.user?.name ?? selected?.pasien?.nama"></span>
                    </h3>

                    <p class="text-sm text-slate-400">
                        General Consultation Patient
                    </p>

                    <div class="mt-2">

                        <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                            <span x-text="selected?.status_janji"></span>
                        </span>

                    </div>

                </div>

            </div>

            <!-- INFO -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="text-xs text-slate-400">
                        Date
                    </p>

                    <h4 class="font-bold text-slate-800 mt-2">
                        <span x-text="selected?.jadwal?.tanggal"></span>
                    </h4>

                </div>

                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="text-xs text-slate-400">
                        Practice Time
                    </p>

                    <h4 class="font-bold text-slate-800 mt-2">
                        <span x-text="selected?.jadwal?.jam_mulai"></span>
                    </h4>

                </div>

                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="text-xs text-slate-400">
                        Examination Type
                    </p>

                    <h4 class="font-bold text-slate-800 mt-2">
                        <span x-text="selected?.jadwal?.ruang ?? 'Consultation'"></span>
                    </h4>

                </div>

                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="text-xs text-slate-400">
                        Complaint
                    </p>

                    <h4 class="font-bold text-slate-800 mt-2">
                        <span x-text="selected?.keluhan_utama"></span>
                    </h4>

                </div>

            </div>

            <!-- NOTE -->
            <div class="rounded-2xl border border-slate-100 p-5">

                <h3 class="font-bold text-slate-800 mb-3">
                    Patient Notes
                </h3>

                <p class="text-sm leading-7 text-slate-500">
    <span x-text="selected?.keluhan_utama"></span>
</p>

            </div>

            <!-- ACTION -->
            <div class="flex gap-3">

                <a :href="`/dokter/rekam-medis/${selected.id}`"
   class="flex-1 py-3 rounded-2xl bg-teal-500 text-white font-semibold text-center">
    Start Consultation
</a>

                <button
                @click="detailModal=false"
                class="flex-1 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 font-semibold text-slate-700 transition">

                    Close

                </button>

            </div>

        </div>

    </div>

</div>

@endsection