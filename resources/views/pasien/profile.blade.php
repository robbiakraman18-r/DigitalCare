@extends('layouts.pasien')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">Patient Profile</h1>
        <p class="text-slate-500">Manage your personal information and view your activity</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex flex-col md:flex-row gap-6">
                <div class="flex flex-col items-center text-center">
                    <img src="https://i.pravatar.cc/150" class="w-32 h-32 rounded-full mb-4 object-cover shadow-md">
                    <h2 class="text-2xl font-bold">{{ $user->nama }}</h2>
                    <p class="text-slate-500 text-sm">{{ $user->email }}</p>
                    <a href="{{ route('profile.edit') }}" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                        Edit Profile
                    </a>
                </div>

                <div class="flex-1">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <span class="text-blue-600">👤</span> Personal Information
                    </h3>
                <div class="grid grid-cols-2 gap-y-4 text-sm">
                    <span class="text-slate-500">Full Name</span>
                    <span class="font-medium text-slate-800">
                        {{ $user->nama }}
                    </span>
                    <span class="text-slate-500">NIK</span>
                    <span class="font-medium text-slate-800">
                        {{ $user->pasien->nik ?? '-' }}
                    </span>
                    <span class="text-slate-500">Gender</span>
                    <span class="font-medium text-slate-800">
                        {{ $user->pasien->gender ?? '-' }}
                    </span>

                    <span class="text-slate-500">Phone</span>
                    <span class="font-medium text-slate-800">
                        {{ $user->pasien->phone_number ?? '-' }}
                    </span>

                    <span class="text-slate-500">Address</span>
                    <span class="font-medium text-slate-800">
                        {{ $user->pasien->address ?? '-' }}
                    </span>
                </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <h3 class="font-bold mb-4">Summary</h3>
            <div class="space-y-4">
                <div class="bg-emerald-50 p-4 rounded-2xl">
                    <p class="text-xs text-emerald-600">Total Visits</p>
                    <p class="text-xl font-bold text-emerald-800">5 Times</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-2xl">
                    <p class="text-xs text-slate-500">Member Since</p>
                    <p class="font-semibold text-slate-800">{{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <h3 class="font-bold mb-4">Recent Appointments</h3>
            <table class="w-full text-sm">
                <thead class="text-slate-400">
                    <tr><th class="text-left pb-2">Date</th><th class="text-left pb-2">Doctor</th><th class="text-left pb-2">Status</th></tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-3">26 May 2026</td>
                        <td class="py-3">Dr. Andi</td>
                        <td class="py-3"><span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-lg text-xs font-semibold">Completed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <h3 class="font-bold mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('pasien.buat-janji') }}" class="block p-4 bg-slate-50 rounded-2xl hover:bg-blue-50 transition border border-slate-100 font-medium">Book New Appointment</a>
            </div>
        </div>
    </div>
</div>
@endsection