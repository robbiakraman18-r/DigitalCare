@extends('layouts.pasien')

@section('title', 'Nomor Antrian')
@section('subtitle', 'Konfirmasi janji temu kamu')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-[32px] shadow-xl border border-slate-100 overflow-hidden">

        <div class="px-8 py-6 border-b border-slate-100">
            <h1 class="text-3xl font-bold text-slate-800">Booking Number</h1>
            <p class="text-slate-400 mt-2">Your current queue number</p>
        </div>

        <div class="p-8">

            {{-- STATUS --}}
            <div class="bg-teal-50 rounded-3xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Appointment Status</p>
                        <h2 class="text-2xl font-bold text-teal-600 mt-2">Booking Confirmed ✅</h2>
                    </div>
                    <div class="w-16 h-16 rounded-3xl bg-white flex items-center justify-center shadow">
                        <i data-lucide="badge-check" class="text-teal-500 w-8 h-8"></i>
                    </div>
                </div>
            </div>

            {{-- NOMOR ANTRIAN --}}
            <div class="mt-8 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-[32px] p-10 text-center text-white shadow-xl">
                <p class="text-lg opacity-80">Queue Number</p>
                <h1 class="text-7xl font-extrabold mt-4">{{ $appointment->nomor_antrian }}</h1>
                <p class="mt-5 text-white/80">Waiting to be called</p>
            </div>

            {{-- DETAIL --}}
            <div class="grid md:grid-cols-3 gap-5 mt-8">

                <div class="bg-slate-50 rounded-3xl p-5">
                    <p class="text-sm text-slate-400">Doctor</p>
                    <h3 class="font-bold text-slate-700 mt-2">
                        {{ $appointment->dokter->user->nama ?? '-' }}
                    </h3>
                </div>

                <div class="bg-slate-50 rounded-3xl p-5">
                    <p class="text-sm text-slate-400">Estimasi Jam Konsultasi</p>
                    <h3 class="font-bold text-slate-700 mt-2">
                        @if($appointment->jam_konsultasi)
                            {{ \Carbon\Carbon::parse($appointment->jam_konsultasi)->format('H:i') }} WIB
                        @else
                            -
                        @endif
                    </h3>
                </div>

                <div class="bg-slate-50 rounded-3xl p-5">
                    <p class="text-sm text-slate-400">Ruangan</p>
                    <h3 class="font-bold text-slate-700 mt-2">
                        {{ $appointment->jadwaldokter->ruang ?? '-' }}
                    </h3>
                </div>

            </div>

            {{-- INFO ESTIMASI --}}
            <div class="mt-6 bg-amber-50 rounded-2xl p-5 border border-amber-100 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 shrink-0">⏳</div>
                <p class="text-sm text-amber-700">
                    Estimasi jam konsultasi kamu adalah
                    <strong>
                        @if($appointment->jam_konsultasi)
                            {{ \Carbon\Carbon::parse($appointment->jam_konsultasi)->format('H:i') }} WIB
                        @else
                            -
                        @endif
                    </strong>.
                    Harap datang lebih awal dan pantau status antrian secara berkala.
                </p>
            </div>

            {{-- BUTTON --}}
            <div class="mt-8">
                <a href="{{ route('pasien.on-going') }}"
                class="w-full flex items-center justify-center gap-2 py-4 rounded-2xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-semibold shadow-lg shadow-teal-200 hover:scale-[1.01] transition-all duration-300">
                    <i data-lucide="activity" class="w-5 h-5"></i>
                    Pantau Status Antrian
                </a>
            </div>

        </div>
    </div>
</div>

@endsection