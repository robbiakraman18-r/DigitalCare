@extends('layouts.dokter')

@section('title', 'Doctor Dashboard')
@section('subtitle', 'Today’s Practicum Activity Monitoring')

@section('content')
<div class="space-y-5">

    <!-- HERO -->
    <div class="relative overflow-hidden rounded-[30px] bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-white shadow-lg">

        <div class="relative z-10">

            <h1 class="text-2xl lg:text-3xl font-bold leading-tight">
                Welcome, Dr. {{ $dokter->user->name }}👋
            </h1>

            <p class="mt-2 text-teal-100 text-sm">
                You have {{ $todaySchedule }} consultation schedules for today.
            </p>

            <div class="mt-5 flex gap-3">

                <a href="{{ route('dokter.jadwal') }}"
                class="px-4 py-2 rounded-2xl bg-white text-teal-600 text-sm font-semibold hover:scale-105 transition">

                    View Schedule

                </a>

                <a href="{{ route('dokter.pasien') }}"
                class="px-4 py-2 rounded-2xl border border-white/30 hover:bg-white/10 text-sm transition">

                    Patient Data

                </a>

            </div>

        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white/10"></div>

    </div>

    <!-- STATISTIC -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs text-slate-400">Total Patients</p>

                    <h2 class="text-2xl font-bold mt-1 text-slate-800">
                        {{ $totalPasien }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-teal-100 flex items-center justify-center">
                    <i data-lucide="users" class="w-5 h-5 text-teal-500"></i>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs text-slate-400">Appointments</p>

                    <h2 class="text-2xl font-bold mt-1 text-slate-800">
                        {{ $totalAppointment }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-cyan-100 flex items-center justify-center">
                    <i data-lucide="calendar-days" class="w-5 h-5 text-cyan-500"></i>
                </div>

            </div>

        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-xs text-slate-400">Pending</p>

            <h2 class="text-2xl font-bold mt-1 text-slate-800">
                {{ $totalPending }}
            </h2>

        </div>

        <div class="w-11 h-11 rounded-xl bg-orange-100 flex items-center justify-center">
            <i data-lucide="hourglass" class="w-5 h-5 text-orange-500"></i>
        </div>

    </div>

</div>
<div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-xs text-slate-400">Completed</p>

            <h2 class="text-2xl font-bold mt-1 text-slate-800">
                {{ $totalCompleted }}
            </h2>

        </div>

        <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
        </div>

    </div>

</div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs text-slate-400">Medical Records</p>

                    <h2 class="text-2xl font-bold mt-1 text-slate-800">
                        {{ $totalRekamMedis }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-red-100 flex items-center justify-center">
                    <i data-lucide="file-heart" class="w-5 h-5 text-red-500"></i>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs text-slate-400">Today's Schedule</p>

                    <h2 class="text-2xl font-bold mt-1 text-slate-800">
                        {{ $todaySchedule }}
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

            <!-- SCHEDULE -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">

                <div class="flex justify-between items-center mb-4">

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            Practice Schedule
                        </h2>

                        <p class="text-xs text-slate-400 mt-1">
                            Today's consultation schedule
                        </p>

                    </div>

                    <a href="{{ route('dokter.jadwal') }}"
                    class="px-3 py-2 rounded-xl bg-teal-50 text-teal-500 text-sm font-medium hover:bg-teal-100 transition">

                        View All

                    </a>

                </div>

                <div class="space-y-3">

   @forelse($jadwalHariIni as $item)

<div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50">

    <div class="flex items-center gap-3">

        <div class="w-12 h-12 rounded-xl bg-teal-100 flex items-center justify-center font-bold text-sm text-teal-600">
            {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
        </div>

        <div>

            <h3 class="font-semibold text-sm text-slate-800">
                {{ $item->hari }}
            </h3>

            <p class="text-xs text-slate-400">
                {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                -
                {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
            </p>

        </div>

    </div>

    <span class="px-3 py-1 rounded-xl text-xs font-semibold
        @if($item->status_jadwal == 'Available')
            bg-green-100 text-green-600
        @elseif($item->status_jadwal == 'Full')
            bg-red-100 text-red-600
        @else
            bg-yellow-100 text-yellow-600
        @endif">

        {{ $item->status_jadwal }}

    </span>

</div>

@empty

<p class="text-sm text-slate-400">
    Tidak ada jadwal hari ini
</p>

@endforelse

</div>

            </div>

            <!-- APPOINTMENT -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">

                <div class="flex justify-between items-center mb-4">

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            Appointments
                        </h2>

                        <p class="text-xs text-slate-400 mt-1">
                            Latest patient appointments
                        </p>

                    </div>

                    <a href="{{ route('dokter.appointment') }}"
                    class="px-3 py-2 rounded-xl bg-teal-50 text-teal-500 text-sm font-medium hover:bg-teal-100 transition">

                        View All

                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b">

                                <th class="text-left py-3 text-xs text-slate-400">Name</th>
                                <th class="text-left py-3 text-xs text-slate-400">Time</th>
                                <th class="text-left py-3 text-xs text-slate-400">Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($latestAppointments as $item)

                            <tr class="border-b">

                                <td class="py-3 text-sm font-medium">
                                    {{ $item->pasien->user->name ?? 'Pasien' }}
                                </td>

                                <td class="py-3 text-sm">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('h:i A') }}
                                </td>

                                <td class="py-3">

                                    <span class="px-3 py-1 rounded-xl text-xs font-semibold
                                        {{ $item->status_janji == 'completed' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">

                                        {{ ucfirst($item->status_janji) }}

                                    </span>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

@endsection