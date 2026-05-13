@extends('layouts.pasien')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-[32px] shadow-xl border border-slate-100 overflow-hidden">

        <!-- HEADER -->
        <div class="px-8 py-6 border-b border-slate-100">

            <h1 class="text-3xl font-bold text-slate-800">
                Booking Number
            </h1>

            <p class="text-slate-400 mt-2">
                Your current queue number
            </p>

        </div>

        <div class="p-8">

            <!-- STATUS -->
            <div class="bg-teal-50 rounded-3xl p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Appointment Status
                        </p>

                        <h2 class="text-2xl font-bold text-teal-600 mt-2">
                            Booking Confirmation
                        </h2>

                    </div>

                    <div class="w-16 h-16 rounded-3xl bg-white flex items-center justify-center shadow">
                        <i data-lucide="badge-check" class="text-teal-500"></i>
                    </div>

                </div>

            </div>

            <!-- NUMBER -->
            <div class="mt-8 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-[32px] p-10 text-center text-white shadow-xl">

                <p class="text-lg opacity-80">
                    Queue Number
                </p>

                <h1 class="text-7xl font-extrabold mt-4">
                    D01-001
                </h1>

                <p class="mt-5 text-white/80">
                    Waiting to be called
                </p>

            </div>

            <!-- DETAIL -->
            <div class="grid md:grid-cols-3 gap-5 mt-8">

                <div class="bg-slate-50 rounded-3xl p-5">

                    <p class="text-sm text-slate-400">
                        Doctor
                    </p>

                    <h3 class="font-bold text-slate-700 mt-2">
                        Dr. Andi
                    </h3>

                </div>

                <div class="bg-slate-50 rounded-3xl p-5">

                    <p class="text-sm text-slate-400">
                        Schedule
                    </p>

                    <h3 class="font-bold text-slate-700 mt-2">
                        10:30 AM
                    </h3>

                </div>

                <div class="bg-slate-50 rounded-3xl p-5">

                    <p class="text-sm text-slate-400">
                        Room
                    </p>

                    <h3 class="font-bold text-slate-700 mt-2">
                        A-02
                    </h3>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-8">

                <a href="/on-going"
                class="w-full flex items-center justify-center py-4 rounded-2xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-semibold shadow-lg shadow-teal-200 hover:scale-[1.01] transition-all duration-300">

                    Continue

                </a>

            </div>

        </div>

    </div>

</div>

@endsection