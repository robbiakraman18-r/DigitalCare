@extends('layouts.dokter')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Medical Records
            </h1>

            <p class="text-slate-400 mt-1">
                Patient examination and treatment history.
            </p>

        </div>

        <a
        href="/dokter-pasien"
        class="px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 font-semibold transition">

            Back

        </a>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-7">

        <div class="flex items-center gap-5 pb-6 border-b">

            <img
            src="https://i.pravatar.cc/120?img=12"
            class="w-20 h-20 rounded-3xl object-cover">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Ahmad Fauzi
                </h2>

                <p class="text-slate-400 mt-1">
                    Patient Consultation History
                </p>

            </div>

        </div>

        <!-- HISTORY -->
        <div class="mt-7 space-y-5">

            <!-- ITEM -->
            <div class="rounded-3xl border border-slate-100 p-5 bg-slate-50">

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-bold text-slate-800">
                            General Examination
                        </h3>

                        <p class="text-sm text-slate-400 mt-1">
                            20 May 2026 • 08:00 AM
                        </p>

                    </div>

                    <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                        Completed
                    </span>

                </div>

                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <p class="text-sm text-slate-400 mb-2">
                            Complaint
                        </p>

                        <p class="font-medium text-slate-700">
                            Fever & Cough
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-400 mb-2">
                            Diagnosis
                        </p>

                        <p class="font-medium text-slate-700">
                            Mild Flu
                        </p>

                    </div>

                </div>

                <div class="mt-5">

                    <p class="text-sm text-slate-400 mb-2">
                        Doctor's Notes
                    </p>

                    <p class="text-slate-700 leading-relaxed">
                        The patient is advised to get enough rest, drink warm water,
                        and take medication regularly for 3 days.
                    </p>

                </div>

            </div>

            <!-- ITEM -->
            <div class="rounded-3xl border border-slate-100 p-5 bg-slate-50">

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-bold text-slate-800">
                            Follow-Up Consultation
                        </h3>

                        <p class="text-sm text-slate-400 mt-1">
                            18 May 2026 • 10:00 AM
                        </p>

                    </div>

                    <span class="px-4 py-2 rounded-xl bg-cyan-100 text-cyan-600 text-xs font-semibold">
                        Follow Up
                    </span>

                </div>

                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <p class="text-sm text-slate-400 mb-2">
                            Complaint
                        </p>

                        <p class="font-medium text-slate-700">
                            Sore Throat
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-400 mb-2">
                            Diagnosis
                        </p>

                        <p class="font-medium text-slate-700">
                            Throat Irritation
                        </p>

                    </div>

                </div>

                <div class="mt-5">

                    <p class="text-sm text-slate-400 mb-2">
                        Doctor's Notes
                    </p>

                    <p class="text-slate-700 leading-relaxed">
                        The patient is advised to reduce cold drinks intake
                        and get more rest.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection