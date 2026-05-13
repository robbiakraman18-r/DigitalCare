@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- TOP -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Appointments
            </h1>

            <p class="text-slate-400 mt-1">
                View and manage patient appointments.
            </p>

        </div>

        <div class="flex items-center gap-3">

            <button
            class="px-5 py-3 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition">

                Export

            </button>

            <button
            class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                + New Appointment

            </button>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- FILTER -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-5 border-b border-slate-100">

            <div class="relative w-full lg:w-96">

                <i data-lucide="search"
                class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                <input
                type="text"
                placeholder="Search appointments..."
                class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>

            <div class="flex items-center gap-3 flex-wrap">

                <select class="px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 text-slate-700">

                    <option>All Doctors</option>

                </select>

                <select class="px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 text-slate-700">

                    <option>All Status</option>

                </select>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Appointment ID
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Date & Time
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Patient
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Doctor
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Department
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Type
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-sm text-slate-400">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-5 font-medium text-slate-700">
                            APT-000124
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            May 14, 2025 <br>
                            08:00 PM
                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <img src="https://i.pravatar.cc/100?img=15"
                                class="w-10 h-10 rounded-xl object-cover">

                                <div>

                                    <h3 class="font-semibold text-slate-800">
                                        John Smith
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        PT-00235
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            Dr. Emily Carter
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            Cardiology
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            Consultation
                        </td>

                        <td class="px-6 py-5">

                            <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                Confirmed
                            </span>

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <button class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-100">

                                    <i data-lucide="eye" class="w-4 h-4"></i>

                                </button>

                                <button class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-100">

                                    <i data-lucide="square-pen" class="w-4 h-4"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection