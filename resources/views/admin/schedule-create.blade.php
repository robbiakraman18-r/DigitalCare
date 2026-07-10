@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- TOP -->
    <div>
        
        <a href="{{ route('admin.schedule.index') }}"
        class="inline-flex items-center gap-1.5 text-sm text-slate-400 hover:text-slate-600 transition mb-2">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
            Back to Schedule Management
        </a>

        <h1 class="text-3xl font-bold text-slate-800">
            Add Schedule
        </h1>

        <p class="text-slate-400 mt-1">
            Create a new practice schedule for a doctor.
        </p>
    </div>

    @if(session('error'))
        <div class="p-4 rounded-2xl bg-red-50 border border-red-100 text-red-600 flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5 shrink-0"></i>
            <p class="text-sm">{{ session('error') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-100 text-red-600 flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5 shrink-0"></i>
            <ul class="text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
    action="{{ route('admin.schedule.store') }}"
    method="POST"
    class="space-y-6">
    @csrf

    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-8">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            <div class="sm:col-span-2">
                <label class="text-sm font-medium text-slate-600">Doctor</label>

                <div class="relative mt-2">
                    <i data-lucide="stethoscope" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <select
                    name="id_dokter"
                    required
                    class="w-full pl-11 pr-10 py-3 rounded-2xl border border-slate-200 bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Select Doctor</option>
                        @foreach($dokters as $dokter)
                            @php
                                $isUnavailable = $dokter->status_ketersediaan !== 'Available';
                                $isInactive    = optional($dokter->user)->status !== 'active';
                                $isBlocked     = $isUnavailable || $isInactive;

                                $label = $dokter->user->nama;
                                if ($isInactive) {
                                    $label .= ' (Inactive Account)';
                                } elseif ($isUnavailable) {
                                    $label .= ' (Unavailable)';
                                }
                            @endphp
                            <option
                            value="{{ $dokter->id_dokter }}"
                            {{ old('id_dokter') == $dokter->id_dokter ? 'selected' : '' }}
                            {{ $isBlocked ? 'disabled' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                </div>
            </div>

            <div>
                <label class="text-sm font-medium text-slate-600">Date</label>
                <div class="relative mt-2">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input
                    type="date"
                    name="tanggal"
                    value="{{ old('tanggal') }}"
                    required
                    class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
            </div>

            <div>
                <label class="text-sm font-medium text-slate-600">Room</label>
                <div class="relative mt-2">
                    <i data-lucide="door-open" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input
                    type="text"
                    name="ruang"
                    value="{{ old('ruang') }}"
                    required
                    placeholder="e.g. Room 201"
                    class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
            </div>

            <div>
                <label class="text-sm font-medium text-slate-600">Start Time</label>
                <div class="relative mt-2">
                    <i data-lucide="clock" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input
                    type="time"
                    name="jam_mulai"
                    value="{{ old('jam_mulai') }}"
                    required
                    class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
            </div>

            <div>
                <label class="text-sm font-medium text-slate-600">End Time</label>
                <div class="relative mt-2">
                    <i data-lucide="clock" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input
                    type="time"
                    name="jam_selesai"
                    value="{{ old('jam_selesai') }}"
                    required
                    class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
            </div>

            <div>
                <label class="text-sm font-medium text-slate-600">Daily Quota</label>
                <div class="relative mt-2">
                    <i data-lucide="users" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input
                    type="number"
                    name="kuota_harian"
                    value="{{ old('kuota_harian') }}"
                    required
                    min="1"
                    placeholder="e.g. 20"
                    class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
            </div>

        </div>

    </div>

    <!-- ACTIONS -->
    <div class="flex justify-end gap-3">
        
        <a href="{{ route('admin.schedule.index') }}"
        class="px-5 py-3 rounded-2xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition">
            Cancel
        </a>

        <button
        type="submit"
        class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition inline-flex items-center gap-2">
            <i data-lucide="save" class="w-4 h-4"></i>
            Save Schedule
        </button>
    </div>

    </form>

</div>

@endsection