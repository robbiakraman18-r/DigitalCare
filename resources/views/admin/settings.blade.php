{{-- resources/views/admin/settings.blade.php --}}

@extends('layouts.admin')

@section('title', 'Settings')
@section('subtitle', 'Manage clinic system settings and preferences.')

@section('content')

<div
x-data="{
    saveModal:false
}"
class="space-y-6">

    <!-- TOP -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        System Status
                    </p>

                    <h2 class="text-2xl font-bold text-green-500 mt-2">
                        Online
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i data-lucide="server" class="w-6 h-6 text-green-600"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Active Users
                    </p>

                    <h2 class="text-2xl font-bold text-slate-800 mt-2">
                        1,284
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Database
                    </p>

                    <h2 class="text-2xl font-bold text-cyan-500 mt-2">
                        Stable
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="database" class="w-6 h-6 text-cyan-600"></i>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Security
                    </p>

                    <h2 class="text-2xl font-bold text-yellow-500 mt-2">
                        Protected
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                    <i data-lucide="shield-check" class="w-6 h-6 text-yellow-600"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- SETTINGS -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="xl:col-span-2 space-y-6">

            <!-- CLINIC -->
            <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-12 h-12 rounded-2xl bg-teal-100 flex items-center justify-center">

                        <i data-lucide="building-2" class="w-6 h-6 text-teal-600"></i>

                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">
                            Clinic Information
                        </h2>

                        <p class="text-sm text-slate-400">
                            Manage clinic details
                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- INPUT -->
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Clinic Name
                        </label>

                        <input
                        type="text"
                        value="DoctorCare Clinic"
                        class="mt-2 w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500">

                    </div>

                    <!-- INPUT -->
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Phone Number
                        </label>

                        <input
                        type="text"
                        value="+62 812 3456 7890"
                        class="mt-2 w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500">

                    </div>

                    <!-- INPUT -->
                    <div class="md:col-span-2">

                        <label class="text-sm font-semibold text-slate-700">
                            Address
                        </label>

                        <textarea
                        rows="4"
                        class="mt-2 w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500">Batam Center, Batam City, Indonesia</textarea>

                    </div>

                </div>

            </div>

            <!-- SYSTEM -->
            <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">

                        <i data-lucide="monitor-cog" class="w-6 h-6 text-blue-600"></i>

                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">
                            System Preferences
                        </h2>

                        <p class="text-sm text-slate-400">
                            Configure dashboard system
                        </p>

                    </div>

                </div>

                <div class="space-y-5">

                    <!-- ITEM -->
                    <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50">

                        <div>

                            <h3 class="font-semibold text-slate-800">
                                Email Notifications
                            </h3>

                            <p class="text-sm text-slate-400 mt-1">
                                Receive clinic activity notifications
                            </p>

                        </div>

                        <label class="relative inline-flex items-center cursor-pointer">

                            <input type="checkbox" checked class="sr-only peer">

                            <div class="w-14 h-7 bg-slate-200 rounded-full peer peer-checked:bg-teal-500 transition"></div>

                            <div class="absolute left-1 top-1 w-5 h-5 bg-white rounded-full transition peer-checked:translate-x-7"></div>

                        </label>

                    </div>

                    <!-- ITEM -->
                    <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50">

                        <div>

                            <h3 class="font-semibold text-slate-800">
                                Auto Backup
                            </h3>

                            <p class="text-sm text-slate-400 mt-1">
                                Backup system database automatically
                            </p>

                        </div>

                        <label class="relative inline-flex items-center cursor-pointer">

                            <input type="checkbox" checked class="sr-only peer">

                            <div class="w-14 h-7 bg-slate-200 rounded-full peer peer-checked:bg-teal-500 transition"></div>

                            <div class="absolute left-1 top-1 w-5 h-5 bg-white rounded-full transition peer-checked:translate-x-7"></div>

                        </label>

                    </div>

                    <!-- ITEM -->
                    <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50">

                        <div>

                            <h3 class="font-semibold text-slate-800">
                                Maintenance Mode
                            </h3>

                            <p class="text-sm text-slate-400 mt-1">
                                Temporarily disable system access
                            </p>

                        </div>

                        <label class="relative inline-flex items-center cursor-pointer">

                            <input type="checkbox" class="sr-only peer">

                            <div class="w-14 h-7 bg-slate-200 rounded-full peer peer-checked:bg-red-500 transition"></div>

                            <div class="absolute left-1 top-1 w-5 h-5 bg-white rounded-full transition peer-checked:translate-x-7"></div>

                        </label>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-6">

            <!-- ADMIN PROFILE -->
            <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

                <div class="text-center">

                    <img
                    src="https://i.pravatar.cc/120?img=68"
                    class="w-24 h-24 rounded-3xl mx-auto object-cover">

                    <h2 class="text-xl font-bold text-slate-800 mt-4">
                        Admin Clinic
                    </h2>

                    <p class="text-sm text-slate-400">
                        Super Administrator
                    </p>

                </div>

                <div class="mt-6 space-y-4">

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            ID Admin
                        </span>

                        <span class="font-semibold text-slate-700">
                            ADM-001
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            Email
                        </span>

                        <span class="font-semibold text-slate-700">
                            admin@clinic.com
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">
                            Status
                        </span>

                        <span class="font-semibold text-green-500">
                            Active
                        </span>

                    </div>

                </div>

            </div>

            <!-- SECURITY -->
            <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center">

                        <i data-lucide="shield-alert" class="w-6 h-6 text-red-500"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            Security
                        </h2>

                        <p class="text-sm text-slate-400">
                            Account protection
                        </p>

                    </div>

                </div>

                <div class="space-y-4">

                    <button class="w-full py-4 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
                        Change Password
                    </button>

                    <button class="w-full py-4 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold transition">
                        Logout All Devices
                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- SAVE -->
    <div class="flex justify-end">

        <button
        @click="saveModal=true"
        class="px-8 py-4 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold shadow-lg shadow-teal-200 transition">

            Save Settings

        </button>

    </div>

    <!-- MODAL -->
    <div
    x-show="saveModal"
    x-transition
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 p-5"
    style="display:none;">

        <div
        @click.away="saveModal=false"
        class="bg-white w-full max-w-md rounded-[32px] p-8 text-center shadow-2xl">

            <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mx-auto">

                <i data-lucide="check" class="w-10 h-10 text-green-600"></i>

            </div>

            <h2 class="text-2xl font-bold text-slate-800 mt-5">
                Settings Saved
            </h2>

            <p class="text-slate-400 mt-2">
                System settings updated successfully.
            </p>

            <button
            @click="saveModal=false"
            class="mt-6 w-full py-4 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold transition">

                Done

            </button>

        </div>

    </div>

</div>

@endsection