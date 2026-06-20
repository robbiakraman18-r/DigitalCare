@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
    <div id="success-alert"
        class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-3xl shadow-sm">

        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">

            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 13l4 4L19 7"/>

        </svg>

        {{ session('success') }}

    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');

            if(alert){

                alert.style.opacity="0";
                alert.style.transition="0.4s";

                setTimeout(()=>{
                    alert.remove();
                },400);

            }

        },3000);
    </script>

    @endif


    <!-- HEADER -->

    <div class="flex flex-col lg:flex-row justify-between items-center gap-5">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Appointment Management

            </h1>

            <p class="text-slate-400 mt-2">

                Manage appointments, patient queue and consultation status.

            </p>

        </div>

        <button
            onclick="document.getElementById('modalAppointment').classList.remove('hidden')"
            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-2xl text-white font-semibold shadow-lg transition">

            + New Appointment

        </button>

    </div>



    <!-- STATISTIC -->

    <div class="grid grid-cols-2 xl:grid-cols-5 gap-5">

        <div class="bg-white rounded-3xl shadow p-6">

            <p class="text-slate-400 text-sm">
                Today
            </p>

            <h2 class="text-3xl font-bold mt-2 text-slate-800">
                {{ $today }}
            </h2>

        </div>


        <div class="bg-yellow-50 rounded-3xl shadow p-6">

            <p class="text-yellow-600 text-sm">

                Pending

            </p>

            <h2 class="text-3xl font-bold mt-2 text-yellow-700">

                {{ $pending }}

            </h2>

        </div>



        <div class="bg-blue-50 rounded-3xl shadow p-6">

            <p class="text-blue-600 text-sm">

                Called

            </p>

            <h2 class="text-3xl font-bold mt-2 text-blue-700">

                {{ $called }}

            </h2>

        </div>



        <div class="bg-purple-50 rounded-3xl shadow p-6">

            <p class="text-purple-600 text-sm">

                Consultation

            </p>

            <h2 class="text-3xl font-bold mt-2 text-purple-700">

                {{ $consultation }}

            </h2>

        </div>



        <div class="bg-green-50 rounded-3xl shadow p-6">

            <p class="text-green-600 text-sm">

                Completed

            </p>

            <h2 class="text-3xl font-bold mt-2 text-green-700">

                {{ $completed }}

            </h2>

        </div>

    </div>

    <!-- SEARCH & FILTER -->

<div class="bg-white rounded-3xl shadow p-6">

    <div class="flex flex-col lg:flex-row gap-4">

        <!-- SEARCH -->

        <div class="flex-1 relative">

            <input
                type="text"
                id="searchAppointment"
                placeholder="Search patient, doctor or queue number..."
                class="w-full border border-slate-200 rounded-2xl pl-12 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 absolute left-4 top-3.5 text-slate-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>

            </svg>

        </div>

        <!-- FILTER STATUS -->

        <select id="statusFilter"
            class="border border-slate-200 rounded-2xl px-4 py-3">

            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="called">Called</option>
            <option value="in_consultation">Consultation</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>

        </select>

        <!-- RESET -->

        <button
            onclick="location.reload()"
            class="px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 font-semibold">

            Reset

        </button>

    </div>
    
</div>
<!-- APPOINTMENT TABLE -->

<div class="bg-white rounded-3xl shadow overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left font-semibold text-slate-500">
                        Queue
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-slate-500">
                        Patient
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-slate-500">
                        Doctor
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-slate-500">
                        Schedule
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-slate-500">
                        Complaint
                    </th>

                    <th class="px-6 py-4 text-center font-semibold text-slate-500">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center font-semibold text-slate-500">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody id="appointmentTable">

                @forelse($appointments as $appointment)

                <tr class="border-b hover:bg-slate-50 transition">

                    <!-- QUEUE -->

                    <td class="px-6 py-5">

                        <span class="font-bold text-indigo-600 text-lg">

                            #{{ str_pad($appointment->nomor_antrian,3,'0',STR_PAD_LEFT) }}

                        </span>

                    </td>

                    <!-- PATIENT -->

                    <td class="px-6 py-5">

                        <div class="font-semibold">

                            {{ $appointment->pasien->user->nama ?? '-' }}

                        </div>

                    </td>

                    <!-- DOCTOR -->

                    <td class="px-6 py-5">

                        {{ $appointment->dokter->user->nama ?? '-' }}

                    </td>

                    <!-- SCHEDULE -->

                    <td class="px-6 py-5">

                        <div>

                            {{ $appointment->jadwal->tanggal ?? '-' }}

                        </div>

                        <div class="text-xs text-slate-400">

                            {{ $appointment->jadwal->jam_mulai ?? '' }}
                            -
                            {{ $appointment->jadwal->jam_selesai ?? '' }}

                        </div>

                    </td>

                    <!-- COMPLAINT -->

                    <td class="px-6 py-5">

                        {{ Str::limit($appointment->keluhan_utama,30) }}

                    </td>

                    <!-- STATUS -->

                    <td class="px-6 py-5 text-center">

                        @if($appointment->status_janji=="pending")

                            <span class="px-3 py-2 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                Pending
                            </span>

                        @elseif($appointment->status_janji=="called")

                            <span class="px-3 py-2 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                Called
                            </span>

                        @elseif($appointment->status_janji=="in_consultation")

                            <span class="px-3 py-2 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">
                                Consultation
                            </span>

                        @elseif($appointment->status_janji=="completed")

                            <span class="px-3 py-2 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                Completed
                            </span>

                        @else

                            <span class="px-3 py-2 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                Cancelled
                            </span>

                        @endif

                    </td>

                    <!-- ACTION -->

                    <td class="px-6 py-5">

                        <div class="flex justify-center gap-2">

                            <form
                                action="{{ route('admin.appointment.status',$appointment->id_janji) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <select
                                    name="status_janji"
                                    onchange="this.form.submit()"
                                    class="border rounded-xl px-2 py-2 text-xs">

                                    <option value="pending"
                                    {{ $appointment->status_janji=="pending"?'selected':'' }}>
                                        Pending
                                    </option>

                                    <option value="called"
                                    {{ $appointment->status_janji=="called"?'selected':'' }}>
                                        Called
                                    </option>

                                    <option value="in_consultation"
                                    {{ $appointment->status_janji=="in_consultation"?'selected':'' }}>
                                        Consultation
                                    </option>

                                    <option value="completed"
                                    {{ $appointment->status_janji=="completed"?'selected':'' }}>
                                        Completed
                                    </option>

                                    <option value="cancelled"
                                    {{ $appointment->status_janji=="cancelled"?'selected':'' }}>
                                        Cancelled
                                    </option>

                                </select>

                            </form>

                            <form
                                action="{{ route('admin.appointment.delete',$appointment->id_janji) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete appointment?')"
                                    class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100">

                                    🗑️

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="py-14 text-center text-slate-400">

                        No appointment data available.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

@endsection