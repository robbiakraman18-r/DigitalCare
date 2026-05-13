@extends('layouts.admin')

@section('title', 'Schedule Management')
@section('subtitle', 'Manage doctor schedules, availability and time slots.')

@section('content')

<div class="grid grid-cols-1 xl:grid-cols-[280px_1fr] gap-6">

    <!-- LEFT -->
    <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5 h-fit">

        <!-- SELECT -->
        <div>

            <h2 class="text-sm font-semibold text-slate-700 mb-3">
                Select Doctor
            </h2>

            <button class="w-full flex items-center justify-between px-4 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 transition">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center">

                        <i data-lucide="stethoscope" class="w-5 h-5 text-blue-600"></i>

                    </div>

                    <div class="text-left">

                        <h3 class="font-semibold text-slate-800 text-sm">
                            Dr. Emily Carter
                        </h3>

                        <p class="text-xs text-slate-400">
                            Cardiology
                        </p>

                    </div>

                </div>

                <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>

            </button>

        </div>

        <!-- VIEW -->
        <div class="mt-7">

            <h2 class="text-sm font-semibold text-slate-700 mb-3">
                View
            </h2>

            <div class="grid grid-cols-3 bg-slate-100 rounded-2xl p-1">

                <button class="py-2 rounded-xl text-sm font-medium text-slate-500">
                    Week
                </button>

                <button class="py-2 rounded-xl bg-white shadow-sm text-sm font-semibold text-blue-600">
                    Week
                </button>

                <button class="py-2 rounded-xl text-sm font-medium text-slate-500">
                    Month
                </button>

            </div>

        </div>

        <!-- CALENDAR -->
        <div class="mt-8">

            <h2 class="text-center font-bold text-slate-700">
                May 2025
            </h2>

            <!-- DAYS -->
            <div class="grid grid-cols-7 gap-2 mt-5 text-center text-xs text-slate-400">

                <span>Su</span>
                <span>Mo</span>
                <span>Tu</span>
                <span>We</span>
                <span>Th</span>
                <span>Fr</span>
                <span>Sa</span>

            </div>

            <!-- DATES -->
            <div class="grid grid-cols-7 gap-2 mt-4 text-sm">

                <div></div>
                <div></div>
                <div></div>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    1
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    2
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    3
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    4
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    5
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    6
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    7
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    8
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    9
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    10
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    11
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    12
                </button>

                <button class="w-9 h-9 rounded-xl hover:bg-slate-100 text-slate-600">
                    13
                </button>

                <button class="w-9 h-9 rounded-xl bg-blue-600 text-white font-semibold shadow">
                    14
                </button>

            </div>

        </div>

        <!-- LEGEND -->
        <div class="mt-8">

            <h2 class="text-sm font-semibold text-slate-700 mb-4">
                Schedule Legend
            </h2>

            <div class="space-y-4">

                <div class="flex items-center gap-3">

                    <div class="w-4 h-4 rounded bg-green-100"></div>

                    <span class="text-sm text-slate-600">
                        Available
                    </span>

                </div>

                <div class="flex items-center gap-3">

                    <div class="w-4 h-4 rounded bg-blue-100"></div>

                    <span class="text-sm text-slate-600">
                        Booked
                    </span>

                </div>

                <div class="flex items-center gap-3">

                    <div class="w-4 h-4 rounded bg-red-100"></div>

                    <span class="text-sm text-slate-600">
                        Unavailable
                    </span>

                </div>

                <div class="flex items-center gap-3">

                    <div class="w-4 h-4 rounded bg-yellow-100"></div>

                    <span class="text-sm text-slate-600">
                        Break
                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- TOP -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 px-6 py-5 border-b border-slate-100">

            <div class="flex items-center gap-4">

                <button class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-50 transition">

                    <i data-lucide="chevron-left" class="w-5 h-5 text-slate-600"></i>

                </button>

                <h2 class="font-bold text-slate-800">
                    May 11 - May 17, 2025
                </h2>

            </div>

            <div class="flex items-center gap-3">

                <button class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-medium hover:bg-slate-50 transition">
                    Today
                </button>

                <button class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition">
                    + Add Schedule
                </button>

                <button class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-medium hover:bg-slate-50 transition">
                    More Actions
                </button>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <div class="min-w-[1100px]">

                <!-- HEADER -->
                <div class="grid grid-cols-7 border-b border-slate-100">

                    <div class="p-4"></div>

                    <div class="p-4 text-center border-l border-slate-100">
                        <h3 class="font-semibold text-slate-700">Sun</h3>
                        <p class="text-sm text-slate-400 mt-1">11</p>
                    </div>

                    <div class="p-4 text-center border-l border-slate-100">
                        <h3 class="font-semibold text-slate-700">Mon</h3>
                        <p class="text-sm text-slate-400 mt-1">12</p>
                    </div>

                    <div class="p-4 text-center border-l border-slate-100">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto text-sm font-bold">
                            14
                        </div>
                        <p class="text-xs text-blue-600 mt-2 font-semibold">
                            Wed
                        </p>
                    </div>

                    <div class="p-4 text-center border-l border-slate-100">
                        <h3 class="font-semibold text-slate-700">Thu</h3>
                        <p class="text-sm text-slate-400 mt-1">15</p>
                    </div>

                    <div class="p-4 text-center border-l border-slate-100">
                        <h3 class="font-semibold text-slate-700">Fri</h3>
                        <p class="text-sm text-slate-400 mt-1">16</p>
                    </div>

                    <div class="p-4 text-center border-l border-slate-100">
                        <h3 class="font-semibold text-slate-700">Sat</h3>
                        <p class="text-sm text-slate-400 mt-1">17</p>
                    </div>

                </div>

                <!-- ROW -->
                @foreach ([
                    '08:00 AM',
                    '09:00 AM',
                    '10:00 AM',
                    '11:00 AM',
                    '12:00 PM',
                    '01:00 PM',
                    '02:00 PM',
                    '03:00 PM',
                    '04:00 PM',
                    '05:00 PM'
                ] as $time)

                <div class="grid grid-cols-7 border-b border-slate-100 min-h-[80px]">

                    <!-- TIME -->
                    <div class="p-4 text-sm text-slate-500 font-medium">
                        {{ $time }}
                    </div>

                    <!-- SUN -->
                    <div class="border-l border-slate-100 bg-green-50"></div>

                    <!-- MON -->
                    <div class="border-l border-slate-100 bg-green-50 relative">

                        @if($time == '09:00 AM')

                        <div class="absolute inset-2 bg-blue-100 rounded-xl p-2 text-xs text-blue-700 font-semibold">
                            09:00 AM <br>
                            John Smith
                        </div>

                        @endif

                        @if($time == '11:00 AM')

                        <div class="absolute inset-2 bg-blue-100 rounded-xl p-2 text-xs text-blue-700 font-semibold">
                            11:00 AM <br>
                            David Wilson
                        </div>

                        @endif

                    </div>

                    <!-- WED -->
                    <div class="border-l border-slate-100 bg-green-50 relative">

                        @if($time == '09:00 AM')

                        <div class="absolute inset-2 bg-blue-100 rounded-xl p-2 text-xs text-blue-700 font-semibold">
                            09:00 AM <br>
                            Sarah Johnson
                        </div>

                        @endif

                        @if($time == '01:00 PM')

                        <div class="absolute inset-2 bg-blue-100 rounded-xl p-2 text-xs text-blue-700 font-semibold">
                            01:00 PM <br>
                            Emily Davis
                        </div>

                        @endif

                    </div>

                    <!-- THU -->
                    <div class="border-l border-slate-100 bg-yellow-50 relative">

                        @if($time == '12:00 PM')

                        <div class="absolute inset-2 bg-yellow-100 rounded-xl p-2 text-xs text-yellow-700 font-semibold">
                            12:00 PM <br>
                            Break
                        </div>

                        @endif

                    </div>

                    <!-- FRI -->
                    <div class="border-l border-slate-100 bg-green-50 relative">

                        @if($time == '01:00 PM')

                        <div class="absolute inset-2 bg-blue-100 rounded-xl p-2 text-xs text-blue-700 font-semibold">
                            01:00 PM <br>
                            Robert Lee
                        </div>

                        @endif

                    </div>

                    <!-- SAT -->
                    <div class="border-l border-slate-100 bg-green-50 relative">

                        @if($time == '08:00 AM')

                        <div class="absolute inset-2 bg-blue-100 rounded-xl p-2 text-xs text-blue-700 font-semibold">
                            08:00 AM <br>
                            Michael Brown
                        </div>

                        @endif

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection