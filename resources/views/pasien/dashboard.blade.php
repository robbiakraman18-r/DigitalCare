@extends('layouts.pasien')

@section('title')
    Halo, {{ Auth::user()->nama }} 👋
@endsection

@section('subtitle', 'Selamat datang kembali di DigitalCare')

@section('content')
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
                <a href="/pasien/buat-janji" class="px-5 py-3 rounded-2xl bg-white text-teal-600 font-semibold shadow-md hover:bg-teal-50 transition text-sm">
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
                        @if(isset($janjiTerdekat) && $janjiTerdekat)
                            <div class="p-4 rounded-2xl bg-teal-50/50 border border-teal-100 flex items-start gap-3">
                                <div class="w-10 h-10 rounded-xl bg-teal-500 flex items-center justify-center text-white text-xl shrink-0">
                                    👨‍⚕️
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">
                                        {{ $janjiTerdekat->dokter->user->nama ?? 'Dokter' }}
                                    </h4>
                                    <p class="text-xs text-teal-600 font-medium mb-3">
                                        {{ $janjiTerdekat->dokter->spesialisasi ?? 'Dokter Umum' }}
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
                    <div class="flex gap-2 mt-4 pt-4 border-t border-slate-100">
                        <button class="flex-1 py-2 rounded-xl bg-teal-50 text-teal-600 text-xs font-semibold hover:bg-teal-100 transition">
                            Lihat Barcode
                        </button>
                        <button class="flex-1 py-2 rounded-xl text-slate-500 text-xs font-medium hover:bg-slate-50 transition">
                            Reschedule
                        </button>
                    </div>
                </div>

                {{-- Tanda Vital Terakhir --}}
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Tanda Vital Terakhir</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 bg-slate-50 rounded-2xl text-center">
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Tekanan Darah</span>
                            <span class="text-lg font-bold text-slate-800 block mt-1">{{ $rekamMedis->tekanan_darah ?? '120/80' }}</span>
                            <span class="text-[10px] text-slate-400">mmHg</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-2xl text-center">
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Detak Jantung</span>
                            <span class="text-lg font-bold text-slate-800 block mt-1">{{ $rekamMedis->detak_jantung ?? '76' }}</span>
                            <span class="text-[10px] text-slate-400">bpm</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-2xl text-center">
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Berat Badan</span>
                            <span class="text-lg font-bold text-slate-800 block mt-1">{{ $rekamMedis->berat_badan ?? '58.2' }}</span>
                            <span class="text-[10px] text-slate-400">kg</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-2xl text-center">
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Suhu Tubuh</span>
                            <span class="text-lg font-bold text-slate-800 block mt-1">{{ $rekamMedis->suhu_tubuh ?? '36.8' }}</span>
                            <span class="text-[10px] text-slate-400">°C</span>
                        </div>
                    </div>
                </div>

            </div>
        {{-- KOLOM KANAN --}}
        <div class="space-y-6">
            {{-- Konsumsi Obat Aktif --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider">Konsumsi Obat Aktif</h3>
                    <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 text-[11px] font-semibold">Dalam Masa Penyembuhan</span>
                </div>
                
                <div class="divide-y divide-slate-100">
                    @forelse($resepObat ?? [] as $obat)
                        <div class="flex items-center justify-between py-3 first:pt-0 last:pb-0">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-cyan-50 flex items-center justify-center text-cyan-600 text-sm font-bold">💊</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">{{ $obat->nama_obat }}</h4>
                                    <p class="text-xs text-slate-400">{{ $obat->dosis }} — {{ $obat->keterangan }}</p>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-slate-600">{{ $obat->waktu_konsumsi }}</span>
                        </div>
                    @empty
                        <div class="flex items-center justify-between py-3 first:pt-0">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-cyan-50 flex items-center justify-center text-cyan-600 text-sm font-bold">💊</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">Amoxicillin 500mg</h4>
                                    <p class="text-xs text-slate-400">3x Sehari (Setelah makan) — Habiskan</p>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-slate-600">Jam 08:00 | 14:00 | 20:00</span>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Akses Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="/pasien/buat-janji" class="p-5 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl bg-teal-50 text-teal-500 flex items-center justify-center mb-2 group-hover:bg-teal-500 group-hover:text-white transition">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">Daftar Periksa</span>
                    </a>
                    
                    <a href="/pasien/rekam-medis" class="p-5 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl bg-green-50 text-green-500 flex items-center justify-center mb-2 group-hover:bg-green-500 group-hover:text-white transition">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">Riwayat Medis</span>
                    </a>

                    <a href="/pasien/resep-obat" class="p-5 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center mb-2 group-hover:bg-amber-500 group-hover:text-white transition">
                            <i data-lucide="pill" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">E-Resep</span>
                    </a>

                    <a href="/pasien/bantuan" class="p-5 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-2 group-hover:bg-indigo-500 group-hover:text-white transition">
                            <i data-lucide="phone-call" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">Info Darurat</span>
                    </a>
                </div>
            </div>
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-500 flex items-center justify-center">
                        <i data-lucide="activity" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-800">{{ $totalKunjungan ?? 5 }} Kali</h4>
                        <p class="text-xs text-slate-400">Total Kunjungan Klinik</p>
                    </div>
                </div>
                <a href="/pasien/rekam-medis" class="text-xs text-teal-600 font-semibold hover:underline">Lihat Semua</a>
            </div>
            </div>
            <button @click="openLogout()" class="w-full py-3 rounded-2xl bg-slate-100 hover:bg-red-50 hover:text-red-600 text-slate-600 font-medium transition flex items-center justify-center gap-2">
                <i data-lucide="log-out" class="w-4 h-4"></i> Keluar Aplikasi
            </button>
        </div>

    </div>
</div>

{{-- Modal Logout Terpisah Secara Alur DOM --}}
<div x-show="logoutModal" x-transition class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50" style="display:none;">
    <div class="bg-white rounded-3xl p-8 w-full max-w-sm" @click.away="closeLogout()">
        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto">
            <i data-lucide="log-out" class="text-red-500 w-8 h-8"></i>
        </div>
        <h2 class="text-2xl font-bold text-center text-slate-800 mt-5">Logout?</h2>
        <p class="text-center text-slate-500 mt-2">Apakah Anda yakin ingin keluar?</p>
        <div class="grid grid-cols-2 gap-4 mt-8">
            <button @click="closeLogout()" class="py-3 rounded-2xl border border-slate-300 font-medium hover:bg-slate-50 transition">Batal</button>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="w-full py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white text-center font-medium transition">Logout</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/pasien-dashboard.js') }}"></script>
@endpush

@endsection