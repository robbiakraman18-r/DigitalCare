@extends('layouts.pasien')

@section('title', 'Profil Saya')
@section('subtitle', 'Informasi akun dan riwayat kunjungan pasien.')

@section('content')

@php
    $user   = auth()->user();
    $pasien = $user->pasien;

    $inisial = collect(explode(' ', $user->nama))
        ->filter()->take(2)
        ->map(fn($w) => strtoupper(substr($w, 0, 1)))
        ->join('');
@endphp

@if(session('success'))
<div class="mb-4 px-5 py-3.5 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-medium flex items-center gap-2">
    <i data-lucide="circle-check" class="w-4 h-4"></i> {{ session('success') }}
</div>
@endif

<div class="space-y-6">

    {{-- HERO --}}
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-visible">
    <div class="h-44 relative bg-gradient-to-br from-slate-50 to-teal-50 rounded-t-[32px] overflow-hidden">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, #e2e8f0 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div class="absolute top-4 right-8 w-32 h-32 rounded-full bg-teal-400/10 border border-teal-200/30"></div>
            <div class="absolute -bottom-4 right-32 w-20 h-20 rounded-full bg-teal-300/10 border border-teal-200/20"></div>
            <div class="absolute top-8 left-1/3 w-16 h-16 rounded-full bg-teal-200/20"></div>
        </div>

        <div class="px-8 pb-8 pt-4">
            <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="w-24 h-24 rounded-full bg-teal-500 border-4 border-white shadow-xl
            flex items-center justify-center text-white font-bold text-3xl shrink-0 -mt-12 relative z-10">
                        {{ $inisial }}
                    </div>
                    <div class="mt-2">
                        <h1 class="text-2xl font-bold text-slate-800">{{ $user->nama }}</h1>
                        <p class="text-slate-400 text-sm mt-0.5">{{ $user->email }}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="px-3 py-1 rounded-xl bg-teal-100 text-teal-700 text-xs font-semibold">Pasien</span>
                            <span class="px-3 py-1 rounded-xl bg-green-100 text-green-700 text-xs font-semibold">● Aktif</span>
                            @if($pasien?->gender)
                                <span class="px-3 py-1 rounded-xl bg-slate-100 text-slate-600 text-xs font-semibold">{{ $pasien->gender }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('profile.edit') }}"
                       class="px-5 py-2.5 rounded-2xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 font-semibold text-sm transition flex items-center gap-2">
                        <i data-lucide="pencil" class="w-4 h-4"></i> Edit Profil
                    </a>
                    <button onclick="document.getElementById('modalPassword').classList.remove('hidden')"
                            class="px-5 py-2.5 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold text-sm transition shadow-lg shadow-teal-100 flex items-center gap-2">
                        <i data-lucide="lock-keyhole" class="w-4 h-4"></i> Ubah Password
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- KIRI --}}
        <div class="xl:col-span-2 space-y-6">

            {{-- INFORMASI PRIBADI --}}
            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-7">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-teal-50 flex items-center justify-center">
                        <i data-lucide="user-round" class="w-5 h-5 text-teal-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Informasi Pribadi</h2>
                        <p class="text-xs text-slate-400">Data diri pasien</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Nama Lengkap</p>
                        <p class="font-semibold text-slate-800">{{ $user->nama }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">ID Pasien</p>
                        <p class="font-semibold text-slate-800">PAS-{{ str_pad($pasien?->id_pasien ?? 0, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Jenis Kelamin</p>
                        <p class="font-semibold text-slate-800">{{ $pasien?->gender ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Nomor Telepon</p>
                        <p class="font-semibold text-slate-800">{{ $pasien?->phone_number ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Email</p>
                        <p class="font-semibold text-slate-800">{{ $user->email }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Tanggal Lahir</p>
                        <p class="font-semibold text-slate-800">
                            {{ $pasien?->birth_date ? \Carbon\Carbon::parse($pasien->birth_date)->translatedFormat('d M Y') : '-' }}
                        </p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 md:col-span-2">
                        <p class="text-xs text-slate-400 mb-1">Alamat</p>
                        <p class="font-semibold text-slate-800">{{ $pasien?->address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- RIWAYAT APPOINTMENT --}}
            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-7">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center">
                            <i data-lucide="clipboard-list" class="w-5 h-5 text-blue-500"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-slate-800">Riwayat Appointment</h2>
                            <p class="text-xs text-slate-400">Kunjungan medis terbaru</p>
                        </div>
                    </div>
                    <a href="{{ route('pasien.buat-janji') }}"
                       class="px-4 py-2 rounded-xl bg-teal-500 hover:bg-teal-600 text-white text-xs font-semibold transition flex items-center gap-1.5">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Buat Janji
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-slate-400 text-xs border-b border-slate-100">
                                <th class="text-left pb-3 font-semibold">Tanggal</th>
                                <th class="text-left pb-3 font-semibold">Dokter</th>
                                <th class="text-left pb-3 font-semibold">Keluhan</th>
                                <th class="text-left pb-3 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($pasien?->appointments ?? [] as $apt)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-3.5 text-slate-700">{{ \Carbon\Carbon::parse($apt->tanggal_janji)->format('d M Y') }}</td>
                                <td class="py-3.5 font-medium text-slate-800">Dr. {{ $apt->dokter->user->nama ?? '-' }}</td>
                                <td class="py-3.5 text-slate-500 max-w-[140px] truncate">{{ $apt->keluhan_utama ?? '-' }}</td>
                                <td class="py-3.5">
                                    @php
                                        $statusColor = match($apt->status_janji) {
                                            'completed'       => 'bg-green-100 text-green-700',
                                            'pending'         => 'bg-yellow-100 text-yellow-700',
                                            'called'          => 'bg-blue-100 text-blue-700',
                                            'in_consultation' => 'bg-cyan-100 text-cyan-700',
                                            default           => 'bg-slate-100 text-slate-600',
                                        };
                                        $statusLabel = match($apt->status_janji) {
                                            'completed'       => 'Selesai',
                                            'pending'         => 'Menunggu',
                                            'called'          => 'Dipanggil',
                                            'in_consultation' => 'Konsultasi',
                                            default           => ucfirst($apt->status_janji),
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-xl text-xs font-semibold {{ $statusColor }}">{{ $statusLabel }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center">
                                    <i data-lucide="calendar-x-2" class="w-10 h-10 text-slate-200 mx-auto mb-2"></i>
                                    <p class="text-slate-400 text-sm">Belum ada riwayat appointment</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        {{-- KANAN --}}
        <div class="space-y-6">

            {{-- RINGKASAN --}}
            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-50 flex items-center justify-center">
                        <i data-lucide="chart-pie" class="w-5 h-5 text-yellow-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Ringkasan</h2>
                        <p class="text-xs text-slate-400">Statistik kunjungan pasien</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="bg-teal-50 rounded-2xl p-4">
                        <p class="text-xs text-teal-600">Total Kunjungan</p>
                        <p class="text-2xl font-bold text-teal-700 mt-1">
                            {{ $pasien?->appointments()->count() ?? 0 }}
                            <span class="text-sm font-normal">kali</span>
                        </p>
                    </div>
                    <div class="bg-green-50 rounded-2xl p-4">
                        <p class="text-xs text-green-600">Selesai</p>
                        <p class="text-xl font-bold text-green-700 mt-1">
                            {{ $pasien?->appointments()->where('status_janji', 'completed')->count() ?? 0 }}
                        </p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400">Member Sejak</p>
                        <p class="font-semibold text-slate-800 mt-1">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- AKSI CEPAT --}}
            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center">
                        <i data-lucide="zap" class="w-5 h-5 text-cyan-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Aksi Cepat</h2>
                        <p class="text-xs text-slate-400">Navigasi yang sering digunakan</p>
                    </div>
                </div>
                <div class="space-y-2.5">
                    <a href="{{ route('pasien.buat-janji') }}"
                       class="flex items-center gap-3 p-4 rounded-2xl bg-slate-50 hover:bg-teal-50 border border-transparent hover:border-teal-100 transition group">
                        <div class="w-8 h-8 rounded-xl bg-teal-100 flex items-center justify-center group-hover:bg-teal-200 transition">
                            <i data-lucide="calendar-plus" class="w-4 h-4 text-teal-600"></i>
                        </div>
                        <span class="font-semibold text-sm text-slate-700 group-hover:text-teal-700 transition">Buat Janji Baru</span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 ml-auto group-hover:text-teal-400 transition"></i>
                    </a>
                    <a href="{{ route('pasien.janji-temu') }}"
                       class="flex items-center gap-3 p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 border border-transparent hover:border-blue-100 transition group">
                        <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center group-hover:bg-blue-200 transition">
                            <i data-lucide="history" class="w-4 h-4 text-blue-600"></i>
                        </div>
                        <span class="font-semibold text-sm text-slate-700 group-hover:text-blue-700 transition">Riwayat Janji Temu</span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 ml-auto group-hover:text-blue-400 transition"></i>
                    </a>
                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-3 p-4 rounded-2xl bg-slate-50 hover:bg-slate-100 border border-transparent transition group">
                        <div class="w-8 h-8 rounded-xl bg-slate-200 flex items-center justify-center group-hover:bg-slate-300 transition">
                            <i data-lucide="settings-2" class="w-4 h-4 text-slate-600"></i>
                        </div>
                        <span class="font-semibold text-sm text-slate-700">Edit Profil</span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 ml-auto transition"></i>
                    </a>
                    <a href="{{ route('pasien.listrekam-medis') }}"
                       class="flex items-center gap-3 p-4 rounded-2xl bg-slate-50 hover:bg-cyan-50 border border-transparent hover:border-cyan-100 transition group">
                        <div class="w-8 h-8 rounded-xl bg-cyan-100 flex items-center justify-center group-hover:bg-cyan-200 transition">
                            <i data-lucide="file-text" class="w-4 h-4 text-cyan-600"></i>
                        </div>
                        <span class="font-semibold text-sm text-slate-700 group-hover:text-cyan-700 transition">Rekam Medis</span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 ml-auto group-hover:text-cyan-400 transition"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- MODAL PASSWORD --}}
<div id="modalPassword" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4">
    <div class="bg-white rounded-[28px] shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-teal-500 px-7 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center">
                    <i data-lucide="lock-keyhole" class="w-5 h-5 text-white"></i>
                </div>
                <div>
                    <h2 class="font-bold text-white">Ubah Password</h2>
                    <p class="text-teal-100 text-xs">Perbarui kata sandi akun Anda</p>
                </div>
            </div>
            <button onclick="document.getElementById('modalPassword').classList.add('hidden')"
                    class="w-8 h-8 rounded-xl bg-white/20 hover:bg-white/30 flex items-center justify-center transition">
                <i data-lucide="x" class="w-4 h-4 text-white"></i>
            </button>
        </div>
        <form action="{{ route('pasien.password.update') }}" method="POST" class="px-7 py-6 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="text-sm font-semibold text-slate-700 block mb-1.5">Password Saat Ini</label>
                <div class="relative">
                    <input type="password" name="current_password" placeholder="••••••••"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 pr-11">
                    <button type="button" onclick="togglePass(this)" class="absolute right-3 top-3 text-slate-400 hover:text-slate-600">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>
                @error('current_password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700 block mb-1.5">Password Baru</label>
                <div class="relative">
                    <input type="password" name="password" placeholder="••••••••"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 pr-11">
                    <button type="button" onclick="togglePass(this)" class="absolute right-3 top-3 text-slate-400 hover:text-slate-600">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700 block mb-1.5">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" placeholder="••••••••"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 pr-11">
                    <button type="button" onclick="togglePass(this)" class="absolute right-3 top-3 text-slate-400 hover:text-slate-600">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="document.getElementById('modalPassword').classList.add('hidden')"
                        class="flex-1 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm transition">Batal</button>
                <button type="submit"
                        class="flex-1 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold text-sm transition shadow-lg shadow-teal-100">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function togglePass(btn) {
    const input = btn.parentElement.querySelector('input');
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.setAttribute('data-lucide', 'eye-off');
    } else {
        input.type = 'password';
        icon.setAttribute('data-lucide', 'eye');
    }
    lucide.createIcons();
}
</script>
@if($errors->has('current_password') || $errors->has('password'))
<script>document.getElementById('modalPassword').classList.remove('hidden');</script>
@endif
@endpush

@endsection