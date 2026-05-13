@extends('layouts.dokter')

@section('content')

<div
x-data="{
    detailModal:false,
    selectedDay:'Senin'
}"
class="space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Data Pasien
            </h1>

            <p class="text-slate-400 mt-1">
                Data pasien konsultasi minggu ini.
            </p>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-5">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <!-- LEFT -->
            <div>

                <h2 class="text-lg font-bold text-slate-800">
                    Filter Hari Konsultasi
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    Pilih hari untuk melihat data pasien.
                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">

                <!-- SEARCH -->
                <div class="relative w-full sm:w-80">

                    <i data-lucide="search"
                    class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                    <input
                    type="text"
                    placeholder="            Cari nama pasien..."
                    class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition">

                </div>

                <!-- FILTER HARI -->
                <select
                x-model="selectedDay"
                class="px-5 py-3 rounded-2xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:outline-none focus:ring-2 focus:ring-teal-500">

                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                    <option>Sabtu</option>
                    <option>Minggu</option>

                </select>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- TOP -->
        <div class="px-6 py-5 border-b border-slate-100">

            <h2 class="text-xl font-bold text-slate-800">
                List Pasien
            </h2>

            <p class="text-sm text-slate-400 mt-1">

                Menampilkan data hari:
                <span
                class="font-semibold text-teal-500"
                x-text="selectedDay"></span>

            </p>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="text-left px-6 py-4 text-sm text-slate-400 font-semibold">
                            Pasien
                        </th>

                        <th class="text-left px-6 py-4 text-sm text-slate-400 font-semibold">
                            Umur
                        </th>

                        <th class="text-left px-6 py-4 text-sm text-slate-400 font-semibold">
                            Keluhan
                        </th>

                        <th class="text-left px-6 py-4 text-sm text-slate-400 font-semibold">
                            Jam
                        </th>

                        <th class="text-left px-6 py-4 text-sm text-slate-400 font-semibold">
                            Status
                        </th>

                        <th class="text-center px-6 py-4 text-sm text-slate-400 font-semibold">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <!-- ROW -->
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img
                                src="https://i.pravatar.cc/100?img=12"
                                class="w-12 h-12 rounded-2xl object-cover">

                                <div>

                                    <h3 class="font-semibold text-slate-800">
                                        Ahmad Fauzi
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        ahmad@email.com
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            21 Tahun
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            Demam & Batuk
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            08:00 WIB
                        </td>

                        <td class="px-6 py-5">

                            <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                Selesai
                            </span>

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <!-- DETAIL -->
                                <a
        href="/dokter/detail-pasien"
        class="px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-700 text-sm font-semibold transition inline-flex items-center gap-2">

            <i data-lucide="eye" class="w-4 h-4"></i>

            Detail

        </a>


                                <!-- REKAM MEDIS -->
                                <a
                                href="/dokter/rekam-medis"
                                class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-100 text-sm font-semibold transition inline-flex items-center">

                                    Rekam Medis

                                </a>

                            </div>

                        </td>

                    </tr>

                    <!-- ROW -->
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img
                                src="https://i.pravatar.cc/100?img=15"
                                class="w-12 h-12 rounded-2xl object-cover">

                                <div>

                                    <h3 class="font-semibold text-slate-800">
                                        Budi Santoso
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        budi@email.com
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            32 Tahun
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            Sakit Kepala
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            10:00 WIB
                        </td>

                        <td class="px-6 py-5">

                            <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                Menunggu
                            </span>

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <!-- DETAIL -->
                                <a
        href="/dokter/detail-pasien"
        class="px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-700 text-sm font-semibold transition inline-flex items-center gap-2">

            <i data-lucide="eye" class="w-4 h-4"></i>

            Detail

        </a>


                                <!-- REKAM MEDIS -->
                                <a
                                href="/dokter/rekam-medis"
                                class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-100 text-sm font-semibold transition inline-flex items-center">

                                    Rekam Medis

                                </a>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection