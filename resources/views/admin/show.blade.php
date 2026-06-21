@extends('layouts.admin')

@section('content')

@php

    $pasien = $rekamMedis->appointment->pasien ?? null;

    $namaPasien =
        $pasien->user->nama
        ?? 'Unknown Patient';

    $namaDokter =
        $rekamMedis->dokter->user->nama
        ?? '-';

@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <a
                href="{{ route('admin.medical-records.index') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-700 mb-2">

                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Medical Records

            </a>

            <h1 class="text-3xl font-bold text-slate-800">
                Medical Record Detail
            </h1>

            <p class="text-slate-500 mt-1">
                Record No.
                {{ $pasien->no_rm ?? '-' }}
                ·
                {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('l, d F Y · H:i') }}
            </p>

        </div>

        <div class="flex gap-3">

            <button
                onclick="window.print()"
                class="px-5 py-3 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 font-medium text-slate-600 inline-flex items-center gap-2">

                <i data-lucide="printer" class="w-4 h-4"></i>
                Print

            </button>

        </div>

    </div>

    {{-- PATIENT & DOCTOR SUMMARY --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        {{-- PATIENT --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6">

            <div class="flex items-center gap-2 mb-4">

                <i data-lucide="user" class="w-4 h-4 text-teal-600"></i>

                <h4 class="font-semibold text-slate-800">
                    Patient Information
                </h4>

            </div>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span class="text-slate-500">Name</span>
                    <span class="font-medium text-slate-800">
                        {{ $namaPasien }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Medical Record No</span>
                    <span class="font-medium text-slate-800">
                        {{ $pasien->no_rm ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Gender</span>
                    <span class="font-medium text-slate-800">
                        {{ $pasien->gender ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Date of Birth</span>
                    <span class="font-medium text-slate-800">
                        {{ $pasien && $pasien->birth_date ? \Carbon\Carbon::parse($pasien->birth_date)->translatedFormat('d F Y') : '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Phone</span>
                    <span class="font-medium text-slate-800">
                        {{ $pasien->phone_number ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Address</span>
                    <span class="font-medium text-slate-800 text-right">
                        {{ $pasien->address ?? '-' }}
                    </span>
                </div>

            </div>

        </div>

        {{-- DOCTOR --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6">

            <div class="flex items-center gap-2 mb-4">

                <i data-lucide="stethoscope" class="w-4 h-4 text-blue-600"></i>

                <h4 class="font-semibold text-slate-800">
                    Doctor Information
                </h4>

            </div>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span class="text-slate-500">Doctor Name</span>
                    <span class="font-medium text-slate-800">
                        {{ $namaDokter }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">SIP No</span>
                    <span class="font-medium text-slate-800">
                        {{ $rekamMedis->dokter->no_sip ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Gender</span>
                    <span class="font-medium text-slate-800">
                        {{ $rekamMedis->dokter->gender ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Examination Date</span>
                    <span class="font-medium text-slate-800">
                        {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('d F Y') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Time</span>
                    <span class="font-medium text-slate-800">
                        {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->format('H:i') }}
                    </span>
                </div>

            </div>

        </div>

    </div>

    {{-- DIAGNOSIS & COMPLAINT --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        {{-- DIAGNOSIS --}}
        <div class="bg-orange-50 rounded-3xl p-6">

            <div class="flex items-center gap-2 mb-3">

                <i data-lucide="clipboard-list" class="w-4 h-4 text-orange-500"></i>

                <span class="text-xs uppercase tracking-wider font-semibold text-orange-600">
                    Diagnosis
                </span>

            </div>

            <p class="text-slate-800 font-medium leading-relaxed">
                {{ $rekamMedis->diagnosa ?? '-' }}
            </p>

        </div>

        {{-- COMPLAINT --}}
        <div class="bg-slate-50 rounded-3xl p-6">

            <div class="flex items-center gap-2 mb-3">

                <i data-lucide="message-square" class="w-4 h-4 text-slate-500"></i>

                <span class="text-xs uppercase tracking-wider font-semibold text-slate-600">
                    Chief Complaint
                </span>

            </div>

            <p class="text-slate-700 leading-relaxed">
                {{ $rekamMedis->keluhan ?? '-' }}
            </p>

        </div>

    </div>

    {{-- DOCTOR NOTE --}}
    @if($rekamMedis->catatan_dokter)

    <div class="bg-cyan-50 rounded-3xl p-6">

        <div class="flex items-center gap-2 mb-3">

            <i data-lucide="file-text" class="w-4 h-4 text-cyan-600"></i>

            <span class="text-xs uppercase tracking-wider font-semibold text-cyan-600">
                Doctor Notes
            </span>

        </div>

        <p class="text-slate-700 leading-relaxed">
            {{ $rekamMedis->catatan_dokter }}
        </p>

    </div>

    @endif

    {{-- PRESCRIPTION --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6">

        <div class="flex items-center gap-2 mb-4">

            <i data-lucide="pill" class="w-4 h-4 text-purple-500"></i>

            <span class="text-xs uppercase tracking-wider font-semibold text-purple-600">
                Prescription
            </span>

        </div>

        @if($rekamMedis->detailResep && $rekamMedis->detailResep->count())

        <div class="overflow-x-auto border border-slate-100 rounded-2xl">

            <table class="w-full text-sm">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-4 py-3 text-left text-slate-500">
                            Medicine
                        </th>

                        <th class="px-4 py-3 text-left text-slate-500">
                            Dosage
                        </th>

                        <th class="px-4 py-3 text-left text-slate-500">
                            Instructions
                        </th>

                        <th class="px-4 py-3 text-left text-slate-500">
                            Quantity
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($rekamMedis->detailResep as $resep)

                    <tr class="border-t border-slate-100">

                        <td class="px-4 py-3 font-medium text-slate-800">
                            {{ $resep->nama_obat }}
                        </td>

                        <td class="px-4 py-3 text-slate-600">
                            {{ $resep->dosis }}
                        </td>

                        <td class="px-4 py-3 text-slate-600">
                            {{ $resep->aturan_pakai }}
                        </td>

                        <td class="px-4 py-3 text-slate-600">
                            {{ $resep->jumlah }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @else

        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-8 text-center">

            <i data-lucide="pill-off" class="w-8 h-8 text-slate-300 mx-auto mb-2"></i>

            <p class="text-sm text-slate-500">
                No prescription available
            </p>

        </div>

        @endif

    </div>

</div>

@endsection