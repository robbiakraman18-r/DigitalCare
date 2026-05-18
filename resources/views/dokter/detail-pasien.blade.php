@extends('layouts.dokter')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Detail Pasien
            </h1>

            <p class="text-slate-400 mt-1">
                Informasi lengkap pasien konsultasi.
            </p>

        </div>

        <a
        href="/dokter-pasien"
        class="px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 font-semibold transition">

            Kembali

        </a>

    </div>

    <!-- PROFILE -->
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-8">

        <div class="flex flex-col lg:flex-row lg:items-center gap-6">

            <img
            src="https://i.pravatar.cc/150?img=12"
            class="w-28 h-28 rounded-3xl object-cover">

            <div class="flex-1">

                <h2 class="text-3xl font-bold text-slate-800">
                    Ahmad Fauzi
                </h2>

                <p class="text-slate-400 mt-1">
                    ahmad@email.com
                </p>

                <div class="flex flex-wrap gap-3 mt-5">

                    <span class="px-4 py-2 rounded-xl bg-teal-100 text-teal-600 text-sm font-semibold">
                        Pasien Aktif
                    </span>

                    <span class="px-4 py-2 rounded-xl bg-cyan-100 text-cyan-600 text-sm font-semibold">
                        Konsultasi Hari Ini
                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- DETAIL -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- BIODATA -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-7">

            <h2 class="text-xl font-bold text-slate-800 mb-6">
                Biodata Pasien
            </h2>

            <div class="space-y-5">

                <div class="flex justify-between">
                    <span class="text-slate-400">Nama Lengkap</span>
                    <span class="font-semibold text-slate-700">Ahmad Fauzi</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Umur</span>
                    <span class="font-semibold text-slate-700">21 Tahun</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Jenis Kelamin</span>
                    <span class="font-semibold text-slate-700">Laki-laki</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">No Telepon</span>
                    <span class="font-semibold text-slate-700">0812-3456-7890</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Alamat</span>
                    <span class="font-semibold text-slate-700 text-right">
                        Batam Center
                    </span>
                </div>

            </div>

        </div>

        <!-- KONSULTASI -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-7">

            <h2 class="text-xl font-bold text-slate-800 mb-6">
                Detail Konsultasi
            </h2>

            <div class="space-y-5">

                <div class="flex justify-between">
                    <span class="text-slate-400">Tanggal</span>
                    <span class="font-semibold text-slate-700">20 Mei 2026</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Jam</span>
                    <span class="font-semibold text-slate-700">08:00 WIB</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Keluhan</span>
                    <span class="font-semibold text-slate-700">Demam & Batuk</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Status</span>
                    <span class="font-semibold text-green-600">Selesai</span>
                </div>

                <div class="pt-4 border-t">

                    <p class="text-slate-400 text-sm mb-2">
                        Catatan Dokter
                    </p>

                    <p class="text-slate-700 leading-relaxed">
                        Pasien mengalami gejala flu ringan dan disarankan istirahat cukup serta konsumsi obat sesuai resep.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection