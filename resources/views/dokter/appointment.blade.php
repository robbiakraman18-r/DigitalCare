@extends('layouts.dokter')

@section('title', 'Appointments')

@section('subtitle', 'Today’s and tomorrow’s patient appointments')

@section('content')

<div
x-data="{ detailModal:false }"
class="space-y-6">

    <!-- CARD -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 px-6 py-5 text-white">

            <h2 class="text-2xl font-bold">
                Appointments
            </h2>

            <p class="text-sm text-teal-100 mt-1">
                Patient appointment data.
            </p>

        </div>

        <!-- CONTENT -->
        <div class="p-6">

            <!-- TOP -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

                <!-- SEARCH -->
                <div class="relative w-full lg:w-96">

                    <i data-lucide="search"
                    class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input
                    type="text"
                    placeholder="Search patient name..."
                    class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500">

                </div>

                <!-- FILTER -->
                <div class="flex gap-3">

                    <button class="px-5 py-3 rounded-2xl bg-teal-500 text-white text-sm font-medium">
                        Today
                    </button>

                    <button class="px-5 py-3 rounded-2xl bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition">
                        Tomorrow
                    </button>

                </div>

            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="bg-slate-50 text-slate-500">

                            <th class="text-left py-4 px-4 rounded-l-2xl">
                                Time
                            </th>

                            <th class="text-left py-4 px-4">
                                Patient
                            </th>

                            <th class="text-left py-4 px-4">
                                Complaint
                            </th>

                            <th class="text-left py-4 px-4">
                                Type
                            </th>

                            <th class="text-left py-4 px-4">
                                Status
                            </th>

                            <th class="text-left py-4 px-4 rounded-r-2xl">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y">

                        <!-- ITEM -->
                        <tr>

                            <td class="py-4 px-4">
                                08.00
                            </td>

                            <td class="py-4 px-4 font-medium">
                                Andi Setiawan
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                Fever
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                Consultation
                            </td>

                            <td class="py-4 px-4">

                                <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                    Completed
                                </span>

                            </td>

                            <td class="py-4 px-4">

                                <button
                                @click="detailModal=true"
                                class="px-4 py-2 rounded-xl border border-teal-500 text-teal-500 text-xs hover:bg-teal-50 transition">

                                    Details

                                </button>

                            </td>

                        </tr>

                        <!-- ITEM -->
                        <tr>

                            <td class="py-4 px-4">
                                09.00
                            </td>

                            <td class="py-4 px-4 font-medium">
                                Aris Arya
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                Cough
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                Consultation
                            </td>

                            <td class="py-4 px-4">

                                <span class="px-3 py-1 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                    Waiting
                                </span>

                            </td>

                            <td class="py-4 px-4">

                                <button
                                @click="detailModal=true"
                                class="px-4 py-2 rounded-xl border border-teal-500 text-teal-500 text-xs hover:bg-teal-50 transition">

                                    Details

                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- MODAL DETAIL -->
<div
x-show="detailModal"
x-transition
class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4"
style="display:none;">

    <!-- CARD -->
    <div
    @click.away="detailModal=false"
    class="relative w-full max-w-2xl bg-white rounded-[30px] shadow-2xl overflow-hidden">

        <!-- CLOSE -->
        <button
        @click="detailModal=false"
        class="absolute top-5 right-5 w-10 h-10 rounded-xl bg-white shadow-md hover:bg-slate-100 flex items-center justify-center transition z-20">

            <i data-lucide="x" class="w-5 h-5 text-slate-600"></i>

        </button>

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 p-6 rounded-t-[30px] text-white">

            <h2 class="text-2xl font-bold">
                Appointment Details
            </h2>

            <p class="text-sm text-teal-100 mt-1">
                Complete patient appointment information
            </p>

        </div>

        <!-- BODY -->
        <div class="p-6 space-y-5">

            <!-- PROFILE -->
            <div class="flex items-center gap-4">

                <img
                src="https://i.pravatar.cc/120?img=15"
                class="w-16 h-16 rounded-2xl object-cover border-4 border-teal-100">

                <div>

                    <h3 class="text-xl font-bold text-slate-800">
                        Andi Setiawan
                    </h3>

                    <p class="text-sm text-slate-400">
                        General Consultation Patient
                    </p>

                    <div class="mt-2">

                        <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                            Completed
                        </span>

                    </div>

                </div>

            </div>

            <!-- INFO -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="text-xs text-slate-400">
                        Date
                    </p>

                    <h4 class="font-bold text-slate-800 mt-2">
                        May 20, 2026
                    </h4>

                </div>

                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="text-xs text-slate-400">
                        Practice Time
                    </p>

                    <h4 class="font-bold text-slate-800 mt-2">
                        08:00 AM
                    </h4>

                </div>

                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="text-xs text-slate-400">
                        Examination Type
                    </p>

                    <h4 class="font-bold text-slate-800 mt-2">
                        Consultation
                    </h4>

                </div>

                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="text-xs text-slate-400">
                        Complaint
                    </p>

                    <h4 class="font-bold text-slate-800 mt-2">
                        High Fever
                    </h4>

                </div>

            </div>

            <!-- NOTE -->
            <div class="rounded-2xl border border-slate-100 p-5">

                <h3 class="font-bold text-slate-800 mb-3">
                    Patient Notes
                </h3>

                <p class="text-sm leading-7 text-slate-500">

                    The patient has been experiencing a fever for the past 2 days,
                    accompanied by headaches and body weakness. The patient has taken
                    fever-reducing medication but has not improved yet.

                </p>

            </div>

            <!-- ACTION -->
            <div class="flex gap-3">

                <button
                class="flex-1 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold transition">

                    Start Consultation

                </button>

                <button
                @click="detailModal=false"
                class="flex-1 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 font-semibold text-slate-700 transition">

                    Close

                </button>

            </div>

        </div>

    </div>

</div>

@endsection