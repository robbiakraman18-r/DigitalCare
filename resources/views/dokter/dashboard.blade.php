@extends('layouts.dokter')

@section('title', 'Doctor Dashboard')
@section('subtitle', 'Today Practicum Activity Monitoring')

@section('content')
<div class="space-y-5">

    <!-- HERO -->
    <div class="relative overflow-hidden rounded-[30px] bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-white shadow-lg">
        <div class="relative z-10">
            <h1 class="text-2xl lg:text-3xl font-bold leading-tight">
                Welcome, {{ $dokter->user->nama }} 👋
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
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Total Patients <span class="text-slate-300">(30 hari)</span></p>
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $totalPasien }}</h2>
                </div>
                <div class="w-11 h-11 rounded-xl bg-teal-100 flex items-center justify-center">
                    <i data-lucide="users" class="w-5 h-5 text-teal-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Appointments <span class="text-slate-300">(30 hari)</span></p>
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $totalAppointment }}</h2>
                </div>
                <div class="w-11 h-11 rounded-xl bg-cyan-100 flex items-center justify-center">
                    <i data-lucide="calendar-days" class="w-5 h-5 text-cyan-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Pending <span class="text-slate-300">(30 hari)</span></p>
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $totalPending }}</h2>
                </div>
                <div class="w-11 h-11 rounded-xl bg-orange-100 flex items-center justify-center">
                    <i data-lucide="hourglass" class="w-5 h-5 text-orange-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Completed <span class="text-slate-300">(30 hari)</span></p>
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $totalCompleted }}</h2>
                </div>
                <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Medical Records <span class="text-slate-300">(30 hari)</span></p>
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $totalRekamMedis }}</h2>
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
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $todaySchedule }}</h2>
                </div>
                <div class="w-11 h-11 rounded-xl bg-yellow-100 flex items-center justify-center">
                    <i data-lucide="clock-3" class="w-5 h-5 text-yellow-500"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

        <!-- LEFT: Schedule + Appointment -->
        <div class="xl:col-span-2 space-y-4">

            <!-- SCHEDULE -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Practice Schedule</h2>
                        <p class="text-xs text-slate-400 mt-1">Today's consultation schedule</p>
                    </div>
                    <a href="{{ route('dokter.jadwal') }}"
                       class="px-3 py-2 rounded-xl bg-teal-50 text-teal-500 text-sm font-medium hover:bg-teal-100 transition">
                        View All
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($jadwalHariIni as $item)
                        @php
                            $jadwalBadge = match($item->status_jadwal) {
                                'Available' => 'bg-green-100 text-green-600',
                                'Full'      => 'bg-red-100 text-red-600',
                                default     => 'bg-yellow-100 text-yellow-600',
                            };
                        @endphp
                        <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-teal-100 flex items-center justify-center font-bold text-sm text-teal-600">
                                    {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm text-slate-800">{{ $item->hari }}</h3>
                                    <p class="text-xs text-slate-400">
                                        {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-xl text-xs font-semibold {{ $jadwalBadge }}">
                                {{ $item->status_jadwal }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400 text-center py-2">Tidak ada jadwal hari ini</p>
                    @endforelse
                </div>
            </div>

            <!-- APPOINTMENT HARI INI -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Today's Appointments</h2>
                        <p class="text-xs text-slate-400 mt-1">Appointment pasien hari ini</p>
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
                                <th class="text-left py-3 text-xs text-slate-400">Queue</th>
                                <th class="text-left py-3 text-xs text-slate-400">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($todayAppointments as $item)
                                @php
                                    $apptBadge = match($item->status_janji) {
                                        'completed'       => 'bg-green-100 text-green-600',
                                        'in_consultation' => 'bg-violet-100 text-violet-600',
                                        'called'          => 'bg-cyan-100 text-cyan-600',
                                        'cancelled'       => 'bg-red-100 text-red-500',
                                        default           => 'bg-yellow-100 text-yellow-600',
                                    };
                                @endphp
                                <tr class="border-b">
                                    <td class="py-3 text-sm font-medium">
                                        {{ $item->pasien->user->nama ?? 'Pasien' }}
                                    </td>
                                    <td class="py-3 text-sm text-slate-500">
                                        #{{ $item->nomor_antrian ?? '-' }}
                                    </td>
                                    <td class="py-3">
                                        <span class="px-3 py-1 rounded-xl text-xs font-semibold {{ $apptBadge }}">
                                            {{ ucfirst(str_replace('_', ' ', $item->status_janji)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-4 text-center text-sm text-slate-400">
                                        Tidak ada appointment hari ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- RIGHT: Donut -->
        <div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 h-full">
                <h2 class="text-lg font-bold text-slate-800 mb-1">Status Breakdown</h2>
                <p class="text-xs text-slate-400 mb-4">30 hari terakhir</p>

                @php
                    $total        = $totalPending + $totalCompleted + $totalCalled + $totalInConsultation + $totalCancelled;
                    $completedPct = $total > 0 ? round(($totalCompleted      / $total) * 100) : 0;
                    $pendingPct   = $total > 0 ? round(($totalPending        / $total) * 100) : 0;
                    $calledPct    = $total > 0 ? round(($totalCalled         / $total) * 100) : 0;
                    $consultPct   = $total > 0 ? round(($totalInConsultation / $total) * 100) : 0;
                    $cancelPct    = $total > 0 ? round(($totalCancelled      / $total) * 100) : 0;
                    $c1 = $completedPct;
                    $c2 = $c1 + $pendingPct;
                    $c3 = $c2 + $calledPct;
                    $c4 = $c3 + $consultPct;
                @endphp

                <div class="flex flex-col items-center gap-4">
                    <div class="w-36 h-36 rounded-full flex items-center justify-center"
                         style="background: conic-gradient(
                             #22c55e 0% {{ $c1 }}%,
                             #fbbf24 {{ $c1 }}% {{ $c2 }}%,
                             #06b6d4 {{ $c2 }}% {{ $c3 }}%,
                             #8b5cf6 {{ $c3 }}% {{ $c4 }}%,
                             #f87171 {{ $c4 }}% 100%
                         );">
                        <div class="w-24 h-24 rounded-full bg-white flex flex-col items-center justify-center">
                            <span class="text-xl font-bold text-slate-800">{{ $total }}</span>
                            <span class="text-xs text-slate-400">Total</span>
                        </div>
                    </div>

                    <div class="w-full space-y-2">
                        @php
                            $legends = [
                                ['label' => 'Completed',       'color' => 'bg-green-500',  'val' => $totalCompleted,      'pct' => $completedPct],
                                ['label' => 'Pending',         'color' => 'bg-yellow-400', 'val' => $totalPending,        'pct' => $pendingPct],
                                ['label' => 'Called',          'color' => 'bg-cyan-500',   'val' => $totalCalled,         'pct' => $calledPct],
                                ['label' => 'In Consultation', 'color' => 'bg-violet-500', 'val' => $totalInConsultation, 'pct' => $consultPct],
                                ['label' => 'Cancelled',       'color' => 'bg-red-400',    'val' => $totalCancelled,      'pct' => $cancelPct],
                            ];
                        @endphp
                        @foreach($legends as $row)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full {{ $row['color'] }}"></div>
                                    <span class="text-xs text-slate-600">{{ $row['label'] }}</span>
                                </div>
                                <span class="text-xs font-semibold text-slate-800">
                                    {{ $row['val'] }} <span class="text-slate-400">({{ $row['pct'] }}%)</span>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- BAR CHART full width -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
        <h2 class="text-lg font-bold text-slate-800 mb-1">Appointment Trend</h2>
        <p class="text-xs text-slate-400 mb-4">Jumlah appointment 30 hari terakhir</p>

        @php $maxVal = max(array_merge($appointmentTrendData, [1])); @endphp

        <div class="flex items-end gap-[3px] h-40">
            @foreach($appointmentTrendLabels as $i => $label)
                @php
                    $val = $appointmentTrendData[$i] ?? 0;
                    $h   = $maxVal > 0 ? max(round(($val / $maxVal) * 100), $val > 0 ? 5 : 0) : 0;
                @endphp
                <div class="flex flex-col items-center justify-end flex-1 min-w-[18px] h-full group relative">
                    <div class="absolute bottom-full mb-1 hidden group-hover:flex bg-slate-800 text-white text-[10px] rounded px-1.5 py-0.5 whitespace-nowrap z-10">
                        {{ $label }}: {{ $val }}
                    </div>
                    <div class="w-full rounded-t-sm transition-all {{ $val > 0 ? 'bg-teal-400 hover:bg-teal-500' : 'bg-slate-100' }}"
                         style="height: {{ $h }}%">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex gap-[3px] mt-2">
            @foreach($appointmentTrendLabels as $i => $label)
                <div class="flex-1 min-w-[18px] text-center">
                    @if($i % 5 === 0)
                        <span class="text-[8px] text-slate-400">{{ $label }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection