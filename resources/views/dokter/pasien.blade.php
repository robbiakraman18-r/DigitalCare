{{-- resources/views/dokter/pasien.blade.php --}}
@extends('layouts.dokter')

@section('title', 'Data Pasien Dan Rekam Medis')
@section('subtitle', 'Daftar semua pasien dan rekam medis')

@section('content')
<div class="space-y-5">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Data Pasien</h1>
            <p class="text-xs text-slate-400 mt-0.5">{{ $pasiens->total() }} pasien terdaftar</p>
        </div>
        <form method="GET" action="{{ route('dokter.pasien') }}">
            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                <input
                    type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama pasien..."
                    class="pl-9 pr-4 py-2.5 text-sm border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-teal-300 w-64 bg-white"
                >
            </div>
        </form>
    </div>

    {{-- LIST PASIEN --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        {{-- TABLE HEADER --}}
        <div class="hidden sm:grid grid-cols-12 px-5 py-3 border-b border-slate-100 bg-slate-50/80">
            <div class="col-span-5 text-xs font-semibold text-slate-400 uppercase tracking-wide">Pasien</div>
            <div class="col-span-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Kontak</div>
            <div class="col-span-2 text-xs font-semibold text-slate-400 uppercase tracking-wide text-center">Kunjungan</div>
            <div class="col-span-2 text-xs font-semibold text-slate-400 uppercase tracking-wide text-right">Aksi</div>
        </div>

        <div class="divide-y divide-slate-50">
            @forelse($pasiens as $pasien)
            @php
                $nama    = $pasien->user->name ?? 'Pasien';
                $inisial = collect(explode(' ', $nama))->take(2)->map(fn($w) => strtoupper($w[0]))->join('');
                $colors  = ['teal','cyan','indigo','purple','orange','pink'];
                $color   = $colors[$pasien->id_pasien % count($colors)];
            @endphp

            <div class="grid grid-cols-12 items-center px-5 py-4 hover:bg-teal-50/40 transition">

                {{-- AVATAR + NAMA --}}
                <div class="col-span-10 sm:col-span-5 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-{{ $color }}-100 text-{{ $color }}-600 flex items-center justify-center text-sm font-bold shrink-0">
                        {{ $inisial }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800">{{ $nama }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $pasien->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            &nbsp;·&nbsp;
                            {{ $pasien->birth_date ? \Carbon\Carbon::parse($pasien->birth_date)->age . ' thn' : '-' }}
                        </p>
                    </div>
                </div>

                {{-- KONTAK --}}
                <div class="col-span-3 hidden sm:block">
                    <p class="text-sm text-slate-600">{{ $pasien->phone_number ?? '-' }}</p>
                    <p class="text-xs text-slate-400 mt-0.5 truncate">{{ $pasien->user->email ?? '-' }}</p>
                </div>

                {{-- KUNJUNGAN --}}
                <div class="col-span-2 hidden sm:flex flex-col items-center">
                    <p class="text-lg font-bold text-slate-800">{{ $pasien->appointments->count() }}</p>
                    <p class="text-[10px] text-slate-400">kunjungan</p>
                </div>

                {{-- AKSI --}}
                <div class="col-span-2 flex justify-end gap-2">
                    {{-- Detail Pasien --}}
                    <a href="{{ route('dokter.detailpasien', $pasien->id_pasien) }}"
                       class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-teal-50 text-teal-600 text-xs font-semibold hover:bg-teal-100 transition">
                        <i data-lucide="user" class="w-3.5 h-3.5"></i>
                        <span class="hidden sm:inline">Detail</span>
                    </a>
                    {{-- Rekam Medis pasien ini --}}
                    <a href="{{ route('dokter.rekammedis', ['id_pasien' => $pasien->id_pasien]) }}"
                       class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-cyan-50 text-cyan-600 text-xs font-semibold hover:bg-cyan-100 transition">
                        <i data-lucide="file-heart" class="w-3.5 h-3.5"></i>
                        <span class="hidden sm:inline">Rekam</span>
                    </a>
                </div>

            </div>
            @empty
            <div class="py-16 text-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="users" class="w-7 h-7 text-slate-400"></i>
                </div>
                <p class="text-sm font-medium text-slate-500">Belum ada data pasien</p>
                <p class="text-xs text-slate-400 mt-1">Pasien akan muncul setelah kunjungan pertama</p>
            </div>
            @endforelse
        </div>

        @if($pasiens->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $pasiens->links() }}
        </div>
        @endif

    </div>
</div>
@endsection