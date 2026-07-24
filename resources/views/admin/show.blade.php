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

    $noRm = $pasien ? 'RM' . str_pad($pasien->id_pasien, 4, '0', STR_PAD_LEFT) : '-';

@endphp

<style>
    @media print {

        body * {
            visibility: hidden;
        }

        #rekam-medis-print, #rekam-medis-print * {
            visibility: visible;
        }

        #rekam-medis-print {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 0;
        }

        .no-print {
            display: none !important;
        }

        .print-letterhead {
            display: block !important;
        }

        #rekam-medis-print .rounded-3xl,
        #rekam-medis-print .rounded-2xl {
            border-radius: 8px !important;
            border: 1px solid #cbd5e1 !important;
            box-shadow: none !important;
        }

        #rekam-medis-print section,
        #rekam-medis-print > div > div {
            page-break-inside: avoid;
        }

        .print-footer {
            display: block !important;
        }

        @page {
            margin: 18mm 14mm;
        }
    }

    .print-letterhead,
    .print-footer {
        display: none;
    }
</style>

<div id="rekam-medis-print" class="space-y-6">

    {{-- LETTERHEAD — cuma muncul pas print --}}
    <div class="print-letterhead" style="border-bottom: 3px solid #0d9488; padding-bottom: 14px; margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <h1 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0;">
                    DigitalCare Clinic
                </h1>
                <p style="font-size: 11px; color: #64748b; margin: 2px 0 0 0;">
                    Rekam Medis Pasien &middot; Dokumen Resmi
                </p>
            </div>
            <p style="font-size: 10px; color: #94a3b8; margin: 0;">
                Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
            </p>
        </div>
    </div>

    {{-- HEADER (layar) --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 no-print">

        <div>

            
                <a href="{{ route('admin.medical-records.index') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-700 mb-2">

                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali Ke Daftar Rekam Medis

            </a>

            <h1 class="text-3xl font-bold text-slate-800">
                Detail Rekam Medis
            </h1>

            <p class="text-slate-500 mt-1">
                No Rekam Medis:
                {{ $noRm }}
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

    {{-- Judul dokumen, cuma muncul pas print --}}
    <div class="print-letterhead" style="margin-bottom: -6px;">
        <p style="font-size: 12px; color: #475569; margin: 0;">
            No Rekam Medis: <strong>{{ $noRm }}</strong>
            &middot;
            {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('l, d F Y · H:i') }}
        </p>
    </div>

    {{-- PATIENT & DOCTOR SUMMARY --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        {{-- PATIENT --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6">

            <div class="flex items-center gap-2 mb-4">

                <i data-lucide="user" class="w-4 h-4 text-teal-600"></i>

                <h4 class="font-semibold text-slate-800">
                    Information Pasien
                </h4>

            </div>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span class="text-slate-500">Nama</span>
                    <span class="font-medium text-slate-800">
                        {{ $namaPasien }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">No Rekam Medis</span>
                    <span class="font-medium text-slate-800">
                        {{ $noRm }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Jenis Kelamin</span>
                    <span class="font-medium text-slate-800">
                        {{ $pasien->gender === 'Male' ? 'Laki-laki' : ($pasien->gender === 'Female' ? 'Perempuan' : '-') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Tanggal Lahir</span>
                    <span class="font-medium text-slate-800">
                        {{ $pasien && $pasien->birth_date ? \Carbon\Carbon::parse($pasien->birth_date)->translatedFormat('d F Y') : '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Nomor Telepon</span>
                    <span class="font-medium text-slate-800">
                        {{ $pasien->phone_number ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Alamat</span>
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
                    Information Dokter
                </h4>

            </div>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span class="text-slate-500">Nama Dokter</span>
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
                    <span class="text-slate-500">Jenis Kelamin</span>
                    <span class="font-medium text-slate-800">
                        {{ $rekamMedis->dokter->gender === 'Male'
    ? 'Laki-laki'
    : ($rekamMedis->dokter->gender === 'Female'
        ? 'Perempuan'
        : '-') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Tanggal Pemeriksaan</span>
                    <span class="font-medium text-slate-800">
                        {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('d F Y') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Waktu</span>
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
                    Keluhan
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
                Catatan Dokter
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
                Resep Obat
            </span>

        </div>

        @if($rekamMedis->detailResep && $rekamMedis->detailResep->count())

        <div class="overflow-x-auto border border-slate-100 rounded-2xl">

            <table class="w-full text-sm">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-4 py-3 text-left text-slate-500">
                            Nama Obat
                        </th>

                        <th class="px-4 py-3 text-left text-slate-500">
                            Dosis
                        </th>

                        <th class="px-4 py-3 text-left text-slate-500">
                            Aturan Pakai
                        </th>

                        <th class="px-4 py-3 text-left text-slate-500">
                            Jumlah
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
                Tidak ada resep tersedia
            </p>

        </div>

        @endif

    </div>

    {{-- FOOTER TANDA TANGAN — cuma muncul pas print --}}
    <div class="print-footer" style="margin-top: 32px;">
        <div style="display: flex; justify-content: flex-end;">
            <div style="text-align: center; width: 220px;">
                <p style="font-size: 11px; color: #475569; margin: 0 0 60px 0;">
                    {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('d F Y') }}
                </p>
                <p style="font-size: 12px; font-weight: 600; color: #0f172a; margin: 0; border-top: 1px solid #94a3b8; padding-top: 6px;">
                    {{ $namaDokter }}
                </p>
                <p style="font-size: 10px; color: #94a3b8; margin: 2px 0 0 0;">
                    SIP: {{ $rekamMedis->dokter->no_sip ?? '-' }}
                </p>
            </div>
        </div>
        <p style="font-size: 9px; color: #94a3b8; text-align: center; margin-top: 24px;">
            Dokumen ini dicetak otomatis melalui sistem DigitalCare Clinic dan sah tanpa cap basah.
        </p>
    </div>

</div>

@endsection