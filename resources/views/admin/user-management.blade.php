@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- TOP -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Manajemen Pengguna
            </h1>

            <p class="text-slate-400 mt-1">
                Kelola pengguna sistem, peran, dan hak akses.
            </p>

        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.doctor.create') }}"
            class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                + Tambah Dokter

            </a>
        </div>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Total Pengguna
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $users->count() }}
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        Pengguna Sistem
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Dokter
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $users->where('role', 'dokter')->count() }}
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        Dokter Aktif
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="stethoscope" class="w-6 h-6 text-cyan-600"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Pasien
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $users->where('role', 'pasien')->count() }}
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        Pasien Terdaftar
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">

                    <i data-lucide="briefcase" class="w-6 h-6 text-slate-600"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Pengguna Terdaftar
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $users->count() }}
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        Akun Aktif Saat Ini
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i data-lucide="user-check" class="w-6 h-6 text-green-600"></i>

                </div>

            </div>

        </div>

    </div>

@if(session('success'))
    <div class="mb-4 p-3 rounded-xl bg-green-500 text-white">
        {{ session('success') }}
    </div>
@endif

    <!-- TABLE -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- FILTER -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-5 border-b border-slate-100">

            <form
            method="GET"
            action="{{ url()->current() }}"
            class="flex flex-col lg:flex-row gap-4 w-full">

                <!-- SEARCH -->
                <div class="relative w-full lg:w-96">

                    <i data-lucide="search"
                    class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                    <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari pengguna, peran, email..."
                    class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div class="relative w-full lg:w-64">

                    <i data-lucide="filter"
                    class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                    <select
                        name="role"
                        class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">

                        <option value="">
                            Semua Peran
                        </option>

                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                            🛡️ Admin
                        </option>

                        <option value="dokter" {{ request('role') == 'dokter' ? 'selected' : '' }}>
                            🩺 Dokter
                        </option>

                        <option value="pasien" {{ request('role') == 'pasien' ? 'selected' : '' }}>
                            👤 Pasien
                        </option>

                    </select>

                    <!-- dropdown arrow custom -->
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>
                    </div>

                </div>

                <!-- BUTTON -->
                <button
                type="submit"
                class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                    Filter

                </button>

            </form>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Pengguna
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Peran
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Dibuat
                        </th>

                        <th class="px-6 py-4 text-center text-sm text-slate-400">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($users as $user)

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                @if($user->role == 'dokter' && optional($user->dokter)->foto_profil)

                                    <img
                                    src="{{ asset('storage/' . $user->dokter->foto_profil) }}"
                                    class="w-11 h-11 rounded-2xl object-cover">

                                @else

                                    @php
                                        $inisial = collect(explode(' ', $user->nama))
                                            ->filter()
                                            ->take(2)
                                            ->map(fn($item) => strtoupper(substr($item, 0, 1)))
                                            ->join('');

                                        if($user->role == 'admin'){
                                            $bg = 'bg-red-500';
                                        }elseif($user->role == 'dokter'){
                                            $bg = 'bg-blue-500';
                                        }else{
                                            $bg = 'bg-green-500';
                                        }
                                    @endphp

                                    <div class="w-11 h-11 rounded-2xl {{ $bg }} flex items-center justify-center text-white font-bold text-sm">
                                        {{ $inisial }}
                                    </div>

                                @endif

                                <div>
                                    @php
                                        if ($user->role == 'admin') {
                                            $userCode = 'ADM-' . str_pad(optional($user->admin)->id_admin, 4, '0', STR_PAD_LEFT);
                                        } elseif ($user->role == 'dokter') {
                                            $userCode = 'DOC-' . str_pad(optional($user->dokter)->id_dokter, 4, '0', STR_PAD_LEFT);
                                        } elseif ($user->role == 'pasien') {
                                            $userCode = 'PAS-' . str_pad(optional($user->pasien)->id_pasien, 4, '0', STR_PAD_LEFT);
                                        } else {
                                            $userCode = 'USR-' . str_pad($user->id, 4, '0', STR_PAD_LEFT);
                                        }
                                    @endphp
                                    <h3 class="font-semibold text-slate-800">
                                        {{ $user->nama }}
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        {{ $userCode }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5">

                            @php
                                $roleUI = [
                                    'admin' => [
                                        'label' => 'Admin',
                                        'class' => 'bg-gradient-to-r from-red-500 to-pink-500 text-white',
                                        'icon'  => 'shield-check'
                                    ],
                                    'dokter' => [
                                        'label' => 'Dokter',
                                        'class' => 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white',
                                        'icon'  => 'stethoscope'
                                    ],
                                    'pasien' => [
                                        'label' => 'Pasien',
                                        'class' => 'bg-gradient-to-r from-green-500 to-emerald-500 text-white',
                                        'icon'  => 'user'
                                    ],
                                ];

                                $r = $roleUI[$user->role] ?? [
                                    'label' => ucfirst($user->role),
                                    'class' => 'bg-slate-200 text-slate-700',
                                    'icon'  => 'user'
                                ];
                            @endphp

                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold shadow-sm {{ $r['class'] }}">
                                <i data-lucide="{{ $r['icon'] }}" class="w-3.5 h-3.5"></i>
                                {{ $r['label'] }}
                            </span>

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-5">

                            @if($user->status == 'active')
                                <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                    Aktif
                                </span>
                            @else
                            <span class="px-3 py-1 rounded-xl bg-red-100 text-red-600 text-xs font-semibold whitespace-nowrap">
                                Tidak Aktif
                            </span>
                            @endif

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <!-- VIEW -->
                                <a
                                href="{{ route('admin.user.view', $user->id) }}"
                                class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-100 transition">

                                    <i data-lucide="eye" class="w-4 h-4"></i>

                                </a>

                                <!-- EDIT (dokter only) -->
                                @if($user->role === 'dokter')
                                <a
                                href="{{ route('admin.user.edit', $user->id) }}"
                                class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-100 transition">

                                    <i data-lucide="square-pen" class="w-4 h-4"></i>

                                </a>
                                @endif

                                <!-- TOGGLE STATUS -->
                                @if($user->role === 'admin')
                                    <span class="px-3 py-1 rounded-xl bg-slate-200 text-slate-500 text-xs font-semibold">
                                        Terlindungi
                                    </span>
                                @else
                                    <button
                                        type="button"
                                        data-id="{{ $user->id }}"
                                        data-status="{{ $user->status }}"
                                        onclick="openStatusModal(this)"
                                        class="relative inline-flex items-center w-12 h-6 rounded-full transition
                                        {{ $user->status === 'active' ? 'bg-green-500' : 'bg-gray-300' }}">

                                        <span class="sr-only">toggle</span>

                                        <span class="
                                            absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md
                                            transition-transform duration-200
                                            {{ $user->status === 'active' ? 'translate-x-6' : 'translate-x-0' }}">
                                        </span>

                                    </button>
                                @endif

                                <!-- DELETE -->
                                <form
                                action="{{ route('admin.user.delete', $user->id) }}"
                                method="POST"
                                class="m-0 p-0 flex">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                    type="submit"
                                    onclick="return confirm('Hapus pengguna ini?')"
                                    class="w-9 h-9 rounded-xl border border-red-200 flex items-center justify-center hover:bg-red-50 transition">

                                        <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- STATUS MODAL -->
<div id="statusModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md rounded-[28px] p-6 shadow-2xl">

        <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center mb-4">
            <i data-lucide="alert-triangle" class="w-6 h-6 text-amber-500"></i>
        </div>

        <h2 class="text-xl font-bold text-slate-800">
            Ubah Status Pengguna
        </h2>

        <p class="text-slate-500 mt-2 text-sm">
            Apakah Anda yakin ingin mengubah status pengguna ini?
        </p>

        <div class="flex justify-end gap-3 mt-6">

            <button
                onclick="closeStatusModal()"
                class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600">
                Batal
            </button>

            <form id="statusForm" method="POST">
                @csrf
                @method('PUT')

                <button
                    type="submit"
                    class="px-4 py-2 rounded-xl bg-red-500 text-white">
                    Ya, Lanjutkan
                </button>
            </form>

        </div>

    </div>
</div>

<script>
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function () {
        const btn = this.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerText = "Memproses...";
        }
    });
});

function openStatusModal(btn) {
    const userId = btn.getAttribute('data-id');
    const form = document.getElementById('statusForm');
    form.action = `/admin/user/${userId}/toggle-status`;
    document.getElementById('statusModal').classList.remove('hidden');
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
}
</script>

@endsection