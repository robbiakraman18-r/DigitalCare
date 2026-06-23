@extends('layouts.pasien')

@section('title', 'Detail Rekam Medis')
@section('subtitle', 'Informasi lengkap hasil konsultasi')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

    {{-- BACK --}}
    <a href="{{ route('pasien.listrekam-medis') }}"
    class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-teal-500 transition">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar Rekam Medis
    </a>

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- CONSULTATION DETAIL --}}
            <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Consultation Detail</h2>
                        <p class="text-slate-400 text-sm mt-1">Medical examination information</p>
                    </div>
                    <span class="px-4 py-2 rounded-full bg-green-100 text-green-500 text-sm font-semibold">
                        Selesai
                    </span>
                </div>

                <div class="grid md:grid-cols-2 gap-4">

                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-slate-400 text-xs uppercase tracking-wide">Visit Date</p>
                        <h3 class="font-semibold text-slate-700 mt-1">
                            {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('l, d F Y') }}
                        </h3>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-slate-400 text-xs uppercase tracking-wide">Jam Pemeriksaan</p>
                        <h3 class="font-semibold text-slate-700 mt-1">
                            {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->format('H:i') }} WIB
                        </h3>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-slate-400 text-xs uppercase tracking-wide">Doctor</p>
                        <h3 class="font-semibold text-slate-700 mt-1">
                            {{ $rekamMedis->dokter->user->nama ?? '-' }}
                        </h3>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-slate-400 text-xs uppercase tracking-wide">Ruangan</p>
                        <h3 class="font-semibold text-slate-700 mt-1">
                            {{ $rekamMedis->appointment->jadwaldokter->ruang ?? '-' }}
                        </h3>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4 md:col-span-2">
                        <p class="text-slate-400 text-xs uppercase tracking-wide">Keluhan Utama</p>
                        <h3 class="font-semibold text-slate-700 mt-1">
                            {{ $rekamMedis->appointment->keluhan_utama ?? '-' }}
                        </h3>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4 md:col-span-2">
                        <p class="text-slate-400 text-xs uppercase tracking-wide">Keluhan Saat Pemeriksaan</p>
                        <h3 class="font-semibold text-slate-700 mt-1">
                            {{ $rekamMedis->keluhan ?? '-' }}
                        </h3>
                    </div>

                    <div class="bg-teal-50 rounded-2xl p-4 md:col-span-2 border border-teal-100">
                        <p class="text-teal-500 text-xs uppercase tracking-wide font-semibold">Diagnosis</p>
                        <h3 class="font-bold text-teal-700 mt-1 text-lg">
                            {{ $rekamMedis->diagnosa ?? '-' }}
                        </h3>
                    </div>

                </div>

            </div>

            {{-- DOCTOR NOTES --}}
            <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-xl bg-teal-100 flex items-center justify-center">
                        <i data-lucide="notebook-pen" class="w-4 h-4 text-teal-600"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">Doctor Notes</h2>
                </div>

                <p class="text-slate-600 leading-relaxed">
                    {{ $rekamMedis->catatan_dokter ?? 'Tidak ada catatan dari dokter.' }}
                </p>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="space-y-6">

            {{-- PRESCRIPTION --}}
            <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">

                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 rounded-xl bg-teal-100 flex items-center justify-center">
                        <i data-lucide="pill" class="w-4 h-4 text-teal-600"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">Prescription</h2>
                </div>

                @if($rekamMedis->detailResep && $rekamMedis->detailResep->count() > 0)
                <div class="space-y-3">
                    @foreach($rekamMedis->detailResep as $resep)
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">

                        <div class="flex items-start justify-between gap-2">
                            <h3 class="font-semibold text-slate-700">{{ $resep->nama_obat }}</h3>
                            <span class="text-xs bg-teal-100 text-teal-600 px-2 py-1 rounded-full font-medium shrink-0">
                                {{ $resep->jumlah }} pcs
                            </span>
                        </div>

                        <p class="text-xs text-slate-400 mt-1">
                            Dosis: {{ $resep->dosis ?? '-' }}
                        </p>
                        <p class="text-xs text-slate-500 mt-0.5">
                            {{ $resep->aturan_pakai ?? '-' }}
                        </p>

                    </div>
                    @endforeach
                </div>

                @else
                <div class="text-center py-6">
                    <i data-lucide="pill" class="w-8 h-8 text-slate-300 mx-auto mb-2"></i>
                    <p class="text-sm text-slate-400">Tidak ada resep obat</p>
                </div>
                @endif

            </div>

            {{-- DOWNLOAD PDF --}}
            <a href="{{ route('pasien.detail-rekam-medis', $rekamMedis->id_rekam_medis) }}?download=1"
            class="w-full flex items-center justify-center gap-2 py-4 rounded-2xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-semibold shadow-lg shadow-teal-200 hover:scale-[1.01] transition-all duration-300">
                <i data-lucide="download" class="w-5 h-5"></i>
                Download PDF
            </a>

        </div>

    </div>

</div>

@endsection