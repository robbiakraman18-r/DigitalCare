@extends('layouts.admin')

@section('title', 'Profil Saya')
@section('subtitle', 'Informasi akun dan aktivitas administrator.')

@section('content')

@php
    $user   = auth()->user();
    $nama   = $user->nama;
    $email  = $user->email;
    $userId = $user->id;
    $inisial = collect(explode(' ', $nama))
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
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
        <div class="h-44 relative overflow-hidden bg-gradient-to-br from-slate-50 to-red-50">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, #e2e8f0 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div class="absolute top-4 right-8 w-32 h-32 rounded-full bg-red-400/10 border border-red-200/30"></div>
            <div class="absolute -bottom-4 right-32 w-20 h-20 rounded-full bg-red-300/10 border border-red-200/20"></div>
            <div class="absolute top-8 left-1/3 w-16 h-16 rounded-full bg-red-200/20"></div>
        </div>

        <div class="px-8 pb-8">
            <div class="flex flex-col xl:flex-row xl:items-end xl:justify-between gap-6 -mt-12">
                <div class="flex items-end gap-5">
                    <div class="w-24 h-24 rounded-full bg-red-500 border-4 border-white shadow-xl
                                flex items-center justify-center text-white font-bold text-3xl shrink-0">
                        {{ $inisial }}
                    </div>
                    <div class="mb-1">
                        <h1 class="text-2xl font-bold text-slate-800">{{ $nama }}</h1>
                        <p class="text-slate-400 text-sm mt-0.5">{{ $email }}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="px-3 py-1 rounded-xl bg-red-100 text-red-700 text-xs font-semibold">Super Admin</span>
                            <span class="px-3 py-1 rounded-xl bg-green-100 text-green-700 text-xs font-semibold">● Aktif</span>
                            <span class="px-3 py-1 rounded-xl bg-blue-100 text-blue-700 text-xs font-semibold">Full Access</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button onclick="document.getElementById('modalPassword').classList.remove('hidden')"
                            class="px-5 py-2.5 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold text-sm transition shadow-lg shadow-red-100 flex items-center gap-2">
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
                    <div class="w-10 h-10 rounded-2xl bg-red-50 flex items-center justify-center">
                        <i data-lucide="user-round" class="w-5 h-5 text-red-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Informasi Pribadi</h2>
                        <p class="text-xs text-slate-400">Data akun administrator</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Nama Lengkap</p>
                        <p class="font-semibold text-slate-800">{{ $nama }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Email</p>
                        <p class="font-semibold text-slate-800">{{ $email }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">ID Admin</p>
                        <p class="font-semibold text-slate-800">ADM-{{ str_pad($userId, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 mb-1">Nomor Telepon</p>
                        <p class="font-semibold text-slate-800">{{ $user->phone ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 md:col-span-2">
                        <p class="text-xs text-slate-400 mb-1">Alamat</p>
                        <p class="font-semibold text-slate-800">{{ $user->address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-7">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center">
                        <i data-lucide="activity" class="w-5 h-5 text-blue-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Aktivitas Terbaru</h2>
                        <p class="text-xs text-slate-400">Tindakan administrator terkini</p>
                    </div>
                </div>
                <div class="space-y-4">
                    @php
                        $activities = [
                            ['icon' => 'badge-check',      'color' => 'green', 'title' => 'Pembayaran Dikonfirmasi',   'desc' => 'Pembayaran tunai pasien berhasil dikonfirmasi.',   'time' => '10 menit lalu'],
                            ['icon' => 'calendar-check-2', 'color' => 'blue',  'title' => 'Janji Diperbarui',          'desc' => 'Jadwal appointment klinik telah diperbarui.',      'time' => '1 jam lalu'],
                            ['icon' => 'user-plus',        'color' => 'cyan',  'title' => 'Pengguna Baru Ditambahkan', 'desc' => 'Akun dokter baru berhasil ditambahkan ke sistem.', 'time' => '3 jam lalu'],
                        ];
                    @endphp
                    @foreach($activities as $act)
                    <div class="flex gap-4 p-4 rounded-2xl hover:bg-slate-50 transition">
                        <div class="w-10 h-10 rounded-xl bg-{{ $act['color'] }}-100 flex items-center justify-center shrink-0">
                            <i data-lucide="{{ $act['icon'] }}" class="w-5 h-5 text-{{ $act['color'] }}-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">{{ $act['title'] }}</p>
                            <p class="text-slate-400 text-xs mt-0.5">{{ $act['desc'] }}</p>
                            <p class="text-slate-300 text-xs mt-1">{{ $act['time'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-50 flex items-center justify-center">
                        <i data-lucide="shield-check" class="w-5 h-5 text-yellow-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Status Akun</h2>
                        <p class="text-xs text-slate-400">Keamanan & izin akses</p>
                    </div>
                </div>
                <div class="space-y-3">
                    @php
                        $accountInfo = [
                            ['label' => 'Role',          'value' => 'Super Admin', 'color' => 'text-slate-700'],
                            ['label' => 'Level Akses',   'value' => 'Full Access', 'color' => 'text-red-500'],
                            ['label' => 'Login Terakhir','value' => 'Hari ini',    'color' => 'text-slate-700'],
                            ['label' => 'Status',        'value' => 'Online',      'color' => 'text-green-500'],
                        ];
                    @endphp
                    @foreach($accountInfo as $info)
                    <div class="flex justify-between items-center py-2 border-b border-slate-50 last:border-0">
                        <span class="text-slate-400 text-sm">{{ $info['label'] }}</span>
                        <span class="font-semibold text-sm {{ $info['color'] }}">{{ $info['value'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-2xl bg-slate-100 flex items-center justify-center">
                        <i data-lucide="monitor-smartphone" class="w-5 h-5 text-slate-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Info Sistem</h2>
                        <p class="text-xs text-slate-400">Perangkat & sesi aktif</p>
                    </div>
                </div>
                <div class="space-y-3">
                    @foreach([['Browser','Google Chrome'],['Perangkat','Windows Desktop'],['IP Address','192.168.1.1']] as [$label, $val])
                    <div class="bg-slate-50 rounded-xl p-4">
                        <p class="text-xs text-slate-400">{{ $label }}</p>
                        <p class="font-semibold text-slate-800 mt-1 text-sm">{{ $val }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL PASSWORD --}}
<div id="modalPassword" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4">
    <div class="bg-white rounded-[28px] shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-red-500 px-7 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center">
                    <i data-lucide="lock-keyhole" class="w-5 h-5 text-white"></i>
                </div>
                <div>
                    <h2 class="font-bold text-white">Ubah Password</h2>
                    <p class="text-red-100 text-xs">Perbarui kata sandi akun Anda</p>
                </div>
            </div>
            <button onclick="document.getElementById('modalPassword').classList.add('hidden')"
                    class="w-8 h-8 rounded-xl bg-white/20 hover:bg-white/30 flex items-center justify-center transition">
                <i data-lucide="x" class="w-4 h-4 text-white"></i>
            </button>
        </div>
        <form action="{{ route('admin.password.update') }}" method="POST" class="px-7 py-6 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="text-sm font-semibold text-slate-700 block mb-1.5">Password Saat Ini</label>
                <div class="relative">
                    <input type="password" name="current_password" placeholder="••••••••"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 pr-11">
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
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 pr-11">
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
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 pr-11">
                    <button type="button" onclick="togglePass(this)" class="absolute right-3 top-3 text-slate-400 hover:text-slate-600">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="document.getElementById('modalPassword').classList.add('hidden')"
                        class="flex-1 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm transition">Batal</button>
                <button type="submit"
                        class="flex-1 py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold text-sm transition shadow-lg shadow-red-100">Simpan</button>
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