@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- TOP -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                User Management
            </h1>

            <p class="text-slate-400 mt-1">
                Manage system users, roles and permissions.
            </p>

        </div>

        <div class="flex items-center gap-3">

            <button
            onclick="openModal()"
            class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                + Add Doctor

            </button>

        </div>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-400 text-sm">
                        Total Users
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $users->count() }}
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        System Users
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
                        Doctors
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $users->where('role', 'dokter')->count() }}
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        Active Doctors
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
                        Patients
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $users->where('role', 'pasien')->count() }}
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        Registered Patients
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
    Registered Users
</p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $users->count() }}
                    </h2>

                    <p class="text-green-500 text-sm mt-2">
                        Current Active Accounts
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
                    placeholder="Search user, role, email..."
                    class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div class="relative w-full lg:w-64">

    <i data-lucide="filter"
       class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

    <select
        name="role"
        class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">

        <option value="">
            All Roles
        </option>

        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
            🛡️ Admin
        </option>

        <option value="dokter" {{ request('role') == 'dokter' ? 'selected' : '' }}>
            🩺 Doctor
        </option>

        <option value="pasien" {{ request('role') == 'pasien' ? 'selected' : '' }}>
            👤 Patient
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
                            User
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Role
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400">
                            Created
                        </th>

                        <th class="px-6 py-4 text-center text-sm text-slate-400">
                            Actions
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

                                    <h3 class="font-semibold text-slate-800">
                                        {{ $user->nama }}
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        USER-{{ $user->id }}
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
        'label' => 'Doctor',
        'class' => 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white',
        'icon'  => 'stethoscope'
    ],
    'pasien' => [
        'label' => 'Patient',
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
            Active
        </span>
    @else
        <span class="px-3 py-1 rounded-xl bg-red-100 text-red-600 text-xs font-semibold">
            Inactive
        </span>
    @endif

</td>




                        <td class="px-6 py-5 text-slate-600">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <!-- VIEW -->
                                <button
                                onclick="document.getElementById('viewUserModal{{ $user->id }}').classList.remove('hidden')"
                                class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-100 transition">

                                    <i data-lucide="eye" class="w-4 h-4"></i>

                                </button>

                                <!-- EDIT -->
                                <button
                                onclick="document.getElementById('editUserModal{{ $user->id }}').classList.remove('hidden')"
                                class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-100 transition">

                                    <i data-lucide="square-pen" class="w-4 h-4"></i>

                                </button>

                                <!-- TOGGLE STATUS -->
                                @if($user->role === 'admin')
    <span class="px-3 py-1 rounded-xl bg-slate-200 text-slate-500 text-xs font-semibold">
        Protected
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
                                    onclick="return confirm('Delete this user?')"
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

<!-- ADD DOCTOR MODAL -->
<div
id="addDoctorModal"
class="fixed inset-0 bg-black/40 hidden z-50 overflow-y-auto py-10 scrollbar-hide">

   <div class="bg-white w-full max-w-2xl rounded-[30px] p-8 shadow-xl mx-auto">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold text-slate-800">
                Add Doctor
            </h2>

            <button
            onclick="closeModal()"
            class="text-slate-500 text-2xl">

                ×

            </button>

        </div>

        <form action="{{ route('admin.doctor.store') }}"
        method="POST"
        enctype="multipart/form-data">

        <div class="p-8 overflow-y-auto scrollbar-hide flex-1">
            @csrf

            <div class="grid grid-cols-2 gap-5">

                <div class="col-span-2">

                    <label class="font-medium text-slate-700">
                        Doctor Name
                    </label>

                    <input
                    type="text"
                    name="nama"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                </div>

                <div>

                    <label class="font-medium text-slate-700">
                        Email
                    </label>

                    <input
                    type="email"
                    name="email"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                </div>

                <div>

                    <label class="font-medium text-slate-700">
                        Password
                    </label>

                    <input
                    type="password"
                    name="password"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                </div>

                <div>

                    <label class="font-medium text-slate-700">
                        No SIP
                    </label>

                    <input
                    type="text"
                    name="no_sip"
                    class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                </div>

                <div>
                    <label class="font-medium text-slate-700">
                        Gender
                    </label>

                    <select
                        name="gender"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>

                    </select>
                </div>

                <div>
                    <label class="font-medium text-slate-700">
                        Status
                    </label>

                    <select
                        name="status_ketersediaan"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                        <option value="Available">Available</option>
                        <option value="Unavailable">Unavailable</option>

                    </select>
                </div>

                <div class="col-span-2">
                    <label class="font-medium text-slate-700">
                        Foto Profil
                    </label>

                    <input
                        type="file"
                        name="foto_profil"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">
                </div>

            </div>

           <div class="flex justify-end gap-3 mt-8">

    <button
    type="button"
    onclick="closeModal()"
    class="px-5 py-3 rounded-2xl border border-slate-200">

        Cancel

    </button>

    <button
    type="submit"
    class="px-5 py-3 rounded-2xl bg-blue-600 text-white">

        Save Doctor

    </button>

</div>
</div>

        </form>

    </div>

</div>

{{-- VIEW + EDIT MODAL --}}
@foreach($users as $user)

<!-- VIEW MODAL -->
<div
id="viewUserModal{{ $user->id }}"
class="fixed inset-0 bg-black/40 hidden z-50 flex items-center justify-center">

    <div class="bg-white w-full max-w-lg rounded-[30px] p-8 shadow-xl">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold text-slate-800">
                @if($user->role == 'dokter')
                    Doctor Profile
                @elseif($user->role == 'admin')
                    Admin Profile
                @else
                    Patient Profile
                @endif
            </h2>

            <button
            onclick="document.getElementById('viewUserModal{{ $user->id }}').classList.add('hidden')"
            class="text-slate-500 text-2xl">

                ×

            </button>

        </div>

        <div class="space-y-4">

            @if($user->role == 'dokter')

            @php
            $dokter = \App\Models\Dokter::where('user_id',$user->id)->first();
            @endphp

            <div class="space-y-4">

                @php
$dokter = \App\Models\Dokter::where('user_id', $user->id)->first();
@endphp

<div>
    <p class="text-sm text-slate-400">Name</p>
    <h3 class="font-semibold text-slate-800">
        {{ $user->nama }}
    </h3>
</div>

<div>
    <p class="text-sm text-slate-400">Email</p>
    <h3 class="font-semibold text-slate-800">
        {{ $user->email }}
    </h3>
</div>

@if($user->role == 'dokter')

<div>
    <p class="text-sm text-slate-400">No SIP</p>
    <h3 class="font-semibold text-slate-800">
        {{ optional($dokter)->no_sip ?? '-' }}
    </h3>
</div>

<div>
    <p class="text-sm text-slate-400">Gender</p>
    <h3 class="font-semibold text-slate-800">
        {{ optional($dokter)->gender ?? '-' }}
    </h3>
</div>

<div>
    <p class="text-sm text-slate-400">Status Ketersediaan</p>
    <h3 class="font-semibold text-slate-800">
        {{ optional($dokter)->status_ketersediaan ?? '-' }}
    </h3>
</div>

@endif

<div>
    <p class="text-sm text-slate-400">Role</p>
    <h3 class="font-semibold text-slate-800">
        {{ ucfirst($user->role) }}
    </h3>
</div>

<div>
    <p class="text-sm text-slate-400">Created</p>
    <h3 class="font-semibold text-slate-800">
        {{ $user->created_at->format('d M Y H:i') }}
    </h3>
</div>
            </div>

            @else

            <div class="space-y-4">

                <div>
                    <p class="text-sm text-slate-400">Name</p>
                    <h3 class="font-semibold">{{ $user->nama }}</h3>
                </div>

                <div>
                    <p class="text-sm text-slate-400">Email</p>
                    <h3 class="font-semibold">{{ $user->email }}</h3>
                </div>

                <div>
                    <p class="text-sm text-slate-400">Role</p>
                    <h3 class="font-semibold">{{ ucfirst($user->role) }}</h3>
                </div>

            </div>

            @endif

        </div>

    </div>

</div>

<!-- EDIT MODAL -->
<div
id="editUserModal{{ $user->id }}"
class="fixed inset-0 bg-black/40 hidden z-50 overflow-y-auto py-10 scrollbar-hide">

    <div class="bg-white w-full max-w-xl rounded-[30px] p-8 shadow-xl mx-auto">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold text-slate-800">
                @if($user->role == 'dokter')
                    Edit Doctor
                @elseif($user->role == 'admin')
                    Edit Admin
                @else
                    Edit Patient
                @endif
            </h2>

            <button
            onclick="document.getElementById('editUserModal{{ $user->id }}').classList.add('hidden')"
            class="text-slate-500 text-2xl">

                ×

            </button>

        </div>

        <form
        action="{{ route('admin.user.update', $user->id) }}"
        method="POST">

            @csrf
            @method('PUT')

            <div class="space-y-5">

                <div>

                    <label class="font-medium text-slate-700">
                        Name
                    </label>

                    <input
                    type="text"
                    name="nama"
                    value="{{ $user->nama }}"
                    class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                </div>

                <div>

                    <label class="font-medium text-slate-700">
                        Email
                    </label>

                    <input
                    type="email"
                    name="email"
                    value="{{ $user->email }}"
                    class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

                </div>

                @if($user->role == 'dokter')

<div>
    <label class="font-medium text-slate-700">
        No SIP
    </label>

    <input
    type="text"
    name="no_sip"
    value="{{ optional($dokter)->no_sip }}"
    class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">
</div>

<div>
    <label class="font-medium text-slate-700">
        Gender
    </label>

    <select
    name="gender"
    class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

        <option value="Laki-laki" {{ optional($dokter)->gender=='Laki-laki'?'selected':'' }}>
            Laki-laki
        </option>

        <option value="Perempuan" {{ optional($dokter)->gender=='Perempuan'?'selected':'' }}>
            Perempuan
        </option>

    </select>
</div>

<div>
    <label class="font-medium text-slate-700">
        Status Ketersediaan
    </label>

    <select
    name="status_ketersediaan"
    class="w-full mt-2 px-4 py-3 rounded-2xl border border-slate-200">

        <option value="Available" {{ optional($dokter)->status_ketersediaan=='Available'?'selected':'' }}>
            Available
        </option>

        <option value="Unavailable" {{ optional($dokter)->status_ketersediaan=='Unavailable'?'selected':'' }}>
            Unavailable
        </option>

    </select>
</div>

@endif

                <div>

    <label class="font-medium text-slate-700">
        Role
    </label>

    <input
    type="text"
    value="{{ ucfirst($user->role) }}"
    readonly
    class="w-full mt-2 px-4 py-3 rounded-2xl bg-slate-100 border border-slate-200 cursor-not-allowed">

    <input
    type="hidden"
    name="role"
    value="{{ $user->role }}">

</div>

            </div>

            <div class="flex justify-end gap-3 p-8 bg-white border-t border-slate-100">

                <button
                type="button"
                onclick="document.getElementById('editUserModal{{ $user->id }}').classList.add('hidden')"
                class="px-5 py-3 rounded-2xl border border-slate-200">

                    Cancel

                </button>

                <button
                type="submit"
                class="px-5 py-3 rounded-2xl bg-blue-600 text-white">

                    Update User

                </button>

            </div>

        </form>

    </div>

</div>

@endforeach
<script>
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function () {
        const btn = this.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerText = "Processing...";
        }
    });
});

const modal = document.getElementById('addDoctorModal');


function openModal() {
    modal.classList.remove('hidden');
}

function closeModal() {
    modal.classList.add('hidden');
}

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
<!-- STATUS MODAL -->
<div id="statusModal" class="fixed inset-0 bg-black/40 hidden z-50 flex items-center justify-center">

    <div class="bg-white w-full max-w-md rounded-[28px] p-6 shadow-xl">

        <h2 class="text-xl font-bold text-slate-800">
            Change User Status
        </h2>

        <p class="text-slate-500 mt-2">
            Are you sure you want to change this user's status?
        </p>

        <div class="flex justify-end gap-3 mt-6">

            <button
                onclick="closeStatusModal()"
                class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600">
                Cancel
            </button>

            <form id="statusForm" method="POST">
                @csrf
                @method('PUT')

                <button
                    type="submit"
                    class="px-4 py-2 rounded-xl bg-red-500 text-white">
                    Yes, Continue
                </button>
            </form>

        </div>

    </div>
</div>
@endsection