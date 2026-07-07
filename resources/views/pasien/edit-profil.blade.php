@extends('layouts.pasien')

@section('title', 'Edit Profil')
@section('subtitle', 'Perbarui informasi pribadi dan detail akun.')

@section('content')

@php
    $user   = auth()->user();
    $pasien = $user->pasien;
    $inisial = collect(explode(' ', $user->nama))
        ->filter()->take(2)
        ->map(fn($w) => strtoupper(substr($w, 0, 1)))
        ->join('');
@endphp

@if($errors->any())
<div class="mb-4 px-5 py-3.5 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm font-medium flex items-center gap-2">
    <i data-lucide="circle-x" class="w-4 h-4"></i> Periksa kembali isian form.
</div>
@endif

<form action="{{ route('profile.update') }}" method="POST">
@csrf
@method('PUT')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- KARTU PROFIL --}}
    <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center">
        <div class="w-20 h-20 rounded-full bg-teal-500 flex items-center justify-center text-white font-bold text-2xl mb-4 shadow-lg">
            {{ $inisial }}
        </div>
        <h2 class="text-lg font-bold text-slate-800">{{ $user->nama }}</h2>
        <p class="text-slate-400 text-sm mt-0.5">{{ $user->email }}</p>
        <div class="mt-3 flex gap-2 flex-wrap justify-center">
            <span class="px-3 py-1 rounded-xl bg-teal-100 text-teal-700 text-xs font-semibold">Pasien</span>
            <span class="px-3 py-1 rounded-xl bg-green-100 text-green-700 text-xs font-semibold">● Aktif</span>
        </div>
        <div class="mt-5 w-full space-y-3 text-sm border-t border-slate-100 pt-5">
            <div class="flex justify-between items-center">
                <span class="text-slate-400">ID Pasien</span>
                <span class="font-semibold text-slate-700">PAS-{{ str_pad($pasien?->id_pasien ?? 0, 3, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-400">Telepon</span>
                <span class="font-semibold text-slate-700">{{ $pasien?->phone_number ?? '-' }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-400">Kelamin</span>
                <span class="font-semibold text-slate-700">{{ $pasien?->gender ?? '-' }}</span>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="lg:col-span-2 bg-white rounded-[28px] border border-slate-100 shadow-sm p-7">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-2xl bg-teal-50 flex items-center justify-center">
                <i data-lucide="user-pen" class="w-5 h-5 text-teal-500"></i>
            </div>
            <div>
                <h2 class="font-bold text-slate-800">Informasi Pribadi</h2>
                <p class="text-xs text-slate-400">Perbarui data diri Anda</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}"
                       class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                    NIK
                </label>

                <input
                    type="text"
                    name="nik"
                    value="{{ old('nik', $pasien?->nik ?? '') }}"
                    class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">

                @error('nik')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Telepon</label>
                <input type="text"
                    name="phone_number"
                    value="{{ old('phone_number', $pasien?->phone_number ?? '') }}"
                    class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">

                @error('phone_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jenis Kelamin</label>
                <select name="gender" class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 bg-white">
                    <option value="Male"   {{ ($pasien?->gender ?? '') == 'Male'   ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Female" {{ ($pasien?->gender ?? '') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                Tanggal Lahir
            </label>

            <input
                type="date"
                name="birth_date"
                value="{{ old('birth_date', $pasien?->birth_date ?? '') }}"
                class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">

            @error('birth_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-5">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat</label>
            <textarea name="address" rows="3"
                      class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 resize-none">{{ old('address', $pasien?->address ?? '') }}</textarea>
            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('profile.show') }}"
               class="px-6 py-3 rounded-2xl border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50 transition">Batal</a>
            <button type="submit"
                    class="px-6 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white text-sm font-semibold transition shadow-lg shadow-teal-100">Simpan Perubahan</button>
        </div>
    </div>

</div>
</form>

@endsection