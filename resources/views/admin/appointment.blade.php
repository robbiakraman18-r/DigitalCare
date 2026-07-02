@extends('layouts.admin')

@section('content')

@if(session('success'))
<div id="toast-success" class="fixed top-8 right-8 z-[9999]">
    <div class="bg-white shadow-xl border border-green-100 rounded-[24px] p-5 flex items-center gap-4 min-w-[340px]">
        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
            <i data-lucide="check-circle-2" class="w-6 h-6 text-green-600"></i>
        </div>
        <div>
            <h2 class="font-bold text-slate-800">Success</h2>
            <p class="text-sm text-slate-500">{{ session('success') }}</p>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div id="toast-error" class="fixed top-8 right-8 z-[9999]">
    <div class="bg-white shadow-xl border border-red-100 rounded-[24px] p-5 flex items-center gap-4 min-w-[340px]">
        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
            <i data-lucide="circle-x" class="w-6 h-6 text-red-500"></i>
        </div>
        <div>
            <h2 class="font-bold text-slate-800">Failed</h2>
            <p class="text-sm text-slate-500">{{ session('error') }}</p>
        </div>
    </div>
</div>
@endif

<div class="space-y-8">

    <!-- HEADER -->
    <div class="relative overflow-hidden rounded-[30px] bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-white shadow-lg">
        <div class="relative z-10">
            <h1 class="text-2xl lg:text-3xl font-bold leading-tight">Appointment Management</h1>
            <p class="mt-1 text-teal-100 text-sm">
                {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
            </p>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white/10"></div>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-4">

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Total</p>
            <h2 class="text-2xl font-bold mt-1 text-slate-800">{{ $total }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Pending</p>
            <h2 class="text-2xl font-bold mt-1 text-yellow-600">{{ $pending }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Called</p>
            <h2 class="text-2xl font-bold mt-1 text-blue-600">{{ $called }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Consultation</p>
            <h2 class="text-2xl font-bold mt-1 text-purple-600">{{ $consultation }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Completed</p>
            <h2 class="text-2xl font-bold mt-1 text-green-600">{{ $completed }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <p class="text-xs text-slate-400">Cancelled</p>
            <h2 class="text-2xl font-bold mt-1 text-slate-500">{{ $cancelled }}</h2>
        </div>

    </div>

    <!-- MAIN CARD -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- FILTER -->
        <div class="p-5 border-b border-slate-100">
            <form method="GET" class="flex flex-col lg:flex-row gap-3 items-end">

                <div class="relative w-full lg:w-72">
                    <label class="block text-xs text-slate-400 mb-1">Search</label>
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-4 top-[42px] -translate-y-1/2"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Pasien, dokter, no antrian..."
                        class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 text-sm">
                </div>

                <div class="relative w-full lg:w-52">
                    <label class="block text-xs text-slate-400 mb-1">Status</label>
                    <select
                        name="status"
                        class="w-full pl-4 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 text-sm appearance-none">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="called" {{ request('status') == 'called' ? 'selected' : '' }}>Called</option>
                        <option value="in_consultation" {{ request('status') == 'in_consultation' ? 'selected' : '' }}>Consultation</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="relative w-full lg:w-56">
                    <label class="block text-xs text-slate-400 mb-1">Tanggal</label>
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400 absolute left-4 top-[42px] -translate-y-1/2"></i>
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ $tanggal }}"
                        class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 text-sm">
                </div>

                <button
                    type="submit"
                    class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm transition whitespace-nowrap">
                    Filter
                </button>

                <a href="{{ route('admin.appointment') }}"
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
                        <th class="px-6 py-4 text-left text-xs text-slate-400 font-medium">Queue</th>
                        <th class="px-6 py-4 text-left text-xs text-slate-400 font-medium">Patient</th>
                        <th class="px-6 py-4 text-left text-xs text-slate-400 font-medium">Doctor</th>
                        <th class="px-6 py-4 text-left text-xs text-slate-400 font-medium">Schedule</th>
                        <th class="px-6 py-4 text-left text-xs text-slate-400 font-medium">Complaint</th>
                        <th class="px-6 py-4 text-center text-xs text-slate-400 font-medium">Status</th>
                        <th class="px-6 py-4 text-center text-xs text-slate-400 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($appointments as $appointment)
                        @php
                            $badgeClass = match($appointment->status_janji) {
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'called' => 'bg-blue-100 text-blue-700',
                                'in_consultation' => 'bg-purple-100 text-purple-700',
                                'completed' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-slate-200 text-slate-500',
                                default => 'bg-slate-100 text-slate-600',
                            };
                            $labelStatus = match($appointment->status_janji) {
                                'pending' => 'Pending',
                                'called' => 'Called',
                                'in_consultation' => 'Consultation',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                                default => ucfirst($appointment->status_janji),
                            };
                        @endphp
                        <tr class="hover:bg-slate-50 transition {{ $appointment->status_janji == 'cancelled' ? 'opacity-60' : '' }}">

                            <!-- QUEUE -->
                            <td class="px-6 py-5">
                                <span class="font-bold text-teal-600 text-lg">
                                    #{{ str_pad($appointment->nomor_antrian, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <!-- PATIENT -->
                            <td class="px-6 py-5">
                                <div class="font-semibold text-slate-800">
                                    {{ $appointment->pasien->user->nama ?? '-' }}
                                </div>
                            </td>

                            <!-- DOCTOR -->
                            <td class="px-6 py-5 text-slate-600">
                                {{ $appointment->dokter->user->nama ?? '-' }}
                            </td>

                            <!-- SCHEDULE -->
                            <td class="px-6 py-5">
                                <div class="text-slate-700">
                                    {{ $appointment->jadwal ? \Carbon\Carbon::parse($appointment->jadwal->tanggal)->format('d M Y') : '-' }}
                                </div>
                                <div class="text-xs text-slate-400 flex items-center gap-1 mt-0.5">
                                    <i data-lucide="clock" class="w-3 h-3"></i>
                                    @if($appointment->jadwal)
                                        {{ \Carbon\Carbon::parse($appointment->jadwal->jam_mulai)->format('H:i') }}
                                        –
                                        {{ \Carbon\Carbon::parse($appointment->jadwal->jam_selesai)->format('H:i') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>

                            <!-- COMPLAINT -->
                            <td class="px-6 py-5 text-slate-600 max-w-xs truncate">
                                {{ Str::limit($appointment->keluhan_utama, 30) }}
                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 rounded-xl text-xs font-semibold {{ $badgeClass }}">
                                    {{ $labelStatus }}
                                </span>
                            </td>

                            <!-- ACTION -->
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">

                                    @if(in_array($appointment->status_janji, ['pending', 'called', 'in_consultation']))

                                        <form
                                            action="{{ route('admin.appointment.status', $appointment->id_janji) }}"
                                            method="POST"
                                            onsubmit="return confirm('Batalkan appointment ini?')">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status_janji" value="cancelled">

                                            <button class="px-3 py-2 rounded-xl border border-red-200 text-red-500 hover:bg-red-50 transition text-xs font-semibold inline-flex items-center gap-1">
                                                <i data-lucide="x-circle" class="w-4 h-4"></i>
                                                Cancel
                                            </button>
                                        </form>

                                    @elseif($appointment->status_janji == 'completed')

                                        <span class="px-3 py-2 text-green-600 text-xs italic whitespace-nowrap">
                                            Selesai diperiksa
                                        </span>

                                    @elseif($appointment->status_janji == 'cancelled')

                                        <span class="px-3 py-2 text-slate-400 text-xs italic whitespace-nowrap">
                                            Sudah dibatalkan
                                        </span>

                                    @endif
                                    @if($appointment->status_janji !== 'completed')
                                    <form
                                        action="{{ route('admin.appointment.delete', $appointment->id_janji) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete appointment?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="w-9 h-9 rounded-xl border border-red-200 flex items-center justify-center hover:bg-red-50 transition">
                                            <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>
                                        </button>
                                    </form>
                                    @endif

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-14 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <i data-lucide="calendar-x" class="w-10 h-10 text-slate-200"></i>
                                    <p class="text-slate-400 text-sm">Tidak ada appointment pada tanggal ini</p>
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

    </div>

</div>

<script>
setTimeout(()=>{
    const success=document.getElementById('toast-success');
    if(success){ success.style.opacity="0"; setTimeout(()=>success.remove(),500); }
    const error=document.getElementById('toast-error');
    if(error){ error.style.opacity="0"; setTimeout(()=>error.remove(),500); }
},3000);
</script>

@endsection