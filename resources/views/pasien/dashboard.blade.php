@extends('layouts.pasien')

@section('content')
@section('title', 'Halo, Rizki 👋')
@section('subtitle', 'Selamat datang kembali di DigitalCare')

<div class="space-y-8">
    <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-teal-500 to-cyan-500 p-8 lg:p-10 shadow-xl shadow-teal-100">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-lg border border-white/20 text-white text-xs mb-4">
                    <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                    Layanan Kesehatan Smart Campus Aktif
                </div>
                <h1 class="text-3xl lg:text-4xl font-extrabold text-white leading-tight">
                    Welcome Back, Rizki!
                </h1>
                <p class="text-white/90 mt-2 text-sm leading-relaxed max-w-xl">
                    No. Rekam Medis (NIM/MRN): <span class="font-bold underline">123456</span> | Selalu pantau kondisi fisik Anda di sela-sela kesibukan akademik.
                </p>
            </div>
            <div class="flex gap-3 shrink-0">
                <a href="/buat-janji" class="px-5 py-3 rounded-2xl bg-white text-teal-600 font-semibold shadow-md hover:bg-teal-50 transition text-sm">
                    Buat Janji Temu
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Janji Temu Terdekat</h3>
                        <div class="p-4 rounded-2xl bg-teal-50/50 border border-teal-100 flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-teal-500 flex items-center justify-center text-white text-xl shrink-0">
                                👨‍⚕️
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">Dr. Andi</h4>
                                <p class="text-xs text-teal-600 font-medium">Dokter Umum Kampus</p>
                                <p class="text-xs text-slate-500 mt-2 font-semibold">Senin, 25 Mei | 09:30 WIB</p>
                            </div>
                        </div>
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

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Tanda Vital Terakhir</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 bg-slate-50 rounded-2xl text-center">
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Tekanan Darah</span>
                            <span class="text-lg font-bold text-slate-800 block mt-1">120/80</span>
                            <span class="text-[10px] text-slate-400">mmHg</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-2xl text-center">
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Detak Jantung</span>
                            <span class="text-lg font-bold text-slate-800 block mt-1">76</span>
                            <span class="text-[10px] text-slate-400">bpm</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-2xl text-center">
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Berat Badan</span>
                            <span class="text-lg font-bold text-slate-800 block mt-1">58.2</span>
                            <span class="text-[10px] text-slate-400">kg</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-2xl text-center">
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Suhu Tubuh</span>
                            <span class="text-lg font-bold text-slate-800 block mt-1">36.8</span>
                            <span class="text-[10px] text-slate-400">°C</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider">Konsumsi Obat Aktif</h3>
                    <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 text-[11px] font-semibold">Dalam Masa Penyembuhan</span>
                </div>
                
                <div class="divide-y divide-slate-100">
                    <div class="flex items-center justify-between py-3 first:pt-0 last:pb-0">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-cyan-50 flex items-center justify-center text-cyan-600 text-sm font-bold">💊</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">Amoxicillin 500mg</h4>
                                <p class="text-xs text-slate-400">3x Sehari (Setelah makan) — Habiskan</p>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-slate-600">Jam 08:00 | 14:00 | 20:00</span>
                    </div>
                    <div class="flex items-center justify-between py-3 last:pb-0">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-cyan-50 flex items-center justify-center text-cyan-600 text-sm font-bold">💊</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">Paracetamol 500mg</h4>
                                <p class="text-xs text-slate-400">Bila demam atau pusing saja</p>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-slate-600">Sesuai Kebutuhan</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="space-y-6">
            
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Akses Cepat</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="/buat-janji" class="p-4 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-10 h-10 mx-auto rounded-xl bg-teal-50 text-teal-500 flex items-center justify-center mb-2 group-hover:bg-teal-500 group-hover:text-white transition">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">Daftar Periksa</span>
                    </a>
                    
                    <a href="/rekam-medis" class="p-4 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-10 h-10 mx-auto rounded-xl bg-green-50 text-green-500 flex items-center justify-center mb-2 group-hover:bg-green-500 group-hover:text-white transition">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">Riwayat Medis</span>
                    </a>

                    <a href="/resep-obat" class="p-4 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-10 h-10 mx-auto rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center mb-2 group-hover:bg-amber-500 group-hover:text-white transition">
                            <i data-lucide="pill" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">E-Resep</span>
                    </a>

                    <a href="/bantuan" class="p-4 rounded-2xl border border-slate-100 hover:border-teal-500 hover:bg-teal-50/20 transition group text-center">
                        <div class="w-10 h-10 mx-auto rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-2 group-hover:bg-indigo-500 group-hover:text-white transition">
                            <i data-lucide="phone-call" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 block">Info Darurat</span>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-5 shadow-sm border border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-500 flex items-center justify-center">
                        <i data-lucide="activity" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-800">5 Kali</h4>
                        <p class="text-xs text-slate-400">Total Kunjungan Klinik</p>
                    </div>
                </div>
                <a href="/rekam-medis" class="text-xs text-teal-600 font-semibold hover:underline">Lihat Semua</a>
            </div>

        </div>

    </div>
</div>

<div x-show="logoutModal" x-transition class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50" style="display:none;">
    <div class="bg-white rounded-3xl p-8 w-full max-w-sm">
        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto">
            <i data-lucide="log-out" class="text-red-500"></i>
        </div>
        <h2 class="text-2xl font-bold text-center text-slate-800 mt-5">Logout?</h2>
        <p class="text-center text-slate-500 mt-2">Apakah Anda yakin ingin keluar?</p>
        <div class="grid grid-cols-2 gap-4 mt-8">
            <button @click="logoutModal = false" class="py-3 rounded-2xl border border-slate-300 font-medium hover:bg-slate-50 transition">Batal</button>
            <a href="/login" class="py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white text-center font-medium transition">Logout</a>
        </div>
    </div>
</div>

@endsection