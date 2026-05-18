@extends('layouts.admin')

@php
    $title = 'Dashboard Admin';
    $subtitle = 'Pantau seluruh aktivitas klinik hari ini';
@endphp

@section('content')

<div class="space-y-6">

    <!-- HERO -->
    <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-teal-500 to-cyan-500 p-7 text-white shadow-xl">

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <!-- LEFT -->
            <div>

                <h1 class="text-3xl font-bold leading-tight">
                    Selamat Datang Admin 👋
                </h1>

                <p class="mt-3 text-teal-100 text-sm max-w-xl">
                    Kelola data dokter, pasien, appointment, jadwal praktik dan seluruh aktivitas klinik dengan mudah.
                </p>

                <div class="flex flex-wrap gap-3 mt-6">

                    <a href="/admin-user-management"
                    class="px-5 py-3 rounded-2xl bg-white text-teal-600 font-semibold hover:scale-105 transition">

                        Data Dokter

                    </a>

                    <a href="/admin-user-management"
                    class="px-5 py-3 rounded-2xl border border-white/30 hover:bg-white/10 transition">

                        Data Pasien

                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="grid grid-cols-2 gap-4">

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 min-w-[140px]">

                    <p class="text-sm text-teal-100">
                        Dokter Aktif
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        12
                    </h2>

                </div>

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 min-w-[140px]">

                    <p class="text-sm text-teal-100">
                        Pasien Hari Ini
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        48
                    </h2>

                </div>

            </div>

        </div>

        <!-- BLUR -->
        <div class="absolute -top-10 -right-10 w-52 h-52 rounded-full bg-white/10"></div>

        <div class="absolute bottom-0 right-20 w-32 h-32 rounded-full bg-white/10"></div>

    </div>

    <!-- STATISTIC -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- CARD -->
        <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Total Dokter
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        18
                    </h2>

                    <p class="text-sm text-green-500 mt-2">
                        +2 minggu ini
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="stethoscope" class="w-7 h-7 text-cyan-500"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Total Pasien
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        320
                    </h2>

                    <p class="text-sm text-teal-500 mt-2">
                        Data aktif
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-teal-100 flex items-center justify-center">

                    <i data-lucide="users" class="w-7 h-7 text-teal-500"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Appointment
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        24
                    </h2>

                    <p class="text-sm text-yellow-500 mt-2">
                        8 menunggu
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                    <i data-lucide="clipboard-list" class="w-7 h-7 text-yellow-500"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Pendapatan
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        12JT
                    </h2>

                    <p class="text-sm text-cyan-500 mt-2">
                        Bulan ini
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="wallet" class="w-7 h-7 text-cyan-500"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="xl:col-span-2 space-y-6">

            <!-- APPOINTMENT -->
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-6">

                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">
                            Appointment Hari Ini
                        </h2>

                        <p class="text-sm text-slate-400 mt-1">
                            Data appointment terbaru klinik
                        </p>

                    </div>

                    <a href="/admin-appointment"
                    class="px-4 py-2 rounded-2xl bg-teal-50 text-teal-500 font-medium hover:bg-teal-100 transition">

                        Lihat Semua

                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-slate-100">

                                <th class="text-left py-4 text-sm text-slate-400">
                                    Pasien
                                </th>

                                <th class="text-left py-4 text-sm text-slate-400">
                                    Dokter
                                </th>

                                <th class="text-left py-4 text-sm text-slate-400">
                                    Jam
                                </th>

                                <th class="text-left py-4 text-sm text-slate-400">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr class="border-b border-slate-100">

                                <td class="py-4 font-semibold text-slate-700">
                                    Ahmad Fauzi
                                </td>

                                <td class="py-4 text-slate-500">
                                    Dr. Rizki
                                </td>

                                <td class="py-4 text-slate-500">
                                    09:00 WIB
                                </td>

                                <td class="py-4">

                                    <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                        Selesai
                                    </span>

                                </td>

                            </tr>

                            <tr>

                                <td class="py-4 font-semibold text-slate-700">
                                    Budi Santoso
                                </td>

                                <td class="py-4 text-slate-500">
                                    Dr. Andi
                                </td>

                                <td class="py-4 text-slate-500">
                                    11:00 WIB
                                </td>

                                <td class="py-4">

                                    <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                        Menunggu
                                    </span>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- DOKTER -->
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-6">

                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">
                            Dokter Aktif
                        </h2>

                        <p class="text-sm text-slate-400 mt-1">
                            Dokter yang sedang praktik hari ini
                        </p>

                    </div>

                </div>

                <div class="grid sm:grid-cols-2 gap-4">

                    <!-- ITEM -->
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50">

                        <img
                        src="https://i.pravatar.cc/100?img=12"
                        class="w-14 h-14 rounded-2xl object-cover">

                        <div>

                            <h3 class="font-bold text-slate-800">
                                Dr. Rizki
                            </h3>

                            <p class="text-sm text-slate-400">
                                Dokter Umum
                            </p>

                            <span class="inline-flex mt-2 px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                Online
                            </span>

                        </div>

                    </div>

                    <!-- ITEM -->
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50">

                        <img
                        src="https://i.pravatar.cc/100?img=15"
                        class="w-14 h-14 rounded-2xl object-cover">

                        <div>

                            <h3 class="font-bold text-slate-800">
                                Dr. Andi
                            </h3>

                            <p class="text-sm text-slate-400">
                                Dokter Anak
                            </p>

                            <span class="inline-flex mt-2 px-3 py-1 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                Praktik
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-6">

            <!-- STATUS -->
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-6">

                <h2 class="text-xl font-bold text-slate-800">
                    Status Klinik
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    Aktivitas sistem hari ini
                </p>

                <div class="space-y-5 mt-6">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="w-11 h-11 rounded-2xl bg-teal-100 flex items-center justify-center">

                                <i data-lucide="activity" class="w-5 h-5 text-teal-500"></i>

                            </div>

                            <div>

                                <h3 class="font-semibold text-slate-800">
                                    Sistem Klinik
                                </h3>

                                <p class="text-xs text-slate-400">
                                    Berjalan normal
                                </p>

                            </div>

                        </div>

                        <span class="w-3 h-3 rounded-full bg-green-500"></span>

                    </div>

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="w-11 h-11 rounded-2xl bg-cyan-100 flex items-center justify-center">

                                <i data-lucide="database" class="w-5 h-5 text-cyan-500"></i>

                            </div>

                            <div>

                                <h3 class="font-semibold text-slate-800">
                                    Database
                                </h3>

                                <p class="text-xs text-slate-400">
                                    Aman & stabil
                                </p>

                            </div>

                        </div>

                        <span class="w-3 h-3 rounded-full bg-green-500"></span>

                    </div>

                </div>

            </div>

            <!-- INFO -->
            <div class="bg-gradient-to-br from-teal-500 to-cyan-500 rounded-[32px] p-6 text-white shadow-xl">

                <h2 class="text-xl font-bold">
                    Informasi Klinik
                </h2>

                <p class="text-sm text-teal-100 mt-2 leading-relaxed">
                    Total 48 pasien melakukan konsultasi hari ini dan 12 appointment masih menunggu.
                </p>

                <div class="space-y-4 mt-6">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-2xl bg-white/20 flex items-center justify-center">

                            <i data-lucide="clock-3" class="w-5 h-5"></i>

                        </div>

                        <div>

                            <p class="text-sm text-teal-100">
                                Jam Operasional
                            </p>

                            <h3 class="font-semibold">
                                08:00 - 21:00 WIB
                            </h3>

                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-2xl bg-white/20 flex items-center justify-center">

                            <i data-lucide="map-pin" class="w-5 h-5"></i>

                        </div>

                        <div>

                            <p class="text-sm text-teal-100">
                                Lokasi
                            </p>

                            <h3 class="font-semibold">
                                Batam Center
                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection