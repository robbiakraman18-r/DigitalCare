@extends('layouts.pasien')

@section('title')
    Halo, {{ Auth::user()->nama }} 👋
@endsection

@section('subtitle', 'Selamat datang kembali di DigitalCare')

@section('content')
@php
    $pasien = auth()->user()->pasien;
@endphp

@if($pasien && !$pasien->isProfileComplete())

<div class="mb-6 rounded-3xl border border-amber-200 bg-gradient-to-r from-amber-50 to-yellow-50 p-6">

    <div class="flex items-start gap-4">

        <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center shrink-0">
            <i data-lucide="triangle-alert" class="w-6 h-6 text-amber-600"></i>
        </div>

        <div class="flex-1">

            <h2 class="font-bold text-amber-700 text-lg">
                Profil Belum Lengkap
            </h2>

            <p class="text-sm text-amber-700 mt-1 leading-relaxed">
                Sebelum dapat membuat appointment, silakan lengkapi data diri Anda terlebih dahulu seperti:
                <strong>NIK</strong>,
                <strong>Tanggal Lahir</strong>,
                <strong>Jenis Kelamin</strong>,
                <strong>Nomor Telepon</strong>,
                dan <strong>Alamat</strong>.
            </p>

            <a href="{{ route('profile.edit') }}"
               class="inline-flex items-center gap-2 mt-4 px-5 py-3 rounded-2xl bg-amber-500 hover:bg-amber-600 text-white font-semibold transition">

                <i data-lucide="user-round-pen" class="w-4 h-4"></i>

                Lengkapi Profil

            </a>

        </div>

    </div>

</div>

@endif
<div class="space-y-8" x-data="pasienDashboard">
    {{-- Banner Selamat Datang --}}
    <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-teal-500 to-cyan-500 p-8 lg:p-10 shadow-xl shadow-teal-100">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-lg border border-white/20 text-white text-xs mb-4">
                    <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                    Layanan Kesehatan Smart Campus Aktif
                </div>
            <h1 class="text-3xl lg:text-4xl font-extrabold text-white leading-tight">
                DigitalCare Smart Campus
            </h1>

            <p class="text-white/90 mt-2 text-sm leading-relaxed max-w-xl">
                Kelola janji temu, pantau riwayat kesehatan, dan akses layanan klinik kampus dengan mudah dalam satu aplikasi.
            </p>
            </div>
            <div class="flex gap-3 shrink-0">
                <a href="{{ route('pasien.buat-janji') }}" class="px-5 py-3 rounded-2xl bg-white text-teal-600 font-semibold shadow-md hover:bg-teal-50 transition text-sm">
                    Buat Janji Temu
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

    {{-- KOLOM KIRI --}}
    <div class="space-y-6">
                {{-- Janji Temu Terdekat --}}
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between min-h-[360px]">
                    <div>
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Janji Temu Terdekat</h3>
                        @if($janjiTerdekat)
                            <div class="p-4 rounded-2xl bg-teal-50/50 border border-teal-100 flex items-start gap-3">
                                <div class="w-10 h-10 rounded-xl bg-teal-500 flex items-center justify-center text-white text-xl shrink-0">
                                    👨‍⚕️
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">
                                        {{ $janjiTerdekat->dokter->user->nama ?? 'Dokter' }}
                                    </h4>
                                    <p class="text-xs text-teal-600 font-medium mb-3">
                                        {{ $janjiTerdekat->dokter->no_sip ?? '-' }}
                                    </p>
                                <div class="space-y-1 text-xs text-slate-500">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="calendar-days" class="w-4 h-4 text-teal-500"></i>
                                        <span>
                                            {{ \Carbon\Carbon::parse($janjiTerdekat->tanggal_janji)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>
                <div class="flex items-center gap-2">
                            <i data-lucide="clock-3" class="w-4 h-4 text-teal-500"></i>
                            <span>
                                {{ \Carbon\Carbon::parse($janjiTerdekat->jadwal->jam_mulai)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($janjiTerdekat->jadwal->jam_selesai)->format('H:i') }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-teal-500"></i>
                            <span>
                                {{ $janjiTerdekat->jadwal->ruang }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i data-lucide="ticket" class="w-4 h-4 text-teal-500"></i>
                            <span>
                                Nomor Antrean :
                                <strong>A-{{ str_pad($janjiTerdekat->nomor_antrian, 2, '0', STR_PAD_LEFT) }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                        @else
                        <div class="h-[210px] flex flex-col items-center justify-center text-center">

                            <div class="w-16 h-16 rounded-2xl bg-teal-50 flex items-center justify-center mb-4">
                                <i data-lucide="calendar-days" class="w-8 h-8 text-teal-500"></i>
                            </div>

                            <h4 class="font-bold text-slate-700">
                                Belum Ada Janji Temu
                            </h4>

                            <p class="text-sm text-slate-400 mt-2 max-w-xs">
                                Kamu belum memiliki jadwal pemeriksaan.
                                Yuk buat janji temu dengan dokter.
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        {{-- KOLOM KANAN --}}
        <div class="space-y-6">
            {{-- Konsumsi Obat Aktif --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider">Resep Obat Terakhir</h3>
                    @if($rekamMedis)
                        <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 text-[11px] font-semibold">
                            {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('d M Y') }}
                        </span>
                    @endif
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($detailResep as $obat)
                        <div class="flex items-center justify-between py-3 first:pt-0 last:pb-0">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-cyan-50 flex items-center justify-center text-cyan-600 text-sm font-bold">💊</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">{{ $obat->nama_obat }}</h4>
                                    <p class="text-xs text-slate-400">{{ $obat->dosis }} — {{ $obat->aturan_pakai }}</p>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-slate-600">{{ $obat->jumlah }} pcs</span>
                        </div>
                    @empty
                        <div class="py-6 text-center">
                            <p class="text-sm text-slate-400">Belum ada resep obat.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Akses Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('pasien.buat-janji') }}" class="p-5 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl bg-teal-50 text-teal-500 flex items-center justify-center mb-2 group-hover:bg-teal-500 group-hover:text-white transition">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">Daftar Periksa</span>
                    </a>

                    <a href="{{ route('pasien.listrekam-medis') }}" class="p-5 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl bg-green-50 text-green-500 flex items-center justify-center mb-2 group-hover:bg-green-500 group-hover:text-white transition">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">Riwayat Medis</span>
                    </a>
                    <a href="{{ route('pasien.complaint') }}" class="p-5 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-2 group-hover:bg-indigo-500 group-hover:text-white transition">
                            <i data-lucide="phone-call" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">Bantuan</span>
                    </a>
                </div>
            </div>
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-500 flex items-center justify-center">
                        <i data-lucide="activity" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-800">{{ $totalKunjungan }} Kali</h4>
                        <p class="text-xs text-slate-400">Total Kunjungan Klinik</p>
                    </div>
                </div>
                <a href="{{ route('pasien.listrekam-medis') }}" class="text-xs text-teal-600 font-semibold hover:underline">Lihat Semua</a>
            </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/pasien-dashboard.js') }}"></script>
@endpush

@endsection