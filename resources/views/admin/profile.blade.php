{{-- resources/views/admin/profile.blade.php --}}

@extends('layouts.admin')

@section('title', 'Admin Profile')
@section('subtitle', 'Administrator account information and activity.')

@section('content')

<div class="space-y-6">

    <!-- PROFILE TOP -->
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- COVER -->
        <div class="h-52 bg-gradient-to-r from-teal-500 via-cyan-500 to-blue-500 relative">

            <!-- IMAGE -->
            <div class="absolute -bottom-16 left-8">

                <img
                src="https://i.pravatar.cc/200?img=68"
                class="w-32 h-32 rounded-[30px] border-4 border-white object-cover shadow-xl">

            </div>

        </div>

        <!-- CONTENT -->
        <div class="pt-20 pb-8 px-8">

            <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-6">

                <!-- LEFT -->
                <div>

                    <h1 class="text-3xl font-bold text-slate-800">
                        Admin Clinic
                    </h1>

                    <p class="text-slate-400 mt-2">
                        Super Administrator • DoctorCare System
                    </p>

                    <div class="flex flex-wrap items-center gap-3 mt-5">

                        <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-sm font-semibold">
                            Active
                        </span>

                        <span class="px-4 py-2 rounded-xl bg-blue-100 text-blue-600 text-sm font-semibold">
                            Full Access
                        </span>

                        <span class="px-4 py-2 rounded-xl bg-cyan-100 text-cyan-600 text-sm font-semibold">
                            Verified
                        </span>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="flex flex-wrap gap-3">

                    <button class="px-6 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
                        Edit Profile
                    </button>

                    <button class="px-6 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold transition shadow-lg shadow-teal-200">
                        Change Password
                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- INFO -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="xl:col-span-2 space-y-6">

            <!-- PERSONAL -->
            <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-12 h-12 rounded-2xl bg-teal-100 flex items-center justify-center">

                        <i data-lucide="user" class="w-6 h-6 text-teal-600"></i>

                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">
                            Personal Information
                        </h2>

                        <p class="text-sm text-slate-400">
                            Administrator personal data
                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- ITEM -->
                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Full Name
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            Admin Clinic
                        </h3>

                    </div>

                    <!-- ITEM -->
                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Email Address
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            admin@doctorcare.com
                        </h3>

                    </div>

                    <!-- ITEM -->
                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Phone Number
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            +62 812 3456 7890
                        </h3>

                    </div>

                    <!-- ITEM -->
                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Admin ID
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            ADM-001
                        </h3>

                    </div>

                    <!-- ITEM -->
                    <div class="md:col-span-2 bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Address
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            Batam Center, Batam City, Indonesia
                        </h3>

                    </div>

                </div>

            </div>

            <!-- ACTIVITY -->
            <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">

                        <i data-lucide="activity" class="w-6 h-6 text-blue-600"></i>

                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">
                            Recent Activity
                        </h2>

                        <p class="text-sm text-slate-400">
                            Latest administrator actions
                        </p>

                    </div>

                </div>

                <div class="space-y-5">

                    <!-- ITEM -->
                    <div class="flex gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center shrink-0">

                            <i data-lucide="badge-check" class="w-5 h-5 text-green-600"></i>

                        </div>

                        <div>

                            <h3 class="font-semibold text-slate-800">
                                Payment Confirmed
                            </h3>

                            <p class="text-sm text-slate-400 mt-1">
                                Confirmed patient cash payment successfully.
                            </p>

                            <span class="text-xs text-slate-400 mt-2 block">
                                10 minutes ago
                            </span>

                        </div>

                    </div>

                    <!-- ITEM -->
                    <div class="flex gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">

                            <i data-lucide="calendar-check-2" class="w-5 h-5 text-blue-600"></i>

                        </div>

                        <div>

                            <h3 class="font-semibold text-slate-800">
                                Appointment Updated
                            </h3>

                            <p class="text-sm text-slate-400 mt-1">
                                Updated clinic appointment schedule.
                            </p>

                            <span class="text-xs text-slate-400 mt-2 block">
                                1 hour ago
                            </span>

                        </div>

                    </div>

                    <!-- ITEM -->
                    <div class="flex gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-cyan-100 flex items-center justify-center shrink-0">

                            <i data-lucide="users" class="w-5 h-5 text-cyan-600"></i>

                        </div>

                        <div>

                            <h3 class="font-semibold text-slate-800">
                                New User Added
                            </h3>

                            <p class="text-sm text-slate-400 mt-1">
                                Added new doctor account to the system.
                            </p>

                            <span class="text-xs text-slate-400 mt-2 block">
                                3 hours ago
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-6">

            <!-- ACCOUNT -->
            <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-12 h-12 rounded-2xl bg-yellow-100 flex items-center justify-center">

                        <i data-lucide="shield-check" class="w-6 h-6 text-yellow-600"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            Account Status
                        </h2>

                        <p class="text-sm text-slate-400">
                            Security & permissions
                        </p>

                    </div>

                </div>

                <div class="space-y-5">

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            Role
                        </span>

                        <span class="font-semibold text-slate-700">
                            Super Admin
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            Access Level
                        </span>

                        <span class="font-semibold text-teal-500">
                            Full Access
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            Last Login
                        </span>

                        <span class="font-semibold text-slate-700">
                            Today
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            Status
                        </span>

                        <span class="font-semibold text-green-500">
                            Online
                        </span>

                    </div>

                </div>

            </div>

            <!-- SYSTEM -->
            <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center">

                        <i data-lucide="monitor-smartphone" class="w-6 h-6 text-red-500"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            System Info
                        </h2>

                        <p class="text-sm text-slate-400">
                            Device & login activity
                        </p>

                    </div>

                </div>

                <div class="space-y-5">

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Browser
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            Google Chrome
                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Device
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            Windows Desktop
                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            IP Address
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            192.168.1.1
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection