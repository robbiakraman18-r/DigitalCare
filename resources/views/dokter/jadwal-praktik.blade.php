@extends('layouts.dokter')
@section('content')

<div class="space-y-6">

    <!-- HEADER CARD -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

        <!-- TOP -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 px-6 py-5 text-white">

            <h2 class="text-2xl font-bold">
                Practice Schedule
            </h2>

            <p class="text-sm text-teal-100 mt-1">
                Practice schedule for today and tomorrow.
            </p>

        </div>

        <!-- CONTENT -->
        <div class="p-6">

            <!-- FILTER -->
            <!-- DATE PICKER -->
<div class="mb-6">

    <form method="GET">

        <label class="block text-sm font-medium text-slate-600 mb-2">
            Select Schedule Date
        </label>

        <input
            type="date"
            name="tanggal"
            min="{{ now()->format('Y-m-d') }}"
            value="{{ request('tanggal', now()->format('Y-m-d')) }}"
            onchange="this.form.submit()"
            class="px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-400"
        >

    </form>

</div>

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="bg-slate-50 text-slate-500">

                            <th class="text-left py-4 px-4 rounded-l-2xl">
                                Day
                            </th>

                            <th class="text-left py-4 px-4">
                                Date
                            </th>

                            <th class="text-left py-4 px-4">
                                Practice Hours
                            </th>

                            <th class="text-left py-4 px-4">
                                Quota
                            </th>

                            <th class="text-left py-4 px-4 rounded-r-2xl">
                                Status
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y">

    @foreach($jadwal as $item)

    <tr>

        <!-- HARI -->
        <td class="py-4 px-4 font-medium text-slate-700">
            {{ $item->hari }}
        </td>

        <!-- TANGGAL -->
        <td class="py-4 px-4 text-slate-500">
            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
        </td>

        <!-- JAM -->
        <td class="py-4 px-4 text-slate-500">
            {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H.i') }}
            -
            {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H.i') }}
        </td>

        <!-- KUOTA -->
        <td class="py-4 px-4 text-slate-500">
            {{ $item->terisi }}/{{ $item->kuota_harian }} Patients
        </td>

        <!-- STATUS -->
        <td class="py-4 px-4">

            @if($item->status_jadwal == 'Available')

                <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                    Available
                </span>

            @elseif($item->status_jadwal == 'Full')

                <span class="px-3 py-1 rounded-xl bg-red-100 text-red-600 text-xs font-semibold">
                    Full
                </span>

            @else

                <span class="px-3 py-1 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                    Closed
                </span>

            @endif

        </td>

    </tr>

    @endforeach

</tbody>

                </table>

            </div>

            <!-- INFO -->
            <div class="mt-8 rounded-2xl bg-cyan-50 px-5 py-4 flex items-center gap-3">

                <div class="w-8 h-8 rounded-full bg-cyan-500 flex items-center justify-center text-white">
                    <i data-lucide="info" class="w-4 h-4"></i>
                </div>

                <p class="text-sm text-slate-600">
                    The schedule may change according to clinic needs.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection