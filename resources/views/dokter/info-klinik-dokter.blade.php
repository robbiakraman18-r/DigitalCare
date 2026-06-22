@extends('layouts.dokter')

@section('title', 'Clinic Information')
@section('subtitle', 'All information about the clinic')

@section('content')

<div class="space-y-6">

    {{-- HEADER KLINIK --}}
    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center gap-5">

        <div class="w-16 h-16 rounded-2xl bg-teal-50 overflow-hidden flex items-center justify-center shrink-0">
            @if($setting->clinic_logo)
                <img src="{{ Storage::url($setting->clinic_logo) }}" class="w-full h-full object-cover">
            @else
                <i data-lucide="building-2" class="w-7 h-7 text-teal-500"></i>
            @endif
        </div>

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                {{ $setting->clinic_name }}
            </h1>
            @if($setting->clinic_tagline)
            <p class="text-slate-500 mt-0.5">
                {{ $setting->clinic_tagline }}
            </p>
            @endif
            <span class="inline-block mt-1 px-3 py-1 bg-teal-50 text-teal-600 text-xs font-semibold rounded-xl">
                {{ $setting->clinic_type }}
            </span>
        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- ABOUT --}}
        <div class="lg:col-span-2 space-y-4">

            {{-- CONTACT --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="phone" class="w-4 h-4 text-teal-600"></i>
                    <h2 class="font-semibold text-slate-800">Contact Information</h2>
                </div>

                <div class="space-y-3 text-sm">

                    @if($setting->clinic_phone)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                            <i data-lucide="phone" class="w-3.5 h-3.5 text-blue-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Phone</p>
                            <p class="font-medium text-slate-700">{{ $setting->clinic_phone }}</p>
                        </div>
                    </div>
                    @endif

                    @if($setting->clinic_whatsapp)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-green-50 flex items-center justify-center shrink-0">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5 text-green-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">WhatsApp</p>
                            <p class="font-medium text-slate-700">{{ $setting->clinic_whatsapp }}</p>
                        </div>
                    </div>
                    @endif

                    @if($setting->clinic_email)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-orange-50 flex items-center justify-center shrink-0">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-orange-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Email</p>
                            <p class="font-medium text-slate-700">{{ $setting->clinic_email }}</p>
                        </div>
                    </div>
                    @endif

                    @if($setting->clinic_website)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-purple-50 flex items-center justify-center shrink-0">
                            <i data-lucide="globe" class="w-3.5 h-3.5 text-purple-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Website</p>
                            <a href="{{ $setting->clinic_website }}" target="_blank"
                               class="font-medium text-purple-600 hover:underline">
                                {{ $setting->clinic_website }}
                            </a>
                        </div>
                    </div>
                    @endif

                </div>

            </div>

            {{-- ALAMAT --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="map-pin" class="w-4 h-4 text-blue-600"></i>
                    <h2 class="font-semibold text-slate-800">Address</h2>
                </div>

                <p class="text-slate-700 text-sm leading-relaxed">
                    {{ implode(', ', array_filter([
                        $setting->address,
                        $setting->city,
                        $setting->province,
                        $setting->postal_code,
                    ])) ?: '-' }}
                </p>

                @if($setting->google_maps_url)
                <a
                    href="{{ $setting->google_maps_url }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 mt-3 px-4 py-2 rounded-xl bg-blue-50 text-blue-600 text-xs font-medium hover:bg-blue-100 transition">
                    <i data-lucide="map" class="w-3.5 h-3.5"></i>
                    Open in Google Maps
                </a>
                @endif

            </div>

            {{-- SOSMED --}}
            @if($setting->facebook || $setting->instagram || $setting->twitter || $setting->youtube)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6">

                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="share-2" class="w-4 h-4 text-purple-600"></i>
                    <h2 class="font-semibold text-slate-800">Social Media</h2>
                </div>

                <div class="flex flex-wrap gap-3">

                    @if($setting->facebook)
                    <a href="{{ $setting->facebook }}" target="_blank"
                       class="px-4 py-2 rounded-xl bg-blue-50 text-blue-600 text-sm font-medium hover:bg-blue-100 transition inline-flex items-center gap-2">
                        <i data-lucide="facebook" class="w-4 h-4"></i> Facebook
                    </a>
                    @endif

                    @if($setting->instagram)
                    <a href="{{ $setting->instagram }}" target="_blank"
                       class="px-4 py-2 rounded-xl bg-pink-50 text-pink-600 text-sm font-medium hover:bg-pink-100 transition inline-flex items-center gap-2">
                        <i data-lucide="instagram" class="w-4 h-4"></i> Instagram
                    </a>
                    @endif

                    @if($setting->twitter)
                    <a href="{{ $setting->twitter }}" target="_blank"
                       class="px-4 py-2 rounded-xl bg-sky-50 text-sky-600 text-sm font-medium hover:bg-sky-100 transition inline-flex items-center gap-2">
                        <i data-lucide="twitter" class="w-4 h-4"></i> Twitter
                    </a>
                    @endif

                    @if($setting->youtube)
                    <a href="{{ $setting->youtube }}" target="_blank"
                       class="px-4 py-2 rounded-xl bg-red-50 text-red-600 text-sm font-medium hover:bg-red-100 transition inline-flex items-center gap-2">
                        <i data-lucide="youtube" class="w-4 h-4"></i> YouTube
                    </a>
                    @endif

                </div>

            </div>
            @endif

        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-4">

            {{-- JAM OPERASIONAL --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5">

                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="clock" class="w-4 h-4 text-orange-500"></i>
                    <h3 class="font-semibold text-slate-800">Open Hours</h3>
                </div>

                <div class="space-y-2 text-sm">

                    @if($setting->is_open_24h)
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-400"></span>
                        <span class="text-slate-700 font-medium">Open 24 Hours</span>
                    </div>
                    @else
                    <div class="flex justify-between">
                        <span class="text-slate-500">{{ $setting->open_days }}</span>
                        <span class="font-medium text-slate-700">
                            {{ \Carbon\Carbon::parse($setting->open_time)->format('H:i') }}
                            –
                            {{ \Carbon\Carbon::parse($setting->close_time)->format('H:i') }}
                        </span>
                    </div>

                    @if($setting->is_open_sunday && $setting->sunday_hours)
                    <div class="flex justify-between">
                        <span class="text-slate-500">Sunday</span>
                        <span class="font-medium text-slate-700">{{ $setting->sunday_hours }}</span>
                    </div>
                    @elseif(!$setting->is_open_sunday)
                    <div class="flex justify-between">
                        <span class="text-slate-500">Sunday</span>
                        <span class="text-red-400 font-medium">Closed</span>
                    </div>
                    @endif
                    @endif

                </div>

            </div>

            {{-- INFO LEGAL --}}
            @if($setting->license_number || $setting->tax_number)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5">

                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="shield-check" class="w-4 h-4 text-slate-500"></i>
                    <h3 class="font-semibold text-slate-800">Legal</h3>
                </div>

                <div class="space-y-2 text-sm">
                    @if($setting->license_number)
                    <div>
                        <p class="text-xs text-slate-400">License No.</p>
                        <p class="font-medium text-slate-700">{{ $setting->license_number }}</p>
                    </div>
                    @endif
                    @if($setting->tax_number)
                    <div>
                        <p class="text-xs text-slate-400">NPWP</p>
                        <p class="font-medium text-slate-700">{{ $setting->tax_number }}</p>
                    </div>
                    @endif
                </div>

            </div>
            @endif

        </div>

    </div>

</div>

@endsection