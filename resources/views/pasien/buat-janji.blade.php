@extends('layouts.pasien')

@section('content')


<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-[32px] shadow-xl border border-slate-100 overflow-hidden">

        <!-- HEADER -->
        <div class="px-8 py-6 border-b border-slate-100">

            <h1 class="text-3xl font-bold text-slate-800">
                Make Appointment
            </h1>

            <p class="text-slate-400 mt-2">
                Fill your information before your appointment
            </p>

        </div>

        <!-- FORM -->
        <div class="p-8 grid lg:grid-cols-2 gap-8">

            <!-- PERSONAL -->
            <div>

                <div class="flex items-center gap-2 mb-6">

                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                        <i data-lucide="user" class="w-4 h-4 text-green-500"></i>
                    </div>

                    <h2 class="font-semibold text-slate-700">
                        Personal Information
                    </h2>

                </div>

                <div class="space-y-5">

                    <div>
                        <label class="text-sm text-slate-500">Name</label>

                        <input
                        type="text"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-400">
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm text-slate-500">
                                Date of Birth
                            </label>

                            <input
                            type="date"
                            class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">
                        </div>

                        <div>
                            <label class="text-sm text-slate-500">
                                Gender
                            </label>

                            <select
                            class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                                <option>Select</option>
                                <option>Male</option>
                                <option>Female</option>

                            </select>
                        </div>

                    </div>

                    <div>
                        <label class="text-sm text-slate-500">
                            Email
                        </label>

                        <input
                        type="email"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">
                    </div>

                </div>

            </div>

            <!-- APPOINTMENT -->
            <div>

                <div class="flex items-center gap-2 mb-6">

                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                        <i data-lucide="calendar-check" class="w-4 h-4 text-green-500"></i>
                    </div>

                    <h2 class="font-semibold text-slate-700">
                        Appointment Details
                    </h2>

                </div>

                <div class="space-y-5">

                    <div>
                        <label class="text-sm text-slate-500">
                            Select Date
                        </label>

                        <input
                        type="date"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">
                    </div>

                    <div>
                        <label class="text-sm text-slate-500">
                            Select Doctor
                        </label>

                        <select
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                            <option>Select Doctor</option>
                            <option>Dr. Andi</option>
                            <option>Dr. Sarah</option>

                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-slate-500">
                            Reason for Visit
                        </label>

                        <textarea
                        rows="5"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200"></textarea>
                    </div>

                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="px-8 pb-8">

            <a href="/janji-temu"
            class="w-full flex items-center justify-center py-4 rounded-2xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-semibold shadow-lg shadow-teal-200 hover:scale-[1.01] transition-all duration-300">

                Book Appointment

            </a>

        </div>

    </div>

</div>

@endsection