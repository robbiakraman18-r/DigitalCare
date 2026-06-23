@extends('layouts.pasien')

@section('title', 'Status Janji Temu')
@section('subtitle', 'Pantau status antrian konsultasi kamu secara real-time')

@section('content')

@php
    $status = $appointment->status_janji;

    $steps = [
        ['key' => 'pending',         'label' => 'Menunggu',          'icon' => 'clock'],
        ['key' => 'called',          'label' => 'Dipanggil',         'icon' => 'bell'],
        ['key' => 'in_consultation', 'label' => 'Konsultasi',        'icon' => 'stethoscope'],
        ['key' => 'completed',       'label' => 'Selesai',           'icon' => 'check-circle'],
    ];

    $stepOrder   = ['pending' => 0, 'called' => 1, 'in_consultation' => 2, 'completed' => 3];
    $currentStep = $stepOrder[$status] ?? 0;
@endphp

<div class="max-w-4xl mx-auto space-y-6">

    {{-- CARD STATUS UTAMA --}}
    <div class="bg-white rounded-[32px] shadow-xl border border-slate-100 p-8">

        <div class="flex items-center justify-between mb-8 flex-wrap gap-4">

            <div>
                <p class="text-sm text-slate-400">Status Saat Ini</p>
                <h2 class="text-2xl font-bold mt-1
                    @if($status === 'pending') text-amber-500
                    @elseif($status === 'called') text-blue-500
                    @elseif($status === 'in_consultation') text-teal-500
                    @elseif($status === 'completed') text-green-500
                    @elseif($status === 'cancelled') text-red-500
                    @endif">
                    @if($status === 'pending') ⏳ Menunggu Konfirmasi
                    @elseif($status === 'called') 🔔 Kamu Dipanggil!
                    @elseif($status === 'in_consultation') 🩺 Sedang Konsultasi
                    @elseif($status === 'completed') ✅ Selesai
                    @elseif($status === 'cancelled') ❌ Dibatalkan
                    @endif
                </h2>
            </div>

            {{-- NOMOR ANTRIAN --}}
            <div class="text-center bg-gradient-to-br from-teal-500 to-cyan-500 text-white rounded-3xl px-8 py-4 shadow-lg shadow-teal-200">
                <p class="text-xs opacity-80">No. Antrian</p>
                <h1 class="text-5xl font-extrabold">{{ $appointment->nomor_antrian }}</h1>
            </div>

        </div>

        {{-- STEPPER --}}
        @if($status !== 'cancelled')
        <div class="flex items-start gap-1">
            @foreach($steps as $i => $step)
                @php $done = $i <= $currentStep; @endphp
                <div class="flex items-center flex-1">
                    <div class="flex flex-col items-center gap-1 w-full">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0
                            {{ $done ? 'bg-teal-500 text-white shadow-md shadow-teal-200' : 'bg-slate-100 text-slate-400' }}">
                            <i data-lucide="{{ $step['icon'] }}" class="w-4 h-4"></i>
                        </div>
                        <p class="text-[10px] text-center text-slate-500 leading-tight">{{ $step['label'] }}</p>
                    </div>
                    @if(!$loop->last)
                        <div class="h-[2px] flex-1 mb-5 mx-1 {{ $i < $currentStep ? 'bg-teal-400' : 'bg-slate-200' }}"></div>
                    @endif
                </div>
            @endforeach
        </div>
        @else
        <div class="bg-red-50 rounded-2xl p-4 border border-red-100 text-red-600 text-sm">
            ❌ Janji temu ini telah dibatalkan oleh dokter. Silakan buat janji temu baru.
        </div>
        @endif

    </div>

    {{-- DETAIL APPOINTMENT --}}
    <div class="bg-white rounded-[32px] shadow-xl border border-slate-100 p-8">

        <h3 class="font-bold text-slate-700 mb-5 text-lg">Detail Appointment</h3>

        <div class="grid md:grid-cols-2 gap-4">

            <div class="bg-slate-50 rounded-2xl p-5">
                <p class="text-xs text-slate-400">Dokter</p>
                <p class="font-bold text-slate-700 mt-1">
                    {{ $appointment->dokter->user->nama ?? '-' }}
                </p>
                <p class="text-xs text-teal-500 mt-1">
                    {{ $appointment->dokter->spesialisasi ?? 'Dokter Umum' }}
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5">
                <p class="text-xs text-slate-400">Tanggal</p>
                <p class="font-bold text-slate-700 mt-1">
                    {{ $appointment->tanggal_janji ? \Carbon\Carbon::parse($appointment->tanggal_janji)->translatedFormat('l, d F Y') : '-' }}
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5">
                <p class="text-xs text-slate-400">Estimasi Jam Konsultasi</p>
                <p class="font-bold text-slate-700 mt-1">
                    @if($appointment->jam_konsultasi)
                        {{ $appointment->jam_konsultasi ? \Carbon\Carbon::parse($appointment->jam_konsultasi)->format('H:i') . ' WIB' : '-' }}
                    @else
                        -
                    @endif
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5">
                <p class="text-xs text-slate-400">Ruangan</p>
                <p class="font-bold text-slate-700 mt-1">
                    {{ $appointment->jadwaldokter->ruang ?? '-' }}
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl md:col-span-2 p-5">
                <p class="text-xs text-slate-400">Keluhan Utama</p>
                <p class="font-medium text-slate-700 mt-1">{{ $appointment->keluhan_utama }}</p>
            </div>

        </div>

    </div>

    {{-- NOTIFIKASI SESUAI STATUS --}}
    @if($status === 'called')
    <div class="bg-blue-50 border border-blue-100 rounded-3xl p-6 flex items-center gap-4 animate-pulse">
        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-2xl shrink-0">🔔</div>
        <div>
            <p class="font-bold text-blue-700">Namamu sedang dipanggil!</p>
            <p class="text-sm text-blue-500 mt-1">
                Segera menuju ruang <strong>{{ $appointment->jadwaldokter->ruang ?? 'konsultasi' }}</strong>.
            </p>
        </div>
    </div>

    @elseif($status === 'pending')
    <div class="bg-amber-50 border border-amber-100 rounded-3xl p-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-2xl shrink-0">⏳</div>
        <div>
            <p class="font-bold text-amber-700">Harap tunggu giliran kamu</p>
            <p class="text-sm text-amber-500 mt-1">
                Estimasi jam konsultasi:
                <strong>
                    @if($appointment->jam_konsultasi)
                        {{ \Carbon\Carbon::parse($appointment->jam_konsultasi)->format('H:i') }} WIB
                    @else
                        -
                    @endif
                </strong>
            </p>
        </div>
    </div>

    @elseif($status === 'in_consultation')
    <div class="bg-teal-50 border border-teal-100 rounded-3xl p-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-teal-100 flex items-center justify-center text-2xl shrink-0">🩺</div>
        <div>
            <p class="font-bold text-teal-700">Kamu sedang dalam konsultasi</p>
            <p class="text-sm text-teal-500 mt-1">Dokter sedang memproses pemeriksaanmu.</p>
        </div>
    </div>

    @elseif($status === 'completed')
    <div class="bg-green-50 border border-green-100 rounded-3xl p-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-2xl shrink-0">✅</div>
        <div>
            <p class="font-bold text-green-700">Konsultasi selesai!</p>
            <p class="text-sm text-green-500 mt-1">Rekam medis dan resep kamu sudah tersedia.</p>
        </div>
    </div>
    <a href="/pasien/listrekam-medis"
    class="w-full flex items-center justify-center gap-2 py-4 rounded-2xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-semibold shadow-lg shadow-teal-200 hover:scale-[1.01] transition-all duration-300">
        <i data-lucide="file-heart" class="w-5 h-5"></i>
        Lihat Rekam Medis
    </a>
    @endif

    {{-- TOMBOL BUAT JANJI BARU KALAU CANCELLED --}}
    @if($status === 'cancelled')
    <a href="{{ route('pasien.buat-janji') }}"
    class="w-full flex items-center justify-center gap-2 py-4 rounded-2xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-semibold shadow-lg shadow-teal-200 hover:scale-[1.01] transition-all duration-300">
        <i data-lucide="calendar-plus" class="w-5 h-5"></i>
        Buat Janji Temu Baru
    </a>
    @endif

</div>

{{-- AUTO REFRESH setiap 30 detik --}}
<script>
    // @if(in_array($status, ['pending', 'called', 'in_consultation']))
    setTimeout(() => location.reload(), 30000);
    // @endif
</script>

@endsection