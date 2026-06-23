@extends('layouts.pasien')

@section('title', 'Rekam Medis')
@section('subtitle', 'Riwayat konsultasi dan pemeriksaan kamu')

@section('content')

<div class="bg-white/90 backdrop-blur-xl rounded-[30px] shadow-xl border border-white p-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Medical History List</h2>
            <p class="text-slate-400 text-sm mt-1">View your past consultations and medical records</p>
        </div>
    </div>

    {{-- EMPTY STATE --}}
    @if($rekamMedisList->isEmpty())
    <div class="text-center py-20">
        <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
            <i data-lucide="file-heart" class="w-8 h-8 text-slate-400"></i>
        </div>
        <h3 class="font-bold text-slate-700">Belum ada rekam medis</h3>
        <p class="text-slate-400 text-sm mt-1">Rekam medis akan muncul setelah konsultasi selesai</p>
    </div>

    @else

    {{-- TABLE --}}
    <div class="overflow-x-auto rounded-3xl border border-slate-100">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">Visit Date</th>
                    <th class="px-6 py-4 text-left font-semibold">Doctor</th>
                    <th class="px-6 py-4 text-left font-semibold">Main Complaint</th>
                    <th class="px-6 py-4 text-left font-semibold">Diagnosis</th>
                    <th class="px-6 py-4 text-left font-semibold">Status</th>
                    <th class="px-6 py-4 text-center font-semibold">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($rekamMedisList as $rekam)
                <tr class="hover:bg-slate-50 transition">

                    <td class="px-6 py-5 text-slate-600">
                        {{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->translatedFormat('d F Y') }}
                    </td>

                    <td class="px-6 py-5 font-medium text-slate-700">
                        {{ $rekam->dokter->user->nama ?? '-' }}
                    </td>

                    <td class="px-6 py-5 text-slate-600">
                        {{ Str::limit($rekam->appointment->keluhan_utama ?? '-', 40) }}
                    </td>

                    <td class="px-6 py-5 text-slate-600">
                        {{ $rekam->diagnosa ?? 'N/A' }}
                    </td>

                    <td class="px-6 py-5">
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-500 text-xs font-semibold">
                            Selesai
                        </span>
                    </td>

                    <td class="px-6 py-5 text-center">
                        <a href="{{ route('pasien.detail-rekam-medis', $rekam->id_rekam_medis) }}"
                        class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-teal-100 hover:text-teal-500 transition inline-flex items-center justify-center">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>

@endsection