@extends('layouts.pasien')
@section('content')

<div class="bg-white/90 backdrop-blur-xl rounded-[30px] shadow-xl border border-white p-6">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-6">

        <!-- TITLE -->
        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                Medical History List
            </h2>

            <p class="text-slate-400 text-sm mt-1">
                View your past consultations and medical records
            </p>

        </div>

        <!-- SEARCH -->
        <div class="flex items-center gap-3">

            <!-- SEARCH -->
            <div class="relative">

                <input
                    type="text"
                    placeholder="Cari riwayat..."
                    class="w-[230px] pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm">

                <i
                    data-lucide="search"
                    class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                </i>

            </div>

            <!-- FILTER -->
            <button
                class="flex items-center gap-2 px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 transition text-sm font-medium text-slate-700">

                <i data-lucide="sliders-horizontal" class="w-4 h-4"></i>

                Filter

            </button>

        </div>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-3xl border border-slate-100">

        <table class="w-full text-sm">

            <!-- HEAD -->
            <thead class="bg-slate-50 text-slate-500">

                <tr>

                    <th class="px-6 py-4 text-left font-semibold">
                        Visit Date
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Doctor
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Main Complaint
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Diagnosis
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center font-semibold">
                        Detail
                    </th>

                </tr>

            </thead>

            <!-- BODY -->
            <tbody class="divide-y divide-slate-100">

                <!-- ROW -->
                <tr class="hover:bg-slate-50 transition">

                    <td class="px-6 py-5 text-slate-600">
                        26 Mei 2026
                    </td>

                    <td class="px-6 py-5 font-medium text-slate-700">
                        dr. Andi Pratama
                    </td>

                    <td class="px-6 py-5 text-slate-600">
                        Sakit kepala, demam
                    </td>

                    <td class="px-6 py-5 text-slate-600">
                        N/A
                    </td>

                    <td class="px-6 py-5">

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-500 text-xs font-semibold">
                            On Going
                        </span>

                    </td>

                    <td class="px-6 py-5 text-center">

                        <a href="/detail-rekam-medis"
                        class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-teal-100 hover:text-teal-500 transition inline-flex items-center justify-center">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                    </a>

                    </td>

                </tr>

                <!-- ROW -->
                <tr class="hover:bg-slate-50 transition">

                    <td class="px-6 py-5 text-slate-600">
                        20 Mar 2026
                    </td>

                    <td class="px-6 py-5 font-medium text-slate-700">
                        dr. Andi Pratama
                    </td>

                    <td class="px-6 py-5 text-slate-600">
                        Batuk, pilek
                    </td>

                    <td class="px-6 py-5 text-slate-600">
                        ISPA
                    </td>

                    <td class="px-6 py-5">

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-500 text-xs font-semibold">
                            Done
                        </span>

                    </td>

                    <td class="px-6 py-5 text-center">

                        <a href="/detail-rekam-medis"
                        class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-teal-100 hover:text-teal-500 transition inline-flex items-center justify-center">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                    </a>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection