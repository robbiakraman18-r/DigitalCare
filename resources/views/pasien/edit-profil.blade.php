@extends('layouts.pasien')

@section('content')
<form action="{{ route('profile.update') }}" method="POST">
    @csrf
    @method('PUT')  
<div class="p-8 bg-gray-50 min-h-screen">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">Edit Profile</h1>
        <p class="text-slate-500">
            Update your personal information and account details
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- PROFILE CARD -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">

            <div class="flex flex-col items-center text-center">

                <img src="https://i.pravatar.cc/150"
                     class="w-32 h-32 rounded-full object-cover shadow-md mb-4">

                <h2 class="text-2xl font-bold">
                    {{ $user->nama }}
                </h2>

                <p class="text-slate-500 text-sm">
                    {{ $user->email }}
                </p>

                <div class="mt-6 w-full space-y-3 text-sm">

                    <div class="flex justify-between">
                        <span class="text-slate-500">NIK</span>
                        <span class="font-medium">
                            {{ $user->pasien->nik ?? '-' }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-500">Phone</span>
                        <span class="font-medium">
                            {{ $user->pasien->phone_number ?? '-' }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-500">Gender</span>
                        <span class="font-medium">
                            {{ $user->pasien->gender ?? '-' }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

        <!-- EDIT FORM -->
        <div class="lg:col-span-2 bg-white p-6 rounded-3xl shadow-sm border border-slate-100">

            <h3 class="font-bold mb-6 flex items-center gap-2">
                <span class="text-blue-600">✏️</span>
                Edit Personal Information
            </h3>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">
                            Full Name
                        </label>
                        <input type="text"
                               name="nama"
                               value="{{ old('nama', $user->nama) }}"
                               class="w-full px-4 py-3 border border-slate-200 rounded-2xl">
                    </div>

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">
                            Email
                        </label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-3 border border-slate-200 rounded-2xl">
                    </div>

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">
                            NIK
                        </label>
                        <input type="text"
                               name="nik"
                               value="{{ old('nik', $user->pasien->nik ?? '') }}"
                               class="w-full px-4 py-3 border border-slate-200 rounded-2xl">
                    </div>

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">
                            Phone Number
                        </label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone', $user->pasien->phone_number ?? '') }}"
                               class="w-full px-4 py-3 border border-slate-200 rounded-2xl">
                    </div>

                    <div>
                        <label class="block text-sm text-slate-500 mb-2">
                            Gender
                        </label>

                        <select name="gender"
                                class="w-full px-4 py-3 border border-slate-200 rounded-2xl">

                            <option value="Male"
                                {{ ($user->pasien->gender ?? '') == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="Female"
                                {{ ($user->pasien->gender ?? '') == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>

                        </select>
                    </div>

                </div>

                <div class="mt-5">
                    <label class="block text-sm text-slate-500 mb-2">
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        class="w-full px-4 py-3 border border-slate-200 rounded-2xl">{{ old('address', $user->pasien->address ?? '') }}</textarea>
                </div>

                <div class="mt-6 flex justify-end gap-3">

                    <a href="{{ route('profile.show') }}"
                       class="px-6 py-3 rounded-2xl border border-slate-200 text-slate-600">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-3 rounded-2xl bg-blue-600 text-white font-semibold hover:bg-blue-700">
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection