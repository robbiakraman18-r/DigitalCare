@extends('layouts.dokter')

@section('title', 'Profil Saya')
@section('subtitle', 'Informasi akun dan data profesional dokter.')

@section('content')

@php
    $user   = auth()->user();
    $dokter = $user->dokter;
    $foto   = $dokter->foto_profil ? asset('storage/' . $dokter->foto_profil) : null;
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
    <div class="h-44 relative overflow-hidden bg-gradient-to-br from-slate-50 to-teal-50 rounded-t-[32px]">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle, #e2e8f0 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="absolute top-4 right-8 w-32 h-32 rounded-full bg-teal-400/10 border border-teal-200/30"></div>
        <div class="absolute -bottom-4 right-32 w-20 h-20 rounded-full bg-teal-300/10 border border-teal-200/20"></div>
        <div class="absolute top-8 left-1/3 w-16 h-16 rounded-full bg-teal-200/20"></div>
    </div>

    <div class="px-8 pb-8 pt-4">
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative group w-24 h-24 shrink-0 -mt-12 z-10">
                        @if($foto)
                            <img src="{{ $foto }}" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-xl">
                        @else
                            <div class="w-24 h-24 rounded-full bg-teal-500 border-4 border-white shadow-xl flex items-center justify-center text-white font-bold text-3xl">
                                {{ $inisial }}
                            </div>
                        @endif
                        <form action="{{ route('dokter.profile.photo') }}" method="POST" enctype="multipart/form-data"
                              class="absolute inset-0 rounded-full bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition cursor-pointer">
                            @csrf
                            <label class="cursor-pointer text-white text-xs font-semibold flex flex-col items-center gap-1">
                                <i data-lucide="camera" class="w-5 h-5"></i> Upload
                                <input type="file" name="foto_profil" class="hidden" onchange="this.form.submit()">
                            </label>
                        </form>
                    </div>
                    <div class="mb-1">
                        <h1 class="text-2xl font-bold text-slate-800">Dr. {{ $user->nama }}</h1>
                        <p class="text-slate-400 text-sm mt-0.5">{{ $user->email }}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="px-3 py-1 rounded-xl bg-blue-100 text-blue-700 text-xs font-semibold">Dokter</span>
                            <span class="px-3 py-1 rounded-xl bg-green-100 text-green-700 text-xs font-semibold">● {{ ucfirst($dokter->status_ketersediaan) }}</span>
                            <span class="px-3 py-1 rounded-xl bg-cyan-100 text-cyan-700 text-xs font-semibold">{{ $dokter->spesialisasi ?? 'Umum' }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
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
        <div class="xl:col-span-2 space-y-6">

            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-7">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center">
                        <i data-lucide="user-round" class="w-5 h-5 text-blue-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Informasi Pribadi</h2>
                        <p class="text-xs text-slate-400">Data pribadi dokter</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Nama Lengkap</p>
                        <p class="font-semibold text-slate-800">Dr. {{ $user->nama }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Email</p>
                        <p class="font-semibold text-slate-800">{{ $user->email }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Jenis Kelamin</p>
                        <p class="font-semibold text-slate-800">{{ $dokter->gender ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Nomor Telepon</p>
                        <p class="font-semibold text-slate-800">{{ $dokter->phone ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-7">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center">
                        <i data-lucide="stethoscope" class="w-5 h-5 text-cyan-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Informasi Profesional</h2>
                        <p class="text-xs text-slate-400">Data medis dan lisensi praktik</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">ID Dokter</p>
                        <p class="font-semibold text-slate-800">DOC-{{ str_pad($dokter->id_dokter, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">No. SIP</p>
                        <p class="font-semibold text-slate-800">{{ $dokter->no_sip ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Spesialisasi</p>
                        <p class="font-semibold text-slate-800">{{ $dokter->spesialisasi ?? 'Umum' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Status Ketersediaan</p>
                        <p class="font-semibold text-green-600">{{ ucfirst($dokter->status_ketersediaan) }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 md:col-span-2">
                        <p class="text-xs text-slate-400 mb-1">Biografi</p>
                        <p class="font-semibold text-slate-800">{{ $dokter->bio ?? '-' }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-50 flex items-center justify-center">
                        <i data-lucide="bar-chart-2" class="w-5 h-5 text-yellow-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Statistik</h2>
                        <p class="text-xs text-slate-400">Ringkasan praktik dokter</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="bg-blue-50 rounded-2xl p-4">
                        <p class="text-xs text-blue-600">Total Pasien</p>
                        <p class="text-2xl font-bold text-blue-700 mt-1">{{ $dokter->appointments()->count() ?? 0 }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400">Bergabung Sejak</p>
                        <p class="font-semibold text-slate-800 mt-1">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400">Status Akun</p>
                        <p class="font-semibold text-green-600 mt-1">Aktif</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center">
                            <i data-lucide="calendar-clock" class="w-5 h-5 text-cyan-500"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-slate-800">Jadwal Hari Ini</h2>
                            <p class="text-xs text-slate-400">{{ now()->translatedFormat('l, d M Y') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('dokter.jadwal') }}" class="text-xs text-blue-500 hover:text-blue-700 font-semibold transition">Lihat Semua →</a>
                </div>
                @forelse($dokter->jadwalDokter()->whereDate('tanggal', today())->get() ?? [] as $jadwal)
                <div class="bg-slate-50 rounded-2xl p-4 mb-3">
                    <p class="font-semibold text-slate-800 text-sm">{{ $jadwal->jam_mulai }} – {{ $jadwal->jam_selesai }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $jadwal->keterangan ?? 'Praktik Umum' }}</p>
                </div>
                @empty
                <div class="text-center py-6">
                    <i data-lucide="calendar-x-2" class="w-10 h-10 text-slate-200 mx-auto mb-2"></i>
                    <p class="text-slate-400 text-sm">Tidak ada jadwal hari ini</p>
                </div>
                @endforelse
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
        <form action="{{ route('dokter.password.update') }}" method="POST" class="px-7 py-6 space-y-4">
            @csrf
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
                        class="flex-1 py-3 rounded-2xl bg-teal-500 hover:bg-blue-600 text-white font-semibold text-sm transition shadow-lg shadow-teal-100">Simpan</button>
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