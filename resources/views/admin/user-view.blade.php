@extends('layouts.admin')

@section('content')

@php
    $dokter = $user->role === 'dokter' ? \App\Models\Dokter::where('user_id', $user->id)->first() : null;
    $pasien = $user->role === 'pasien' ? \App\Models\Pasien::where('user_id', $user->id)->first() : null;
    $admin  = $user->role === 'admin'  ? \App\Models\Admin::where('user_id', $user->id)->first()  : null;

    if ($user->role == 'dokter') {
            $displayId = 'DOC-' . str_pad(optional($dokter)->id_dokter, 4, '0', STR_PAD_LEFT);
        }

        elseif ($user->role == 'pasien') {
            $displayId = 'PAS-' . str_pad(optional($pasien)->id_pasien, 4, '0', STR_PAD_LEFT);
        }

        elseif ($user->role == 'admin') {
            $displayId = 'ADM-' . str_pad(optional($admin)->id_admin, 4, '0', STR_PAD_LEFT);
        }

        else {
            $displayId = 'USR-' . str_pad($user->id, 4, '0', STR_PAD_LEFT);
        }

    $roleMeta = [
        'admin'  => ['label' => 'Administrator', 'icon' => 'shield-check', 'chip' => 'from-red-500 to-pink-500',    'soft' => 'bg-red-50 text-red-600'],
        'dokter' => ['label' => 'Doctor',         'icon' => 'stethoscope',  'chip' => 'from-blue-500 to-cyan-500',   'soft' => 'bg-blue-50 text-blue-600'],
        'pasien' => ['label' => 'Patient',        'icon' => 'user',         'chip' => 'from-green-500 to-emerald-500', 'soft' => 'bg-green-50 text-green-600'],
    ][$user->role] ?? ['label' => ucfirst($user->role), 'icon' => 'user', 'chip' => 'from-slate-400 to-slate-500', 'soft' => 'bg-slate-100 text-slate-600'];
@endphp

<div class="space-y-6 w-full">

    <!-- TOP -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <a
            href="{{ route('admin.user-management') }}"
            class="inline-flex items-center gap-1.5 text-sm text-slate-400 hover:text-slate-600 transition mb-2">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                Back to User Management
            </a>

            <h1 class="text-3xl font-bold text-slate-800">
                {{ $roleMeta['label'] }} Profile
            </h1>

            <p class="text-slate-400 mt-1">
                Viewing account details for {{ $user->nama }}.
            </p>
        </div>

        @if($user->role === 'dokter')
        <a
        href="{{ route('admin.user.edit', $user->id) }}"
        class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition inline-flex items-center gap-2 w-fit">
            <i data-lucide="square-pen" class="w-4 h-4"></i>
            Edit Profile
        </a>
        @endif

    </div>

    @if(session('success'))
        <div class="p-3 rounded-xl bg-green-500 text-white">
            {{ session('success') }}
        </div>
    @endif

    <!-- IDENTITY CARD -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <div class="px-8 pt-8 pb-8 border-b border-slate-100">
            <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                @if($user->role == 'dokter' && optional($dokter)->foto_profil)
                    <img
                    src="{{ asset('storage/' . $dokter->foto_profil) }}"
                    class="w-20 h-20 rounded-3xl object-cover">
                @else
                    @php
                        $inisial = collect(explode(' ', $user->nama))->filter()->take(2)
                            ->map(fn($i) => strtoupper(substr($i, 0, 1)))->join('');

                        $avatarBg = [
                            'admin'  => 'bg-red-500',
                            'dokter' => 'bg-blue-500',
                            'pasien' => 'bg-green-500',
                        ][$user->role] ?? 'bg-slate-500';
                    @endphp
                    <div class="w-20 h-20 rounded-3xl {{ $avatarBg }} flex items-center justify-center text-white font-bold text-2xl">
                        {{ $inisial }}
                    </div>
                @endif

                <div>
                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $user->nama }}
                    </h2>
                    <p class="text-slate-400 text-sm mt-0.5">{{ $displayId }}</p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $roleMeta['soft'] }}">
                            <i data-lucide="{{ $roleMeta['icon'] }}" class="w-3 h-3"></i>
                            {{ $roleMeta['label'] }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $user->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-500' }}">
                            {{ $user->status == 'active' ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <div class="p-8 space-y-8">

            <!-- ACCOUNT -->
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-slate-400 mb-4">Account</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Email</p>
                            <p class="font-semibold text-slate-800 text-sm truncate">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Joined</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ $user->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                </div>
            </div>

            @if($user->role == 'dokter')
            <!-- PROFESSIONAL DETAILS -->
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-slate-400 mb-4">Professional Details</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="badge-check" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">No SIP</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ optional($dokter)->no_sip ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="{{ optional($dokter)->gender == 'Female' ? 'venus' : 'mars' }}" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Gender</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ optional($dokter)->gender ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="activity" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Availability</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ optional($dokter)->status_ketersediaan ?? '-' }}</p>
                        </div>
                    </div>

                </div>
            </div>
            @endif

            @if($user->role == 'pasien')
            <!-- PERSONAL INFORMATION -->
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-slate-400 mb-4">Personal Information</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">No. Rekam Medis</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ optional($pasien)->no_rm ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="fingerprint" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">NIK</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ optional($pasien)->nik ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="cake" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Birth Date</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ optional($pasien)->birth_date ? \Carbon\Carbon::parse($pasien->birth_date)->format('d M Y') : '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Phone Number</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ optional($pasien)->phone_number ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="{{ optional($pasien)->gender == 'Female' ? 'venus' : 'mars' }}" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Gender</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ optional($pasien)->gender ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50">
                        <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Address</p>
                            <p class="font-semibold text-slate-800 text-sm">{{ optional($pasien)->address ?? '-' }}</p>
                        </div>
                    </div>

                </div>
            </div>
            @endif

            @if($user->role == 'admin')
            <!-- ADMINISTRATOR INFO -->
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-slate-400 mb-4">Administrator Info</p>
                <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50 max-w-sm">
                    <div class="w-10 h-10 rounded-xl {{ $roleMeta['soft'] }} flex items-center justify-center shrink-0">
                        <i data-lucide="shield" class="w-4 h-4"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-400">Admin ID</p>
                        <p class="font-semibold text-slate-800 text-sm">{{ $displayId }}</p>
                    </div>
                </div>
                <p class="text-xs text-slate-400 mt-3 italic">
                    Administrator accounts have full system access and their role cannot be changed from here.
                </p>
            </div>
            @endif

        </div>

    </div>

</div>

@endsection