@extends('layouts.dokter')

@section('content')

@php
    $latestAppointment = $pasien->appointments->sortByDesc('tanggal_janji')->first();
@endphp

<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Patient Details
            </h1>

            <p class="text-slate-400 mt-1">
                Complete consultation patient information.
            </p>
        </div>

        <a href="{{ route('dokter.pasien') }}"
           class="px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 font-semibold transition">
            Back
        </a>
    </div>

    <!-- PROFILE -->
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-8">

        <div class="flex flex-col lg:flex-row lg:items-center gap-6">

            <img
                src="https://i.pravatar.cc/150?img=12"
                class="w-28 h-28 rounded-3xl object-cover">

            <div class="flex-1">

                <h2 class="text-3xl font-bold text-slate-800">
                    {{ $pasien->user->name }}
                </h2>

                <p class="text-slate-400 mt-1">
                    {{ $pasien->user->email }}
                </p>

                <div class="flex flex-wrap gap-3 mt-5">

                    <span class="px-4 py-2 rounded-xl bg-teal-100 text-teal-600 text-sm font-semibold">
                        Active Patient
                    </span>

                    @if($latestAppointment)
                    <span class="px-4 py-2 rounded-xl bg-cyan-100 text-cyan-600 text-sm font-semibold">
                        Last Visit: {{ $latestAppointment->tanggal_janji }}
                    </span>
                    @endif

                </div>

            </div>

        </div>

    </div>

    <!-- DETAIL GRID -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- BIODATA -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-7">

            <h2 class="text-xl font-bold text-slate-800 mb-6">
                Patient Biodata
            </h2>

            <div class="space-y-5">

                <div class="flex justify-between">
                    <span class="text-slate-400">Full Name</span>
                    <span class="font-semibold text-slate-700">
                        {{ $pasien->user->name }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Age</span>
                    <span class="font-semibold text-slate-700">
                        {{ $pasien->birth_date ? \Carbon\Carbon::parse($pasien->birth_date)->age . ' Years Old' : '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Gender</span>
                    <span class="font-semibold text-slate-700">
                        {{ $pasien->gender == 'L' ? 'Male' : 'Female' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Phone Number</span>
                    <span class="font-semibold text-slate-700">
                        {{ $pasien->phone_number ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Address</span>
                    <span class="font-semibold text-slate-700 text-right">
                        {{ $pasien->address ?? '-' }}
                    </span>
                </div>

            </div>

        </div>

        <!-- CONSULTATION TERAKHIR -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-7">

            <h2 class="text-xl font-bold text-slate-800 mb-6">
                Latest Consultation
            </h2>

            @if($latestAppointment)

            <div class="space-y-5">

                <div class="flex justify-between">
                    <span class="text-slate-400">Date</span>
                    <span class="font-semibold text-slate-700">
                        {{ $latestAppointment->tanggal_janji }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Complaint</span>
                    <span class="font-semibold text-slate-700">
                        {{ $latestAppointment->keluhan_utama }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Status</span>
                    <span class="font-semibold text-green-600">
                        {{ ucfirst($latestAppointment->status_janji) }}
                    </span>
                </div>

                @if($latestAppointment->rekammedis)

                <div class="pt-4 border-t">

                    <p class="text-slate-400 text-sm mb-2">
                        Doctor Notes
                    </p>

                    <p class="text-slate-700 leading-relaxed">
                        {{ $latestAppointment->rekammedis->catatan_dokter }}
                    </p>

                </div>

                @endif

            </div>

            @else
                <p class="text-slate-400">No consultation found</p>
            @endif

        </div>

    </div>

    <!-- RIWAYAT REKAM MEDIS (OPSIONAL TAPI RECOMMENDED) -->
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-7">

        <h2 class="text-xl font-bold text-slate-800 mb-6">
            Medical History
        </h2>

        <div class="space-y-4">

            @forelse($pasien->appointments->sortByDesc('tanggal_janji') as $apt)

                @if($apt->rekammedis)

                <div class="p-4 rounded-2xl border border-slate-100">

                    <div class="flex justify-between">
                        <div>
                            <p class="font-semibold text-slate-800">
                                {{ $apt->rekammedis->diagnosa }}
                            </p>

                            <p class="text-xs text-slate-400">
                                {{ $apt->tanggal_janji }} • {{ $apt->dokter->user->name ?? '-' }}
                            </p>
                        </div>

                        <span class="text-xs px-3 py-1 bg-slate-100 rounded-xl">
                            {{ ucfirst($apt->status_janji) }}
                        </span>
                    </div>

                    <p class="text-sm text-slate-600 mt-2">
                        {{ $apt->rekammedis->keluhan }}
                    </p>

                </div>

                @endif

            @empty
                <p class="text-slate-400">No medical history</p>
            @endforelse

        </div>

    </div>

</div>

@endsection