@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- TOP -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Appointments
            </h1>

            @if(session('success'))
                <div class="mt-4 px-4 py-3 rounded-2xl bg-green-100 border border-green-300 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <p class="text-slate-400 mt-1">
                View and manage patient appointments.
            </p>
        </div>

        <div class="flex items-center gap-3">

            <button class="px-5 py-3 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition">
                Export
            </button>

            <button onclick="document.getElementById('modalAppointment').classList.remove('hidden')"
                class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                + New Appointment
            </button>

        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Appointment ID</th>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Date & Time</th>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Patient</th>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Doctor</th>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Department</th>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Type</th>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Status</th>
                        <th class="px-6 py-4 text-center text-sm text-slate-400">Actions</th>
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
                            {{ $appointment->pasien->nama ?? '-' }}
                        </td>

                        <td class="px-6 py-5">
                            {{ $appointment->dokter->nama ?? '-' }}
                        </td>

                        <td class="px-6 py-5">Klinik</td>

                        <td class="px-6 py-5">
                            {{ $appointment->keluhan_utama }}
                        </td>

                        <td class="px-6 py-5">
                            <form action="{{ route('admin.appointment.status', $appointment->id_janji) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <select name="status_janji" onchange="this.form.submit()"
                                    class="px-3 py-2 rounded-xl border border-slate-200">

                                    <option value="Menunggu" {{ $appointment->status_janji == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Dipanggil" {{ $appointment->status_janji == 'Dipanggil' ? 'selected' : '' }}>Dipanggil</option>
                                    <option value="Selesai" {{ $appointment->status_janji == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Batal" {{ $appointment->status_janji == 'Batal' ? 'selected' : '' }}>Batal</option>

                                </select>
                            </form>
                        </td>

                        <td class="px-6 py-5">
                            <form action="{{ route('admin.appointment.delete', $appointment->id_janji) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus antrean ini?')"
                                    class="w-9 h-9 rounded-xl border border-red-200 flex items-center justify-center hover:bg-red-100">

                                    <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>

                                </button>
                            </form>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center py-10 text-slate-400">
                            Belum ada appointment pasien
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL -->
<div id="modalAppointment"
class="fixed inset-0 hidden z-50 bg-black/40 flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-lg rounded-3xl p-8 shadow-2xl">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold">Confirm Appointment</h2>

            <button onclick="document.getElementById('modalAppointment').classList.add('hidden')"
                class="text-slate-500 text-2xl hover:text-slate-700">
                ×
            </button>

        </div>

        <form action="{{ route('admin.appointment.store') }}" method="POST">
            @csrf

            <input type="text" name="nama_pasien" placeholder="Nama Pasien"
                class="w-full mb-3 border rounded-2xl px-4 py-3">

            <input type="text" name="nama_dokter" placeholder="Nama Dokter"
                class="w-full mb-3 border rounded-2xl px-4 py-3">

            <input type="date" name="tanggal_janji"
                class="w-full mb-3 border rounded-2xl px-4 py-3">

            <input type="time" name="jam_janji"
                class="w-full mb-3 border rounded-2xl px-4 py-3">

            <textarea name="keluhan_utama" placeholder="Keluhan"
                class="w-full mb-4 border rounded-2xl px-4 py-3"></textarea>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition">
                Confirm Appointment
            </button>

        </form>

    </div>
</div>

@endsection