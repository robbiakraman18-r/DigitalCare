@extends('layouts.admin')


@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Rekam Medis
            </h1>

            <p class="text-slate-500 mt-1">
                {{ $totalRecords }} rekam medis tersimpan
            </p>
        </div>

        <button
            class="px-5 py-3 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 font-medium text-slate-600">
            Ekspor
        </button>

    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-white rounded-3xl border border-slate-100 p-5">
            <p class="text-sm text-slate-500">
                Total Rekam Medis
            </p>

            <h2 class="text-3xl font-bold text-slate-800 mt-2">
                {{ $totalRecords }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 p-5">
            <p class="text-sm text-slate-500">
                Dokter Aktif
            </p>

            <h2 class="text-3xl font-bold text-blue-600 mt-2">
                {{ $totalDoctors }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 p-5">
            <p class="text-sm text-slate-500">
                Resep Obat
            </p>

            <h2 class="text-3xl font-bold text-purple-600 mt-2">
                {{ $totalPrescriptions }}
            </h2>
        </div>

    </div>

    {{-- FILTER --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-5">

        <form
            method="GET"
            action="{{ route('admin.medical-records.index') }}"
            class="grid grid-cols-1 md:grid-cols-3 gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari pasien atau diagnosis..."
                class="border border-slate-200 rounded-2xl px-4 py-3">

            <input
                type="date"
                name="tanggal"
                value="{{ request('tanggal') }}"
                class="border border-slate-200 rounded-2xl px-4 py-3">

            <button
                class="bg-teal-500 hover:bg-teal-600 text-white rounded-2xl font-semibold py-3">

                Filter

            </button>

        </form>

    </div>

    {{-- LIST --}}
    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden">

        @if($rekamMedis->count() > 0)

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-slate-500 font-medium">
                            Tanggal 
                        </th>

                        <th class="px-6 py-4 text-left text-slate-500 font-medium">
                            Pasien
                        </th>

                        <th class="px-6 py-4 text-left text-slate-500 font-medium">
                            Diagnosis
                        </th>

                        <th class="px-6 py-4 text-left text-slate-500 font-medium">
                            Dokter
                        </th>

                        <th class="px-6 py-4 text-left text-slate-500 font-medium">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-slate-500 font-medium">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($rekamMedis as $index => $rekam)

                    @php

                        $pasien = $rekam->appointment->pasien ?? null;

                        $namaPasien =
                            $pasien->user->nama
                            ?? 'Pasien Tidak Ditemukan';

                        $namaDokter =
                            $rekam->dokter->user->nama
                            ?? '-';

                    @endphp

                    <tr class="border-t border-slate-100 hover:bg-slate-50">

                        <td class="px-6 py-4 align-top">

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-11 h-11 rounded-2xl bg-teal-50 flex flex-col items-center justify-center shrink-0">

                                    <span class="text-sm font-bold text-teal-700">
                                        {{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->format('d') }}
                                    </span>

                                    <span class="text-[9px] text-teal-500">
                                        {{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->translatedFormat('M') }}
                                    </span>

                                </div>

                                <div>
                                    <p class="font-medium text-slate-800">
                                        {{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->translatedFormat('d F Y') }}
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        {{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->format('H:i') }}
                                    </p>
                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-4 align-top">

                            <p class="font-medium text-slate-800">
                                {{ $namaPasien }}
                            </p>

                            <p class="text-xs text-slate-400">
                                {{ $pasien ? 'RM' . str_pad($pasien->id_pasien, 4, '0', STR_PAD_LEFT) : '-' }}
                            </p>

                        </td>

                        <td class="px-6 py-4 align-top max-w-xs">

                            <p class="text-slate-700 truncate">
                                {{ $rekam->diagnosa ?? 'Diagnosis belum diisi' }}
                            </p>

                        </td>

                        <td class="px-6 py-4 align-top text-slate-700">
                            {{ $namaDokter }}
                        </td>

                        <td class="px-6 py-4 align-top">

                            @if($index == 0)

                            <span
                                class="px-3 py-1 bg-teal-100 text-teal-700 rounded-xl text-xs font-semibold">
                                Terbaru
                            </span>

                            @else

                            <span
                                class="px-3 py-1 bg-slate-100 text-slate-500 rounded-xl text-xs font-semibold">
                                Selesai
                            </span>

                            @endif

                        </td>

                        <td class="px-6 py-4 align-top text-right">

                            <a
                                href="{{ route('admin.medical-records.show', $rekam->id_rekam_medis) }}"
                                class="px-4 py-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 font-medium text-xs inline-block">

                                Lihat Detail

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @else

        {{-- EMPTY STATE --}}
        <div class="p-16 text-center">

            <i
                data-lucide="file-x"
                class="w-10 h-10 mx-auto text-slate-300 mb-4">
            </i>

            <p class="text-slate-500">
                Tidak ada rekam medis yang ditemukan
            </p>

        </div>

        @endif

    </div>

    {{-- PAGINATION --}}
    @if($rekamMedis->hasPages())

    <div class="pt-2">
        {{ $rekamMedis->links() }}
    </div>

    @endif

</div>

@endsection