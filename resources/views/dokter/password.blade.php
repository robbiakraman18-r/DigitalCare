@extends('layouts.dokter')

@section('content')

<div class="max-w-xl mx-auto p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Ubah Password</h1>
        <p class="text-slate-500">Pastikan password baru Anda aman dan kuat</p>
    </div>

    <!-- SUCCESS / ERROR NOTIFICATION -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-green-100 text-green-700 border border-green-200">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 rounded-2xl bg-red-100 text-red-700 border border-red-200">
            ❌ {{ session('error') }}
        </div>
    @endif

    <!-- CARD -->
    <div class="bg-white border border-slate-100 rounded-3xl shadow-sm p-8">

        <form method="POST" action="{{ route('dokter.password.update') }}" class="space-y-5">
            @csrf

            <!-- PASSWORD LAMA -->
            <div>
                <label class="text-sm text-slate-500">Password Lama</label>
                <input type="password" name="current_password"
                    class="mt-2 w-full p-3 border rounded-2xl focus:ring-2 focus:ring-teal-200 outline-none">

                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD BARU -->
            <div>
                <label class="text-sm text-slate-500">Password Baru</label>
                <input type="password" name="password"
                    class="mt-2 w-full p-3 border rounded-2xl focus:ring-2 focus:ring-teal-200 outline-none">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KONFIRMASI -->
            <div>
                <label class="text-sm text-slate-500">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="mt-2 w-full p-3 border rounded-2xl focus:ring-2 focus:ring-teal-200 outline-none">
            </div>

            <!-- BUTTON -->
            <button class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 text-white py-3 rounded-2xl shadow-md hover:shadow-lg transition">
                Simpan Password Baru
            </button>

        </form>

    </div>

    <!-- INFO NOTE -->
    <p class="text-xs text-slate-400 text-center">
        Gunakan kombinasi huruf, angka, dan simbol untuk keamanan lebih baik.
    </p>

</div>

@endsection