@extends('layouts.dokter')

@section('title', 'Pemeriksaan')
@section('subtitle', 'Pemeriksaan pasien yang sedang berlangsung')

@section('content')

<div class="space-y-6">

@if($appointment)

<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

    <div class="bg-gradient-to-r from-teal-500 via-cyan-500 to-sky-500 p-6 text-white">
        <h2 class="text-2xl font-bold">Pasien Sedang Diperiksa</h2>
        <p class="text-sm text-white/80 mt-1">
            Lanjutkan proses diagnosis pasien.
        </p>
    </div>

    <div class="p-8">

        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <p class="text-xs text-slate-500 uppercase">Nama Pasien</p>
                <p class="font-semibold text-lg">
                    {{ $appointment->pasien->user->name }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500 uppercase">Nomor Antrian</p>
                <p class="font-semibold text-lg">
                    #{{ $appointment->nomor_antrian }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500 uppercase">Tanggal Janji</p>
                <p class="font-semibold">
                    {{ $appointment->tanggal_janji }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500 uppercase">Status</p>

                <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-sm">
                    Sedang Diperiksa
                </span>
            </div>

        </div>

        <div class="mt-8">

            <a href="{{ route('dokter.diagnosis',$appointment->id_janji) }}"
                class="inline-flex items-center px-6 py-3 rounded-xl bg-teal-500 text-white font-medium hover:bg-teal-600 transition">

                Lanjutkan Diagnosis →
            </a>

        </div>

    </div>

</div>

@else

<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

    <div class="bg-gradient-to-r from-teal-500 via-cyan-500 to-sky-500 p-6 text-white">
        <h2 class="text-2xl font-bold">Pemeriksaan Pasien</h2>
        <p class="text-sm text-white/80 mt-1">
            Belum ada pasien yang dipilih.
        </p>
    </div>

    <div class="py-20 text-center px-8">

        <div class="mx-auto w-20 h-20 rounded-full bg-teal-50 flex items-center justify-center">

            <svg class="w-10 h-10 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-3-3v6m8-3A9 9 0 1112 3a9 9 0 019 9z"/>
            </svg>

        </div>

        <h3 class="mt-6 text-2xl font-bold text-slate-700">
            Belum Ada Pasien Dipilih
        </h3>

        <p class="mt-3 text-slate-500 max-w-lg mx-auto">
            Pilih pasien dari halaman Appointment untuk memulai pemeriksaan dan diagnosis medis.
        </p>

        <a href="{{ route('dokter.appointment') }}"
            class="inline-block mt-8 px-6 py-3 rounded-xl bg-teal-500 text-white font-medium hover:bg-teal-600 transition">

            Buka Janji Temu

        </a>

    </div>

</div>

@endif

</div>

@endsection