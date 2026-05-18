@extends('layouts.dokter')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div>

        <h1 class="text-3xl font-bold text-slate-800">
            Doctor Profile
        </h1>

        <p class="text-slate-400 mt-1">
            Doctor profile information at DigitalCare.
        </p>

    </div>

    <!-- PROFILE CARD -->
    <div class="bg-gradient-to-r from-teal-500 to-cyan-500 rounded-[32px] p-8 text-white shadow-xl relative overflow-hidden">

        <div class="absolute -top-10 -right-10 w-52 h-52 rounded-full bg-white/10"></div>
        <div class="absolute bottom-0 right-20 w-32 h-32 rounded-full bg-white/10"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center gap-6">

            <img
            src="https://i.pravatar.cc/150?img=12"
            class="w-32 h-32 rounded-3xl border-4 border-white/30 object-cover">

            <div class="flex-1">

                <h2 class="text-4xl font-bold">
                    Dr. Rizki Ramadhan
                </h2>

                <p class="text-teal-100 mt-2 text-lg">
                    General Practitioner • DigitalCare Clinic
                </p>

                <div class="flex flex-wrap gap-3 mt-5">

                    <span class="px-4 py-2 rounded-xl bg-white/20 text-sm font-semibold">
                        Active
                    </span>

                    <span class="px-4 py-2 rounded-xl bg-white/20 text-sm font-semibold">
                        5 Years of Experience
                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- PERSONAL -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-7">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-2xl bg-teal-100 flex items-center justify-center">

                    <i data-lucide="user" class="w-6 h-6 text-teal-500"></i>

                </div>

                <div>

                    <h2 class="text-xl font-bold text-slate-800">
                        Personal Information
                    </h2>

                    <p class="text-sm text-slate-400">
                        Registered doctor data
                    </p>

                </div>

            </div>

            <div class="space-y-5">

                <div class="flex justify-between border-b pb-4">

                    <span class="text-slate-400">
                        Full Name
                    </span>

                    <span class="font-semibold text-slate-700">
                        Dr. Rizki Ramadhan
                    </span>

                </div>

                <div class="flex justify-between border-b pb-4">

                    <span class="text-slate-400">
                        Gender
                    </span>

                    <span class="font-semibold text-slate-700">
                        Male
                    </span>

                </div>

                <div class="flex justify-between border-b pb-4">

                    <span class="text-slate-400">
                        Date of Birth
                    </span>

                    <span class="font-semibold text-slate-700">
                        12 May 1995
                    </span>

                </div>

                <div class="flex justify-between border-b pb-4">

                    <span class="text-slate-400">
                        Email
                    </span>

                    <span class="font-semibold text-slate-700">
                        dokter@digitalcare.com
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-400">
                        Phone Number
                    </span>

                    <span class="font-semibold text-slate-700">
                        0812-3456-7890
                    </span>

                </div>

            </div>

        </div>

        <!-- PROFESSIONAL -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-7">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="stethoscope" class="w-6 h-6 text-cyan-500"></i>

                </div>

                <div>

                    <h2 class="text-xl font-bold text-slate-800">
                        Professional Information
                    </h2>

                    <p class="text-sm text-slate-400">
                        Doctor profession data
                    </p>

                </div>

            </div>

            <div class="space-y-5">

                <div class="flex justify-between border-b pb-4">

                    <span class="text-slate-400">
                        Doctor ID
                    </span>

                    <span class="font-semibold text-slate-700">
                        D-001
                    </span>

                </div>

                <div class="flex justify-between border-b pb-4">

                    <span class="text-slate-400">
                        Specialization
                    </span>

                    <span class="font-semibold text-slate-700">
                        General Practitioner
                    </span>

                </div>

                <div class="flex justify-between border-b pb-4">

                    <span class="text-slate-400">
                        Practice Schedule
                    </span>

                    <span class="font-semibold text-slate-700">
                        Monday - Saturday
                    </span>

                </div>

                <div class="flex justify-between border-b pb-4">

                    <span class="text-slate-400">
                        Practice Hours
                    </span>

                    <span class="font-semibold text-slate-700">
                        08:00 - 21:00
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-400">
                        Status
                    </span>

                    <span class="font-semibold text-green-600">
                        Active
                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- STATISTIC -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Total Patients
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        120
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-teal-100 flex items-center justify-center">

                    <i data-lucide="users" class="w-7 h-7 text-teal-500"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Appointments
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        89
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="calendar-days" class="w-7 h-7 text-cyan-500"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Medical Records
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        240
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                    <i data-lucide="file-heart" class="w-7 h-7 text-red-500"></i>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection