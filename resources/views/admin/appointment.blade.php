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

@forelse($appointments as $appointment)

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">

    <td class="px-6 py-5 font-medium text-slate-700">
        #{{ $appointment->nomor_antrian }}
    </td>

    <td class="px-6 py-5 text-slate-600">
        {{ $appointment->tanggal_janji }}
    </td>

    <td class="px-6 py-5">
        <div>

            <h3 class="font-semibold text-slate-800">
                {{ $appointment->pasien->nama ?? '-' }}
            </h3>

            <p class="text-sm text-slate-400">
                ID: {{ $appointment->id_pasien }}
            </p>

        </div>
    </td>

    <td class="px-6 py-5 text-slate-600">
        {{ $appointment->dokter->nama ?? '-' }}
    </td>

    <td class="px-6 py-5 text-slate-600">
        Klinik
    </td>

    <td class="px-6 py-5 text-slate-600">
        {{ $appointment->keluhan_utama }}
    </td>

    <td class="px-6 py-5">

        <form action="{{ route('admin.appointment.status', $appointment->id_janji) }}"
        method="POST">

            @csrf
            @method('PUT')

            <select
                name="status_janji"
                onchange="this.form.submit()"
                class="px-3 py-2 rounded-xl border border-slate-200">

                <option value="Menunggu"
                {{ $appointment->status_janji == 'Menunggu' ? 'selected' : '' }}>
                    Menunggu
                </option>

                <option value="Dipanggil"
                {{ $appointment->status_janji == 'Dipanggil' ? 'selected' : '' }}>
                    Dipanggil
                </option>

                <option value="Selesai"
                {{ $appointment->status_janji == 'Selesai' ? 'selected' : '' }}>
                    Selesai
                </option>

                <option value="Batal"
                {{ $appointment->status_janji == 'Batal' ? 'selected' : '' }}>
                    Batal
                </option>

            </select>

        </form>

    </td>

    <td class="px-6 py-5">

        <form action="{{ route('admin.appointment.delete', $appointment->id_janji) }}"
        method="POST">

            @csrf
            @method('DELETE')

            <button
            onclick="return confirm('Hapus antrean ini?')"
            class="w-9 h-9 rounded-xl border border-red-200 flex items-center justify-center hover:bg-red-100">

                <i data-lucide="trash-2"
                class="w-4 h-4 text-red-500"></i>

            </button>

        </form>

    </td>

</tr>

@empty

<tr>
    <td colspan="8"
    class="text-center py-10 text-slate-400">
        Belum ada appointment pasien
    </td>
</tr>

@endforelse

</tbody>

            </table>

        </div>

    </div>

</div>

@endsection