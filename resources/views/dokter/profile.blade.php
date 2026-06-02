@extends('layouts.dokter')

@section('content')

@php
    $dokter = auth()->user()->dokter;

    $foto = $dokter->foto_profil
        ? asset('storage/' . $dokter->foto_profil)
        : 'https://ui-avatars.com/api/?name=' . urlencode($dokter->user->name);
@endphp

<div class="space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Doctor Profile
        </h1>

        <p class="text-slate-400 mt-1">
            Detail informasi dokter di sistem DigitalCare.
        </p>
    </div>

    <!-- PROFILE CARD -->
    <div class="bg-gradient-to-r from-teal-500 to-cyan-500 rounded-[32px] p-8 text-white shadow-xl">

        <div class="flex flex-col lg:flex-row items-center gap-6">

            <!-- FOTO + UPLOAD INSTAGRAM STYLE -->
            <div class="relative group w-32 h-32">

                <!-- FOTO -->
                <img src="{{ $foto }}"
                     class="w-32 h-32 rounded-3xl object-cover border-4 border-white/30 transition group-hover:scale-105">

                <!-- OVERLAY UPLOAD -->
                <form action="{{ route('dokter.profile.photo') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 bg-black/50 rounded-3xl transition">

                    @csrf

                    <label class="cursor-pointer text-white text-sm font-semibold flex flex-col items-center gap-1">

                        📷 Upload

                        <input type="file"
                               name="foto_profil"
                               class="hidden"
                               onchange="this.form.submit()">

                    </label>

                </form>

            </div>

            <!-- INFO -->
            <div class="text-center lg:text-left">

                <h2 class="text-3xl font-bold">
                    {{ $dokter->user->name }}
                </h2>

                <p class="text-teal-100 mt-2">
                    Doctor at DigitalCare Clinic
                </p>

                <span class="inline-block mt-4 px-4 py-2 bg-white/20 rounded-xl text-sm">
                    {{ ucfirst($dokter->status_ketersediaan) }}
                </span>

            </div>

        </div>

    </div>

    <!-- GRID CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- PERSONAL INFO -->
        <div class="bg-white p-7 rounded-[28px] border border-slate-100">

            <h2 class="text-xl font-bold mb-5">Personal Information</h2>

            <div class="space-y-4">

                <div class="flex justify-between border-b pb-3">
                    <span class="text-slate-400">Full Name</span>
                    <span class="font-semibold">{{ $dokter->user->name }}</span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="text-slate-400">Email</span>
                    <span class="font-semibold">{{ $dokter->user->email }}</span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="text-slate-400">Gender</span>
                    <span class="font-semibold">{{ $dokter->gender }}</span>
                </div>

            </div>

        </div>

        <!-- PROFESSIONAL INFO -->
        <div class="bg-white p-7 rounded-[28px] border border-slate-100">

            <h2 class="text-xl font-bold mb-5">Professional Information</h2>

            <div class="space-y-4">

                <div class="flex justify-between border-b pb-3">
                    <span class="text-slate-400">Doctor ID</span>
                    <span class="font-semibold">
                        DOC-{{ str_pad($dokter->id_dokter, 3, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="text-slate-400">No SIP</span>
                    <span class="font-semibold">{{ $dokter->no_sip }}</span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="text-slate-400">Status</span>
                    <span class="font-semibold text-green-600">
                        {{ ucfirst($dokter->status_ketersediaan) }}
                    </span>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection