@extends('layouts.admin')

@section('title', 'Reports')
@section('subtitle', 'Monitor clinic analytics, appointments, patients and performance.')

@section('content')

<div class="space-y-6">

    <!-- TOP STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- TOTAL APPOINTMENTS -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Total Appointments
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ number_format($totalAppointments) }}
                    </h2>

                    <p class="text-blue-500 text-sm mt-2">
                        {{ $completionRate }}% completed
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i data-lucide="calendar-check-2" class="w-6 h-6 text-blue-600"></i>

                </div>

            </div>

        </div>

        <!-- COMPLETED APPOINTMENTS -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Completed Appointments
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ number_format($completedAppointments) }}
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        {{ $cancellationRate }}% cancelled
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i data-lucide="check-circle-2" class="w-6 h-6 text-green-600"></i>

                </div>

            </div>

        </div>

        <!-- NEW PATIENTS -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        New Patients
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ number_format($newPatientsThisMonth) }}
                    </h2>

                    <p class="text-cyan-500 text-sm mt-2">
                        this month &middot; {{ number_format($totalPatients) }} total
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="users" class="w-6 h-6 text-cyan-600"></i>

                </div>

            </div>

        </div>

        <!-- DOCTORS ACTIVE -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Doctors Active
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $activeDoctors }}
                    </h2>

                    <p class="text-yellow-500 text-sm mt-2">
                        of {{ $totalDoctors }} total
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                    <i data-lucide="stethoscope" class="w-6 h-6 text-yellow-600"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- APPOINTMENTS OVERVIEW -->
        <div class="xl:col-span-2 bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h2 class="text-xl font-bold text-slate-800">
                        Appointments Overview
                    </h2>

                    <p class="text-sm text-slate-400 mt-1">
                        Volume of appointments in the last 6 months
                    </p>

                </div>

                <span class="px-4 py-2 rounded-xl border border-slate-200 text-sm text-slate-500">
                    Monthly
                </span>

            </div>

            <!-- BAR CHART (Tailwind, real data) -->
            <div class="h-[320px] flex items-end gap-4">

                @foreach($months as $month)

                <div class="flex-1 flex flex-col items-center gap-2">

                    <span class="text-xs font-semibold text-slate-600">
                        {{ $month['count'] }}
                    </span>

                    <div class="w-full flex items-end h-[260px]">
                        <div
                            class="w-full bg-blue-500 rounded-t-2xl transition-all"
                            style="height: {{ $month['percentage'] }}%">
                        </div>
                    </div>

                    <span class="text-xs text-slate-400">
                        {{ $month['label'] }}
                    </span>

                </div>

                @endforeach

            </div>

        </div>

        <!-- PERFORMANCE -->
        <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    Performance
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    Overall clinic statistics
                </p>

            </div>

            <div class="space-y-6 mt-8">

                <!-- COMPLETION RATE -->
                <div>

                    <div class="flex items-center justify-between mb-2">

                        <span class="text-sm text-slate-600">
                            Appointment Completion
                        </span>

                        <span class="text-sm font-semibold text-slate-800">
                            {{ $completionRate }}%
                        </span>

                    </div>

                    <div class="h-3 rounded-full bg-slate-100 overflow-hidden">

                        <div class="h-full bg-green-500 rounded-full" style="width: {{ $completionRate }}%"></div>

                    </div>

                </div>

                <!-- DOCTOR AVAILABILITY -->
                <div>

                    <div class="flex items-center justify-between mb-2">

                        <span class="text-sm text-slate-600">
                            Doctor Availability
                        </span>

                        <span class="text-sm font-semibold text-slate-800">
                            {{ $doctorAvailabilityRate }}%
                        </span>

                    </div>

                    <div class="h-3 rounded-full bg-slate-100 overflow-hidden">

                        <div class="h-full bg-blue-500 rounded-full" style="width: {{ $doctorAvailabilityRate }}%"></div>

                    </div>

                </div>

                <!-- CANCELLATION RATE -->
                <div>

                    <div class="flex items-center justify-between mb-2">

                        <span class="text-sm text-slate-600">
                            Cancellation Rate
                        </span>

                        <span class="text-sm font-semibold text-slate-800">
                            {{ $cancellationRate }}%
                        </span>

                    </div>

                    <div class="h-3 rounded-full bg-slate-100 overflow-hidden">

                        <div class="h-full bg-yellow-500 rounded-full" style="width: {{ $cancellationRate }}%"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- TOP -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-6 border-b border-slate-100">

            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    Available Reports
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    Generate and download clinic reports
                </p>

            </div>

            <a
                href="{{ route('admin.reports.summary.pdf') }}"
                class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition inline-flex items-center gap-2">

                <i data-lucide="file-down" class="w-4 h-4"></i>
                Generate Summary Report

            </a>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[700px]">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Report Name
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Category
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Records
                        </th>

                        <th class="px-6 py-4 text-center text-sm text-slate-400 font-semibold">
                            Export
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($reports as $report)

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-2xl flex items-center justify-center {{ $report['bgClass'] }}">

                                    <i data-lucide="{{ $report['icon'] }}" class="w-5 h-5 {{ $report['textClass'] }}"></i>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-slate-800">
                                        {{ $report['name'] }}
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        Clinic Report
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ $report['category'] }}
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ number_format($report['total']) }}
                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <a
                                    href="{{ route('admin.reports.pdf', $report['key']) }}"
                                    class="px-3 py-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold flex items-center gap-1.5 transition">

                                    <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                                    PDF

                                </a>

                                <a
                                    href="{{ route('admin.reports.excel', $report['key']) }}"
                                    class="px-3 py-2 rounded-xl bg-green-50 hover:bg-green-100 text-green-600 text-xs font-semibold flex items-center gap-1.5 transition">

                                    <i data-lucide="sheet" class="w-3.5 h-3.5"></i>
                                    Excel

                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection