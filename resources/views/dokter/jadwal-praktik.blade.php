@extends('layouts.dokter')

@section('title', 'Practice Schedule')
@section('subtitle', 'Your Practice Schedule')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="relative overflow-hidden rounded-[30px] bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-white shadow-lg">
        <div class="relative z-10">
            <h1 class="text-2xl lg:text-3xl font-bold leading-tight">Practice Schedule</h1>
            <p class="mt-1 text-teal-100 text-sm">
                {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
            </p>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white/10"></div>
    </div>

    <!-- STATS -->
    @php
        $totalJadwal   = $jadwal->count();
        $available     = $jadwal->where('status_jadwal', 'Available')->count();
        $full          = $jadwal->where('status_jadwal', 'Full')->count();
        $closed        = $jadwal->where('status_jadwal', 'Closed')->count();
    @endphp

    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Total Schedule</p>
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $totalJadwal }}</h2>
                </div>
                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i data-lucide="calendar" class="w-5 h-5 text-blue-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Available</p>
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $available }}</h2>
                </div>
                <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Full</p>
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $full }}</h2>
                </div>
                <div class="w-11 h-11 rounded-xl bg-red-100 flex items-center justify-center">
                    <i data-lucide="x-circle" class="w-5 h-5 text-red-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Closed</p>
                    <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $closed }}</h2>
                </div>
                <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center">
                    <i data-lucide="lock" class="w-5 h-5 text-slate-500"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- FILTER -->
        <div class="p-5 border-b border-slate-100">
            <form method="GET" class="flex flex-col sm:flex-row gap-3 items-end">

                <div class="relative w-full sm:w-64">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ $tanggal }}"
                        onchange="this.form.submit()"
                        class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm">
                </div>

                <a href="{{ route('dokter.jadwal') }}"
                   class="px-4 py-3 rounded-2xl border border-slate-200 text-sm text-slate-500 hover:bg-slate-50 transition whitespace-nowrap">
                    Today
                </a>

            </form>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Day / Date</th>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Practice Hours</th>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Room</th>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Quota</th>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Queue Progress</th>
                        <th class="text-left px-6 py-4 text-xs text-slate-400 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jadwal as $item)
                        @php
                            $badgeClass = match($item->status_jadwal) {
                                'Available' => 'bg-green-100 text-green-600',
                                'Full'      => 'bg-red-100 text-red-600',
                                default     => 'bg-slate-100 text-slate-600',
                            };
                            $progress = $item->kuota_harian > 0
                                ? round(($item->terisi / $item->kuota_harian) * 100)
                                : 0;
                            $progressColor = $progress >= 100
                                ? 'bg-red-400'
                                : ($progress >= 70 ? 'bg-yellow-400' : 'bg-teal-400');
                        @endphp
                        <tr class="hover:bg-slate-50 transition">

                            <!-- DAY / DATE -->
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">{{ $item->hari }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </p>
                            </td>

                            <!-- JAM -->
                            <td class="px-6 py-4 text-slate-600">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="clock" class="w-4 h-4 text-slate-300"></i>
                                    {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                    –
                                    {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                </div>
                            </td>

                            <!-- ROOM -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-xl bg-teal-50 flex items-center justify-center">
                                        <i data-lucide="door-open" class="w-4 h-4 text-teal-500"></i>
                                    </div>
                                    <span class="font-medium text-slate-700">{{ $item->ruang }}</span>
                                </div>
                            </td>

                            <!-- QUOTA -->
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-800">{{ $item->terisi }}</span>
                                <span class="text-slate-400">/{{ $item->kuota_harian }}</span>
                                <span class="text-xs text-slate-400 ml-1">patients</span>
                            </td>

                            <!-- PROGRESS BAR -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden w-24">
                                        <div class="h-full rounded-full {{ $progressColor }} transition-all"
                                             style="width: {{ $progress }}%">
                                        </div>
                                    </div>
                                    <span class="text-xs text-slate-400 whitespace-nowrap">{{ $progress }}%</span>
                                </div>
                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-xl text-xs font-semibold {{ $badgeClass }}">
                                    {{ $item->status_jadwal }}
                                </span>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <i data-lucide="calendar-x" class="w-10 h-10 text-slate-200"></i>
                                    <p class="text-slate-400 text-sm">Tidak ada jadwal pada tanggal ini</p>
                                    <p class="text-xs text-slate-300">
                                        {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- INFO FOOTER -->
        <div class="p-5 border-t border-slate-100">
            <div class="rounded-2xl bg-cyan-50 px-5 py-4 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-cyan-500 flex items-center justify-center text-white flex-shrink-0">
                    <i data-lucide="info" class="w-4 h-4"></i>
                </div>
                <p class="text-sm text-slate-600">
                    Schedule may change according to clinic needs. Contact admin for any changes.
                </p>
            </div>
        </div>

    </div>

</div>
@endsection