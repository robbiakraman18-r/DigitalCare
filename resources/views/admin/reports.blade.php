@extends('layouts.admin')

@section('title', 'Reports')
@section('subtitle', 'Monitor clinic analytics, revenue, patients and performance.')

@section('content')

<div class="space-y-6">

    <!-- TOP STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Total Revenue
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        $48,250
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        +12% this month
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i data-lucide="wallet" class="w-6 h-6 text-green-600"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Appointments
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        1,245
                    </h2>

                    <p class="text-blue-500 text-sm mt-2">
                        +8% this month
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i data-lucide="calendar-check-2" class="w-6 h-6 text-blue-600"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        New Patients
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        356
                    </h2>

                    <p class="text-cyan-500 text-sm mt-2">
                        +15% this month
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="users" class="w-6 h-6 text-cyan-600"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Doctors Active
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        24
                    </h2>

                    <p class="text-yellow-500 text-sm mt-2">
                        2 on leave
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

        <!-- REVENUE -->
        <div class="xl:col-span-2 bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h2 class="text-xl font-bold text-slate-800">
                        Revenue Overview
                    </h2>

                    <p class="text-sm text-slate-400 mt-1">
                        Clinic income performance this month
                    </p>

                </div>

                <button class="px-4 py-2 rounded-xl border border-slate-200 text-sm hover:bg-slate-50">
                    Monthly
                </button>

            </div>

            <!-- FAKE CHART -->
            <div class="h-[320px] flex items-end gap-4">

                <div class="flex-1 bg-blue-100 rounded-t-3xl h-[40%]"></div>
                <div class="flex-1 bg-blue-200 rounded-t-3xl h-[55%]"></div>
                <div class="flex-1 bg-blue-300 rounded-t-3xl h-[70%]"></div>
                <div class="flex-1 bg-blue-400 rounded-t-3xl h-[90%]"></div>
                <div class="flex-1 bg-blue-500 rounded-t-3xl h-[80%]"></div>
                <div class="flex-1 bg-blue-600 rounded-t-3xl h-[100%]"></div>
                <div class="flex-1 bg-blue-400 rounded-t-3xl h-[75%]"></div>

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

                <!-- ITEM -->
                <div>

                    <div class="flex items-center justify-between mb-2">

                        <span class="text-sm text-slate-600">
                            Patient Satisfaction
                        </span>

                        <span class="text-sm font-semibold text-slate-800">
                            92%
                        </span>

                    </div>

                    <div class="h-3 rounded-full bg-slate-100 overflow-hidden">

                        <div class="h-full w-[92%] bg-green-500 rounded-full"></div>

                    </div>

                </div>

                <!-- ITEM -->
                <div>

                    <div class="flex items-center justify-between mb-2">

                        <span class="text-sm text-slate-600">
                            Appointment Success
                        </span>

                        <span class="text-sm font-semibold text-slate-800">
                            87%
                        </span>

                    </div>

                    <div class="h-3 rounded-full bg-slate-100 overflow-hidden">

                        <div class="h-full w-[87%] bg-blue-500 rounded-full"></div>

                    </div>

                </div>

                <!-- ITEM -->
                <div>

                    <div class="flex items-center justify-between mb-2">

                        <span class="text-sm text-slate-600">
                            Doctor Availability
                        </span>

                        <span class="text-sm font-semibold text-slate-800">
                            75%
                        </span>

                    </div>

                    <div class="h-3 rounded-full bg-slate-100 overflow-hidden">

                        <div class="h-full w-[75%] bg-yellow-500 rounded-full"></div>

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
                    Recent Reports
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    Clinic report activity and exports
                </p>

            </div>

            <button
            class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                Generate Report

            </button>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px]">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Report Name
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Category
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Date
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-sm text-slate-400 font-semibold">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <!-- ROW -->
                    @foreach([
                        ['Monthly Revenue','Finance','14 May 2025','Completed'],
                        ['Patient Analytics','Patients','13 May 2025','Processing'],
                        ['Doctor Performance','Doctors','12 May 2025','Completed'],
                        ['Appointment Report','Appointments','11 May 2025','Pending'],
                        ['Medical Records','Records','10 May 2025','Completed'],
                    ] as $report)

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center">

                                    <i data-lucide="file-text" class="w-5 h-5 text-blue-600"></i>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-slate-800">
                                        {{ $report[0] }}
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        Clinic Report
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ $report[1] }}
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ $report[2] }}
                        </td>

                        <td class="px-6 py-5">

                            @if($report[3] == 'Completed')

                            <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                Completed
                            </span>

                            @elseif($report[3] == 'Processing')

                            <span class="px-4 py-2 rounded-xl bg-blue-100 text-blue-600 text-xs font-semibold">
                                Processing
                            </span>

                            @else

                            <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                Pending
                            </span>

                            @endif

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <button class="w-10 h-10 rounded-xl bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">

                                    <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>

                                </button>

                                <button class="w-10 h-10 rounded-xl bg-green-100 hover:bg-green-200 flex items-center justify-center transition">

                                    <i data-lucide="download" class="w-4 h-4 text-green-600"></i>

                                </button>

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