@extends('layouts.admin')

@section('title', 'Settings')
@section('subtitle', 'Manage clinic information and configuration')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Clinic Settings
        </h1>
        <p class="text-slate-500 mt-1">
            Manage your clinic profile, operational hours, and legal information
        </p>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-2xl px-5 py-4 flex items-center gap-3">
        <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500 shrink-0"></i>
        <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
    </div>
    @endif

    {{-- 1. INFO UMUM --}}
    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-teal-50 flex items-center justify-center">
                <i data-lucide="building-2" class="w-4 h-4 text-teal-600"></i>
            </div>
            <div>
                <h2 class="font-semibold text-slate-800">General Information</h2>
                <p class="text-xs text-slate-400">Clinic name, type, and contact details</p>
            </div>
        </div>

        <form
            action="{{ route('admin.settings.general') }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-6 space-y-5">

            @csrf
            @method('PUT')

            {{-- LOGO --}}
            <div class="flex items-center gap-5">

                <div class="w-20 h-20 rounded-2xl bg-slate-100 overflow-hidden shrink-0 flex items-center justify-center">
                    @if($setting->clinic_logo)
                        <img
                            src="{{ Storage::url($setting->clinic_logo) }}"
                            alt="Logo"
                            class="w-full h-full object-cover">
                    @else
                        <i data-lucide="image" class="w-7 h-7 text-slate-300"></i>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Clinic Logo
                    </label>
                    <input
                        type="file"
                        name="clinic_logo"
                        accept="image/png,image/jpeg"
                        class="text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-teal-50 file:text-teal-600 file:font-medium hover:file:bg-teal-100">
                    <p class="text-xs text-slate-400 mt-1">PNG atau JPG, maks 2MB</p>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Clinic Name <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="text"
                        name="clinic_name"
                        value="{{ old('clinic_name', $setting->clinic_name) }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Tagline
                    </label>
                    <input
                        type="text"
                        name="clinic_tagline"
                        value="{{ old('clinic_tagline', $setting->clinic_tagline) }}"
                        placeholder="e.g. Kesehatan Anda, Prioritas Kami"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Clinic Type
                    </label>
                    <select
                        name="clinic_type"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                        @foreach(['General Clinic', 'Specialist Clinic', 'Dental Clinic', 'Maternity Clinic', 'Eye Clinic', 'Hospital'] as $type)
                        <option value="{{ $type }}" {{ old('clinic_type', $setting->clinic_type) == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Email
                    </label>
                    <input
                        type="email"
                        name="clinic_email"
                        value="{{ old('clinic_email', $setting->clinic_email) }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Phone
                    </label>
                    <input
                        type="text"
                        name="clinic_phone"
                        value="{{ old('clinic_phone', $setting->clinic_phone) }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        WhatsApp
                    </label>
                    <input
                        type="text"
                        name="clinic_whatsapp"
                        value="{{ old('clinic_whatsapp', $setting->clinic_whatsapp) }}"
                        placeholder="e.g. 08112345678"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Website
                    </label>
                    <input
                        type="url"
                        name="clinic_website"
                        value="{{ old('clinic_website', $setting->clinic_website) }}"
                        placeholder="https://digitalcare.id"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

            </div>

            <div class="flex justify-end pt-2">
                <button
                    type="submit"
                    class="px-6 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold text-sm transition">
                    Save General Info
                </button>
            </div>

        </form>

    </div>

    {{-- 2. ALAMAT --}}
    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                <i data-lucide="map-pin" class="w-4 h-4 text-blue-600"></i>
            </div>
            <div>
                <h2 class="font-semibold text-slate-800">Address</h2>
                <p class="text-xs text-slate-400">Clinic location and Google Maps link</p>
            </div>
        </div>

        <form
            action="{{ route('admin.settings.address') }}"
            method="POST"
            class="p-6 space-y-4">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Street Address
                </label>
                <textarea
                    name="address"
                    rows="2"
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 resize-none">{{ old('address', $setting->address) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">City</label>
                    <input
                        type="text"
                        name="city"
                        value="{{ old('city', $setting->city) }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Province</label>
                    <input
                        type="text"
                        name="province"
                        value="{{ old('province', $setting->province) }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Postal Code</label>
                    <input
                        type="text"
                        name="postal_code"
                        value="{{ old('postal_code', $setting->postal_code) }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Google Maps URL
                </label>
                <input
                    type="url"
                    name="google_maps_url"
                    value="{{ old('google_maps_url', $setting->google_maps_url) }}"
                    placeholder="https://maps.google.com/..."
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
            </div>

            <div class="flex justify-end pt-2">
                <button
                    type="submit"
                    class="px-6 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold text-sm transition">
                    Save Address
                </button>
            </div>

        </form>

    </div>

    {{-- 3. JAM OPERASIONAL --}}
    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-orange-50 flex items-center justify-center">
                <i data-lucide="clock" class="w-4 h-4 text-orange-500"></i>
            </div>
            <div>
                <h2 class="font-semibold text-slate-800">Operational Hours</h2>
                <p class="text-xs text-slate-400">Opening hours and availability</p>
            </div>
        </div>

        <form
            action="{{ route('admin.settings.hours') }}"
            method="POST"
            class="p-6 space-y-4">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Open Days
                    </label>
                    <input
                        type="text"
                        name="open_days"
                        value="{{ old('open_days', $setting->open_days) }}"
                        placeholder="e.g. Senin - Sabtu"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Open Time
                    </label>
                    <input
                        type="time"
                        name="open_time"
                        value="{{ old('open_time', $setting->open_time ? \Carbon\Carbon::parse($setting->open_time)->format('H:i') : '08:00') }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Close Time
                    </label>
                    <input
                        type="time"
                        name="close_time"
                        value="{{ old('close_time', $setting->close_time ? \Carbon\Carbon::parse($setting->close_time)->format('H:i') : '17:00') }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

            </div>

            <div class="flex flex-col sm:flex-row gap-4">

                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="is_open_sunday"
                        value="1"
                        {{ old('is_open_sunday', $setting->is_open_sunday) ? 'checked' : '' }}
                        class="w-4 h-4 rounded accent-teal-500">
                    <span class="text-sm text-slate-700">Open on Sunday</span>
                </label>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="is_open_24h"
                        value="1"
                        {{ old('is_open_24h', $setting->is_open_24h) ? 'checked' : '' }}
                        class="w-4 h-4 rounded accent-teal-500">
                    <span class="text-sm text-slate-700">Open 24 Hours</span>
                </label>

            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Sunday Hours <span class="text-slate-400 font-normal">(if open)</span>
                </label>
                <input
                    type="text"
                    name="sunday_hours"
                    value="{{ old('sunday_hours', $setting->sunday_hours) }}"
                    placeholder="e.g. 08:00 - 12:00"
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
            </div>

            <div class="flex justify-end pt-2">
                <button
                    type="submit"
                    class="px-6 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold text-sm transition">
                    Save Hours
                </button>
            </div>

        </form>

    </div>

    {{-- 4. SOSIAL MEDIA --}}
    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center">
                <i data-lucide="share-2" class="w-4 h-4 text-purple-600"></i>
            </div>
            <div>
                <h2 class="font-semibold text-slate-800">Social Media</h2>
                <p class="text-xs text-slate-400">Clinic social media links</p>
            </div>
        </div>

        <form
            action="{{ route('admin.settings.social') }}"
            method="POST"
            class="p-6 space-y-4">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Facebook
                    </label>
                    <div class="flex items-center border border-slate-200 rounded-2xl overflow-hidden">
                        <span class="px-4 py-3 bg-slate-50 text-slate-400 text-sm border-r border-slate-200">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </span>
                        <input
                            type="url"
                            name="facebook"
                            value="{{ old('facebook', $setting->facebook) }}"
                            placeholder="https://facebook.com/..."
                            class="flex-1 px-4 py-3 text-sm focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Instagram
                    </label>
                    <div class="flex items-center border border-slate-200 rounded-2xl overflow-hidden">
                        <span class="px-4 py-3 bg-slate-50 text-slate-400 text-sm border-r border-slate-200">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </span>
                        <input
                            type="url"
                            name="instagram"
                            value="{{ old('instagram', $setting->instagram) }}"
                            placeholder="https://instagram.com/..."
                            class="flex-1 px-4 py-3 text-sm focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Twitter / X
                    </label>
                    <div class="flex items-center border border-slate-200 rounded-2xl overflow-hidden">
                        <span class="px-4 py-3 bg-slate-50 text-slate-400 text-sm border-r border-slate-200">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </span>
                        <input
                            type="url"
                            name="twitter"
                            value="{{ old('twitter', $setting->twitter) }}"
                            placeholder="https://twitter.com/..."
                            class="flex-1 px-4 py-3 text-sm focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        YouTube
                    </label>
                    <div class="flex items-center border border-slate-200 rounded-2xl overflow-hidden">
                        <span class="px-4 py-3 bg-slate-50 text-slate-400 text-sm border-r border-slate-200">
                            <i data-lucide="youtube" class="w-4 h-4"></i>
                        </span>
                        <input
                            type="url"
                            name="youtube"
                            value="{{ old('youtube', $setting->youtube) }}"
                            placeholder="https://youtube.com/..."
                            class="flex-1 px-4 py-3 text-sm focus:outline-none">
                    </div>
                </div>

            </div>

            <div class="flex justify-end pt-2">
                <button
                    type="submit"
                    class="px-6 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold text-sm transition">
                    Save Social Media
                </button>
            </div>

        </form>

    </div>

    {{-- 5. LEGAL --}}
    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center">
                <i data-lucide="shield-check" class="w-4 h-4 text-slate-600"></i>
            </div>
            <div>
                <h2 class="font-semibold text-slate-800">Legal Information</h2>
                <p class="text-xs text-slate-400">Clinic license and tax information</p>
            </div>
        </div>

        <form
            action="{{ route('admin.settings.legal') }}"
            method="POST"
            class="p-6 space-y-4">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        License Number <span class="text-slate-400 font-normal">(No. Izin Klinik)</span>
                    </label>
                    <input
                        type="text"
                        name="license_number"
                        value="{{ old('license_number', $setting->license_number) }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Tax Number <span class="text-slate-400 font-normal">(NPWP)</span>
                    </label>
                    <input
                        type="text"
                        name="tax_number"
                        value="{{ old('tax_number', $setting->tax_number) }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        License Expiry Date
                    </label>
                    <input
                        type="date"
                        name="license_expiry"
                        value="{{ old('license_expiry', $setting->license_expiry?->format('Y-m-d')) }}"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300">
                </div>

            </div>

            @if($setting->license_expiry)
            @php
                $daysLeft = now()->diffInDays($setting->license_expiry, false);
            @endphp
            <div class="flex items-center gap-2 text-sm {{ $daysLeft < 30 ? 'text-red-500' : 'text-slate-500' }}">
                <i data-lucide="{{ $daysLeft < 30 ? 'alert-triangle' : 'info' }}" class="w-4 h-4"></i>
                @if($daysLeft < 0)
                    License has expired {{ abs($daysLeft) }} days ago.
                @elseif($daysLeft < 30)
                    License expires in {{ $daysLeft }} days. Please renew soon.
                @else
                    License is valid for {{ $daysLeft }} more days.
                @endif
            </div>
            @endif

            <div class="flex justify-end pt-2">
                <button
                    type="submit"
                    class="px-6 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold text-sm transition">
                    Save Legal Info
                </button>
            </div>

        </form>

    </div>

</div>

@endsection