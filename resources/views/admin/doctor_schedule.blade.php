@extends('layouts.admin')

@section('title', 'Doctor Schedule')
@section('subtitle', 'Manage doctor practice schedules.')

@section('content')

<div
x-data="{ detailModal:false }"
class="space-y-6">

    <!-- TOP CARD -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- Total Schedule -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-400">
                        Total Schedule
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        42
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                    <i data-lucide="calendar-days"
                    class="w-6 h-6 text-blue-600"></i>
                </div>

            </div>

            <p class="text-xs text-green-500 mt-4 font-medium">
                +5 new this week
            </p>

        </div>

        <!-- Available -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-400">
                        Available Doctors
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        18
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">
                    <i data-lucide="stethoscope"
                    class="w-6 h-6 text-green-600"></i>
                </div>

            </div>

            <p class="text-xs text-green-500 mt-4 font-medium">
                Available today
            </p>

        </div>

        <!-- Busy -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-400">
                        Busy Schedule
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        12
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">
                    <i data-lucide="clock-3"
                    class="w-6 h-6 text-yellow-600"></i>
                </div>

            </div>

            <p class="text-xs text-yellow-500 mt-4 font-medium">
                High traffic
            </p>

        </div>

        <!-- Cancelled -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-400">
                        Cancelled
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        3
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">
                    <i data-lucide="calendar-x"
                    class="w-6 h-6 text-red-500"></i>
                </div>

            </div>

            <p class="text-xs text-slate-400 mt-4 font-medium">
                Updated today
            </p>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="flex items-center justify-between p-6 border-b border-slate-100">

            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    Doctor Schedule List
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    Manage all doctor schedules.
                </p>

            </div>

            <button
            class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                Add Schedule

            </button>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Doctor
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Specialization
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Day
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Time
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-sm text-slate-400">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                @foreach([
                    [
                        'doctor'=>'Dr. Supardi Natsir',
                        'specialist'=>'General Doctor',
                        'day'=>'Monday',
                        'time'=>'08:00 - 14:00',
                        'status'=>'Available'
                    ],
                    [
                        'doctor'=>'Dr. Sarah Putri',
                        'specialist'=>'Cardiology',
                        'day'=>'Tuesday',
                        'time'=>'09:00 - 15:00',
                        'status'=>'Busy'
                    ],
                    [
                        'doctor'=>'Dr. Michael',
                        'specialist'=>'Neurology',
                        'day'=>'Wednesday',
                        'time'=>'08:00 - 13:00',
                        'status'=>'Off'
                    ]
                ] as $schedule)

                <tr class="border-b border-slate-100 hover:bg-slate-50">

                    <td class="px-6 py-5 font-semibold text-slate-800">
                        {{ $schedule['doctor'] }}
                    </td>

                    <td class="px-6 py-5 text-slate-600">
                        {{ $schedule['specialist'] }}
                    </td>

                    <td class="px-6 py-5 text-slate-600">
                        {{ $schedule['day'] }}
                    </td>

                    <td class="px-6 py-5 text-slate-600">
                        {{ $schedule['time'] }}
                    </td>

                    <td class="px-6 py-5">

                        @if($schedule['status'] == 'Available')

                        <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                            Available
                        </span>

                        @elseif($schedule['status'] == 'Busy')

                        <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                            Busy
                        </span>

                        @else

                        <span class="px-4 py-2 rounded-xl bg-red-100 text-red-600 text-xs font-semibold">
                            Off
                        </span>

                        @endif

                    </td>

                    <td class="px-6 py-5">

                        <div class="flex items-center justify-center gap-2">

                            <button class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
                            </button>

                            <button class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                                <i data-lucide="pencil" class="w-4 h-4 text-green-600"></i>
                            </button>

                            <button class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                                <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>
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