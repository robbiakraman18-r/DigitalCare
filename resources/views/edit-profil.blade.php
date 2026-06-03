@extends('layouts.pasien')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
        <h2 class="text-2xl font-bold mb-6">Edit Profil</h2>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl text-sm">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->nama) }}" class="w-full px-4 py-3 border rounded-xl" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 border rounded-xl" required>
            </div>
            <div>
                <label>Jenis Kelamin</label>
                <select name="gender" class="w-full px-4 py-3 border rounded-xl" required>
                    <option value="Laki-laki" {{ optional($user->pasien)->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ optional($user->pasien)->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div>
                <label>Alamat</label>
                <textarea name="address" class="w-full px-4 py-3 border rounded-xl" required>{{ old('address', optional($user->pasien)->alamat) }}</textarea>
            </div>
            <button type="submit" class="w-full py-4 bg-emerald-500 text-white rounded-xl font-bold">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection