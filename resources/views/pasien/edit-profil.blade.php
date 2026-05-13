@extends('layouts.pasien')

@section('title', 'Patient Profile')

@section('subtitle', 'Manage your profile and account settings')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">

    <!-- LEFT: PROFILE CARD -->
    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">

        <div class="text-center">

            <img src="https://i.pravatar.cc/150"
                 class="w-24 h-24 mx-auto rounded-2xl shadow">

            <h2 class="text-xl font-bold mt-4">Rizki A</h2>
            <p class="text-slate-400 text-sm">Patient</p>

            <button class="mt-4 px-4 py-2 bg-teal-500 text-white rounded-xl text-sm">
                Edit Photo
            </button>

        </div>

        <div class="mt-6 space-y-3 text-sm">

            <div class="flex justify-between">
                <span class="text-slate-400">Email</span>
                <span class="font-medium">rizki@email.com</span>
            </div>

            <div class="flex justify-between">
                <span class="text-slate-400">Phone</span>
                <span class="font-medium">0812-xxxx-xxxx</span>
            </div>

            <div class="flex justify-between">
                <span class="text-slate-400">Gender</span>
                <span class="font-medium">Male</span>
            </div>

            <div class="flex justify-between">
                <span class="text-slate-400">Age</span>
                <span class="font-medium">22</span>
            </div>

        </div>

    </div>

    <!-- MIDDLE: PERSONAL INFO -->
    <div class="bg-white rounded-3xl p-6 shadow-lg border">

        <h2 class="font-bold text-lg mb-4">Personal Information</h2>

        <div class="space-y-4 text-sm">

            <div>
                <p class="text-slate-400">Full Name</p>
                <p class="font-medium">Rizki A</p>
            </div>

            <div>
                <p class="text-slate-400">Address</p>
                <p class="font-medium">Batam, Indonesia</p>
            </div>

            <div>
                <p class="text-slate-400">Patient ID</p>
                <p class="font-medium">P-00123</p>
            </div>

            <div>
                <p class="text-slate-400">Registered Date</p>
                <p class="font-medium">Jan 2026</p>
            </div>

        </div>

        <button class="mt-6 w-full py-3 bg-teal-500 text-white rounded-2xl">
            Update Profile
        </button>

    </div>

    <!-- RIGHT: MEDICAL + PASSWORD -->
    <div class="space-y-6">

        <!-- MEDICAL SUMMARY -->
        <div class="bg-white rounded-3xl p-6 shadow-lg border">

            <h2 class="font-bold mb-4">Medical Summary</h2>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span class="text-slate-400">Total Visits</span>
                    <span class="font-bold">5</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Active Status</span>
                    <span class="text-green-500 font-semibold">Healthy</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Last Visit</span>
                    <span class="font-medium">20 Mar 2026</span>
                </div>

            </div>

        </div>

        <!-- CHANGE PASSWORD -->
        <div class="bg-white rounded-3xl p-6 shadow-lg border">

            <h2 class="font-bold mb-4">Change Password</h2>

            <input type="password"
                   placeholder="Old Password"
                   class="w-full p-3 border rounded-xl mb-3">

            <input type="password"
                   placeholder="New Password"
                   class="w-full p-3 border rounded-xl mb-3">

            <input type="password"
                   placeholder="Confirm Password"
                   class="w-full p-3 border rounded-xl mb-4">

            <button class="w-full py-3 bg-red-500 text-white rounded-2xl">
                Update Password
            </button>

        </div>

    </div>

</div>

@endsection