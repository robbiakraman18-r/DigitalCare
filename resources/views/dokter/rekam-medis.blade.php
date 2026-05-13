@extends('layouts.dokter')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Rekam Medis
            </h1>

            <p class="text-slate-400 mt-1">
                Riwayat pemeriksaan dan tindakan pasien.
            </p>

        </div>

        <a
        href="/dokter-pasien"
        class="px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 font-semibold transition">

            Kembali

        </a>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-7">

        <div class="flex items-center gap-5 pb-6 border-b">

            <img
            src="https://i.pravatar.cc/120?img=12"
            class="w-20 h-20 rounded-3xl object-cover">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Ahmad Fauzi
                </h2>

                <p class="text-slate-400 mt-1">
                    Riwayat Konsultasi Pasien
                </p>

            </div>

        </div>

        <!-- HISTORY -->
        <div class="mt-7 space-y-5">

            <!-- ITEM -->
            <div class="rounded-3xl border border-slate-100 p-5 bg-slate-50">

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-bold text-slate-800">
                            Pemeriksaan Umum
                        </h3>

                        <p class="text-sm text-slate-400 mt-1">
                            20 Mei 2026 • 08:00 WIB
                        </p>

                    </div>

                    <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                        Selesai
                    </span>

                </div>

                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <p class="text-sm text-slate-400 mb-2">
                            Keluhan
                        </p>

                        <p class="font-medium text-slate-700">
                            Demam & Batuk
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-400 mb-2">
                            Diagnosa
                        </p>

                        <p class="font-medium text-slate-700">
                            Flu Ringan
                        </p>

                    </div>

                </div>

                <div class="mt-5">

                    <p class="text-sm text-slate-400 mb-2">
                        Catatan Dokter
                    </p>

                    <p class="text-slate-700 leading-relaxed">
                        Pasien disarankan istirahat cukup, minum air hangat, dan konsumsi obat rutin selama 3 hari.
                    </p>

                </div>

            </div>

            <!-- ITEM -->
            <div class="rounded-3xl border border-slate-100 p-5 bg-slate-50">

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-bold text-slate-800">
                            Konsultasi Lanjutan
                        </h3>

                        <p class="text-sm text-slate-400 mt-1">
                            18 Mei 2026 • 10:00 WIB
                        </p>

                    </div>

                    <span class="px-4 py-2 rounded-xl bg-cyan-100 text-cyan-600 text-xs font-semibold">
                        Follow Up
                    </span>

                </div>

                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <p class="text-sm text-slate-400 mb-2">
                            Keluhan
                        </p>

                        <p class="font-medium text-slate-700">
                            Sakit Tenggorokan
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-400 mb-2">
                            Diagnosa
                        </p>

                        <p class="font-medium text-slate-700">
                            Iritasi Tenggorokan
                        </p>

                    </div>

                </div>

                <div class="mt-5">

                    <p class="text-sm text-slate-400 mb-2">
                        Catatan Dokter
                    </p>

                    <p class="text-slate-700 leading-relaxed">
                        Disarankan mengurangi minuman dingin dan memperbanyak istirahat.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection