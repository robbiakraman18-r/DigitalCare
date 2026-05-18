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
            <div class="flex items-center justify-between mb-6">

                <div>

                    <h3 class="font-semibold text-slate-800">
                        This Week
                    </h3>

                    <p class="text-sm text-slate-400 mt-1">
                        20 - 21 May 2026
                    </p>

                </div>

                <button
                class="px-4 py-2 rounded-2xl bg-teal-50 text-teal-600 text-sm font-medium hover:bg-teal-100 transition">

                    Next Day →

                </button>

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

                        <tr>

                            <td class="py-4 px-4 font-medium text-slate-700">
                                Today
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                20 May 2026
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                08.00 - 16.00
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                20 Patients
                            </td>

                            <td class="py-4 px-4">

                                <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                    Active
                                </span>

                            </td>

                        </tr>

                        <tr>

                            <td class="py-4 px-4 font-medium text-slate-700">
                                Tomorrow
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                21 May 2026
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                08.00 - 16.00
                            </td>

                            <td class="py-4 px-4 text-slate-500">
                                15 Patients
                            </td>

                            <td class="py-4 px-4">

                                <span class="px-3 py-1 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                    Pending
                                </span>

                            </td>

                        </tr>

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