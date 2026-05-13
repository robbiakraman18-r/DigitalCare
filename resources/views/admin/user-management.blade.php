@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- TOP -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                User Management
            </h1>

            <p class="text-slate-400 mt-1">
                Manage system users, roles and permissions.
            </p>

        </div>

        <div class="flex items-center gap-3">

            <button
            class="px-5 py-3 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold transition">

                Roles & Permissions

            </button>

            <button
            class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                + Add User

            </button>

        </div>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Total Users
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        56
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        +12 this month
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Doctors
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        18
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        +4 this month
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="stethoscope" class="w-6 h-6 text-cyan-600"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Staff
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        26
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        +6 this month
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">

                    <i data-lucide="briefcase" class="w-6 h-6 text-slate-600"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Active Users
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        48
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        +10% from last month
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i data-lucide="user-check" class="w-6 h-6 text-green-600"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- FILTER -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-5 border-b border-slate-100">

            <div class="relative w-full lg:w-96">

                <i data-lucide="search"
                class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                <input
                type="text"
                placeholder="Search users..."
                class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>

            <div class="flex items-center gap-3">

                <select class="px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 text-slate-700">

                    <option>All Roles</option>

                </select>

                <select class="px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 text-slate-700">

                    <option>All Status</option>

                </select>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            User
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Role
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Department
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Last Login
                        </th>

                        <th class="px-6 py-4 text-center text-sm text-slate-400">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img src="https://i.pravatar.cc/100?img=12"
                                class="w-11 h-11 rounded-2xl object-cover">

                                <div>

                                    <h3 class="font-semibold text-slate-800">
                                        Dr. Emily Carter
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        EMP-001
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5">

                            <span class="px-3 py-1 rounded-xl bg-blue-100 text-blue-600 text-xs font-semibold">
                                Doctor
                            </span>

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            Cardiology
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            emily@carewell.com
                        </td>

                        <td class="px-6 py-5">

                            <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                Active
                            </span>

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            May 14, 2025
                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <button class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-100">

                                    <i data-lucide="eye" class="w-4 h-4"></i>

                                </button>

                                <button class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-100">

                                    <i data-lucide="square-pen" class="w-4 h-4"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection