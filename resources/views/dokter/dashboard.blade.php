@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')
@section('subtitle', 'Pantau aktivitas praktik hari ini')

@section('content')

<div class="space-y-5">

    <!-- HERO -->
    <div class="relative overflow-hidden rounded-[30px] bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-white shadow-lg">

        <div class="relative z-10">

            <h1 class="text-2xl lg:text-3xl font-bold leading-tight">
                Selamat Datang Dr. Rizki 👋
            </h1>

            <p class="mt-2 text-teal-100 text-sm">
                Anda memiliki 12 jadwal konsultasi hari ini.
            </p>

            <div class="mt-5 flex gap-3">

                <a href="/jadwal-praktik"
                class="px-4 py-2 rounded-2xl bg-white text-teal-600 text-sm font-semibold hover:scale-105 transition">

                    Lihat Jadwal

                </a>

                <a href="/dokter-pasien"
                class="px-4 py-2 rounded-2xl border border-white/30 hover:bg-white/10 text-sm transition">

                    Data Pasien

                </a>

            </div>

        </div>

        <!-- BLUR -->
        <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white/10"></div>

    </div>

    <!-- STATISTIC -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <!-- CARD -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs text-slate-400">
                        Total Pasien
                    </p>

                    <h2 class="text-2xl font-bold mt-1 text-slate-800">
                        120
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-teal-100 flex items-center justify-center">

                    <i data-lucide="users" class="w-5 h-5 text-teal-500"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs text-slate-400">
                        Appointment
                    </p>

                    <h2 class="text-2xl font-bold mt-1 text-slate-800">
                        12
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="calendar-days" class="w-5 h-5 text-cyan-500"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs text-slate-400">
                        Rekam Medis
                    </p>

                    <h2 class="text-2xl font-bold mt-1 text-slate-800">
                        89
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-red-100 flex items-center justify-center">

                    <i data-lucide="file-heart" class="w-5 h-5 text-red-500"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs text-slate-400">
                        Jadwal Hari Ini
                    </p>

                    <h2 class="text-2xl font-bold mt-1 text-slate-800">
                        6
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-yellow-100 flex items-center justify-center">

                    <i data-lucide="clock-3" class="w-5 h-5 text-yellow-500"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

        <!-- LEFT -->
        <div class="xl:col-span-2 space-y-4">

            <!-- JADWAL -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">

                <div class="flex justify-between items-center mb-4">

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            Jadwal Praktik
                        </h2>

                        <p class="text-xs text-slate-400 mt-1">
                            Jadwal konsultasi hari ini
                        </p>

                    </div>

                    <a href="/jadwal-praktik"
                    class="px-3 py-2 rounded-xl bg-teal-50 text-teal-500 text-sm font-medium hover:bg-teal-100 transition">

                        Lihat Semua

                    </a>

                </div>

                <div class="space-y-3">

                    <!-- ITEM -->
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-teal-100 flex items-center justify-center font-bold text-sm text-teal-600">
                                08:00
                            </div>

                            <div>

                                <h3 class="font-semibold text-sm text-slate-800">
                                    Ahmad Fauzi
                                </h3>

                                <p class="text-xs text-slate-400">
                                    Demam & Batuk
                                </p>

                            </div>

                        </div>

                        <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                            Selesai
                        </span>

                    </div>

                    <!-- ITEM -->
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-cyan-100 flex items-center justify-center font-bold text-sm text-cyan-600">
                                09:00
                            </div>

                            <div>

                                <h3 class="font-semibold text-sm text-slate-800">
                                    Budi Santoso
                                </h3>

                                <p class="text-xs text-slate-400">
                                    Sakit Kepala
                                </p>

                            </div>

                        </div>

                        <span class="px-3 py-1 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                            Menunggu
                        </span>

                    </div>

                </div>

            </div>

            <!-- APPOINTMENT -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">

                <div class="flex justify-between items-center mb-4">

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            Appointment
                        </h2>

                        <p class="text-xs text-slate-400 mt-1">
                            Appointment terbaru pasien
                        </p>

                    </div>

                    <a href="/appointment"
                    class="text-sm text-teal-500 font-medium">

                        Lihat Semua

                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b">

                                <th class="text-left py-3 text-xs text-slate-400">
                                    Nama
                                </th>

                                <th class="text-left py-3 text-xs text-slate-400">
                                    Jam
                                </th>

                                <th class="text-left py-3 text-xs text-slate-400">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr class="border-b">

                                <td class="py-3 text-sm font-medium">
                                    Rizky
                                </td>

                                <td class="py-3 text-sm">
                                    11:00 WIB
                                </td>

                                <td class="py-3">

                                    <span class="px-3 py-1 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                        Menunggu
                                    </span>

                                </td>

                            </tr>

                            <tr>

                                <td class="py-3 text-sm font-medium">
                                    Andi
                                </td>

                                <td class="py-3 text-sm">
                                    13:00 WIB
                                </td>

                                <td class="py-3">

                                    <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                        Selesai
                                    </span>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-4">

            <!-- CHART -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">

                <div>

                    <h2 class="text-lg font-bold text-slate-800">
                        Statistik
                    </h2>

                    <p class="text-xs text-slate-400 mt-1">
                        Status konsultasi
                    </p>

                </div>

                <div class="mt-4 h-[220px]">

                    <canvas id="dokterChart"></canvas>

                </div>

            </div>

            <!-- INFO -->
            <div class="bg-gradient-to-br from-teal-500 to-cyan-500 rounded-2xl p-5 text-white shadow-lg">

                <h2 class="text-lg font-bold">
                    Informasi Klinik
                </h2>

                <p class="text-sm text-teal-100 mt-2">
                    Klinik buka hingga pukul 21:00 WIB.
                </p>

                <div class="mt-5 space-y-3">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">

                            <i data-lucide="phone" class="w-5 h-5"></i>

                        </div>

                        <div>

                            <p class="text-xs text-teal-100">
                                Kontak
                            </p>

                            <h3 class="font-semibold text-sm">
                                +62 812-3456
                            </h3>

                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">

                            <i data-lucide="map-pin" class="w-5 h-5"></i>

                        </div>

                        <div>

                            <p class="text-xs text-teal-100">
                                Lokasi
                            </p>

                            <h3 class="font-semibold text-sm">
                                Batam Center
                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('dokterChart');

new Chart(ctx, {

    type: 'doughnut',

    data: {

        labels: ['Selesai', 'Menunggu', 'Batal'],

        datasets: [{

            data: [12, 5, 2],

            backgroundColor: [
                '#14b8a6',
                '#facc15',
                '#f87171'
            ],

            borderWidth: 0

        }]

    },

    options: {

        cutout: '72%',

        plugins: {

            legend: {
                position: 'bottom'
            }

        },

        maintainAspectRatio: false

    }

});

</script>

@endsection