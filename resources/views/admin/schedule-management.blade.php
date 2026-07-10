@extends('layouts.admin')

@section('content')
@if(session('success'))

<div
id="toast-success"
class="fixed top-8 right-8 z-[9999]">

    <div class="bg-white shadow-xl border border-green-100 rounded-[24px] p-5 flex items-center gap-4 min-w-[340px]">

        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">

            <i
            data-lucide="check-circle-2"
            class="w-6 h-6 text-green-600"></i>

        </div>

        <div>

            <h2 class="font-bold text-slate-800">

                Success

            </h2>

            <p class="text-sm text-slate-500">

                {{ session('success') }}

            </p>

        </div>

    </div>

</div>

@endif
@if(session('error'))

<div
id="toast-error"
class="fixed top-8 right-8 z-[9999]">

    <div class="bg-white shadow-xl border border-red-100 rounded-[24px] p-5 flex items-center gap-4 min-w-[340px]">

        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">

            <i
            data-lucide="circle-x"
            class="w-6 h-6 text-red-500"></i>

        </div>

        <div>

            <h2 class="font-bold text-slate-800">

                Failed

            </h2>

            <p class="text-sm text-slate-500">

                {{ session('error') }}

            </p>

        </div>

    </div>

</div>

@endif
<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Schedule Management
            </h1>

            <p class="text-slate-500 mt-1">
                Schedule Management - {{ \Carbon\Carbon::now()->format('F Y') }}
            </p>

        </div>
        

        <a href="{{ route('admin.schedule.create') }}"
            class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                + Add Schedule
            </a>

    </div>



    {{-- STATS --}}

    <!-- STATS -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

    {{-- TOTAL SCHEDULE --}}
    <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-slate-400 text-sm">
                    Total Schedule
                </p>

                <h2 class="text-3xl font-bold text-slate-800 mt-2">
                    {{ $jadwal->count() }}
                </h2>

                <p class="text-blue-500 text-sm mt-2">
                    All schedules
                </p>

            </div>

            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                <i data-lucide="calendar" class="w-6 h-6 text-blue-600"></i>

            </div>

        </div>

    </div>

    {{-- AVAILABLE --}}
    <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-slate-400 text-sm">
                    Available
                </p>

                <h2 class="text-3xl font-bold text-slate-800 mt-2">
                    {{ $jadwal->where('status_jadwal','Available')->count() }}
                </h2>

                <p class="text-green-500 text-sm mt-2">
                    Ready for booking
                </p>

            </div>

            <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>

            </div>

        </div>

    </div>

    {{-- FULL --}}
    <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-slate-400 text-sm">
                    Full
                </p>

                <h2 class="text-3xl font-bold text-slate-800 mt-2">
                    {{ $jadwal->where('status_jadwal','Full')->count() }}
                </h2>

                <p class="text-red-500 text-sm mt-2">
                    Fully booked
                </p>

            </div>

            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                <i data-lucide="x-circle" class="w-6 h-6 text-red-600"></i>

            </div>

        </div>

    </div>

    {{-- CLOSED --}}
    <div class="bg-white rounded-[28px] border border-slate-100 p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-slate-400 text-sm">
                    Closed
                </p>

                <h2 class="text-3xl font-bold text-slate-800 mt-2">
                    {{ $jadwal->where('status_jadwal','Closed')->count() }}
                </h2>

                <p class="text-slate-500 text-sm mt-2">
                    Not active
                </p>

            </div>

            <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">

                <i data-lucide="lock" class="w-6 h-6 text-slate-600"></i>

            </div>

        </div>

    </div>

</div>




    <!-- TABLE -->
<div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

    <!-- FILTER -->
<div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-5 border-b border-slate-100">

        <form
            method="GET"
            action="{{ url()->current() }}"
            class="flex flex-col lg:flex-row gap-4 w-full items-end">

            <!-- SEARCH -->
            <div class="relative w-full lg:w-80">

                <i data-lucide="search"
                   class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search doctor, room..."
                    class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-cyan-500">

            </div>

            <!-- STATUS -->
            <div class="relative w-full lg:w-56">

                <i data-lucide="filter"
                   class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                <select
                    name="status"
                    class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500 appearance-none">

                    <option value="">All Status</option>
                    <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Full" {{ request('status') == 'Full' ? 'selected' : '' }}>Full</option>
                    <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>

                </select>

                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>
                </div>

            </div>

            <!-- CALENDAR -->
            <div class="relative w-full lg:w-56">

                <i data-lucide="calendar"
                   class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ request('tanggal') }}"
                    onchange="this.form.submit()"
                    class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500">

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                Filter

            </button>

        </form>

    </div>

</div>



        <!-- TABLE -->
<div class="overflow-x-auto">

    <table class="w-full">

        <thead class="bg-slate-50">

            <tr>

                <th class="px-6 py-4 text-left text-sm text-slate-400">
                    Doctor
                </th>

                <th class="px-6 py-4 text-left text-sm text-slate-400">
                    Date
                </th>

                <th class="px-6 py-4 text-left text-sm text-slate-400">
                    Time
                </th>

                <th class="px-6 py-4 text-left text-sm text-slate-400">
                    Room
                </th>

                <th class="px-6 py-4 text-left text-sm text-slate-400">
                    Quota
                </th>

                <th class="px-6 py-4 text-left text-sm text-slate-400">
                    Status
                </th>

                <th class="px-6 py-4 text-center text-sm text-slate-400">
                    Actions
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($jadwal as $item)

            <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                {{-- DOCTOR --}}
                <td class="px-6 py-5">

                    <div class="flex items-center gap-4">

                        {{-- FOTO DOKTER (FIXED) --}}
                        @if(optional($item->dokter)->foto_profil)

                            <img
                                src="{{ asset('storage/' . $item->dokter->foto_profil) }}"
                                class="w-11 h-11 rounded-2xl object-cover">

                        @else

                            @php
                                $nama = $item->dokter->user->nama ?? 'DR';

                                $inisial = collect(explode(' ', $nama))
                                    ->filter()
                                    ->take(2)
                                    ->map(fn($i) => strtoupper(substr($i,0,1)))
                                    ->join('');
                            @endphp

                            <div class="w-11 h-11 rounded-2xl bg-cyan-500 flex items-center justify-center text-white font-bold text-sm">
                                {{ $inisial }}
                            </div>

                        @endif

                        {{-- INFO --}}
                        <div>

                            <h3 class="font-semibold text-slate-800">
                                {{ $item->dokter->user->nama }}
                            </h3>

                            <p class="text-sm text-slate-400">
                                {{ $item->dokter->spesialis ?? 'Doctor' }}
                            </p>

                        </div>

                    </div>

                </td>

                {{-- DATE --}}
                <td class="px-6 py-5 text-slate-600">
                    {{ $item->tanggal }}
                </td>

                {{-- TIME --}}
                <td class="px-6 py-5 text-slate-600">
                    {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                </td>

                {{-- ROOM --}}
                <td class="px-6 py-5 text-slate-600">
                    {{ $item->ruang }}
                </td>

                {{-- QUOTA --}}
                <td class="px-6 py-5">

                    <span class="font-semibold text-slate-800">
                        {{ $item->terisi ?? 0 }}
                    </span>

                    <span class="text-slate-400">
                        /{{ $item->kuota_harian }}
                    </span>

                </td>

                {{-- STATUS --}}
                <td class="px-6 py-5">

                    @if($item->status_jadwal == 'Available')
                        <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                            Available
                        </span>

                    @elseif($item->status_jadwal == 'Full')
                        <span class="px-3 py-1 rounded-xl bg-red-100 text-red-600 text-xs font-semibold">
                            Full
                        </span>

                    @else
                        <span class="px-3 py-1 rounded-xl bg-slate-100 text-slate-600 text-xs font-semibold">
                            Closed
                        </span>
                    @endif

                </td>

                {{-- ACTIONS --}}
                <td class="px-6 py-5">

                    @php
                        $sudahMulai = \Carbon\Carbon::parse(
                            $item->tanggal . ' ' . $item->jam_mulai,
                            'Asia/Jakarta'
                        )->lessThanOrEqualTo(now('Asia/Jakarta'));
                    @endphp

                    <div class="flex items-center justify-center gap-3">

                        @if($sudahMulai)
                            <span
                            class="w-9 h-9 rounded-xl border border-slate-100 flex items-center justify-center text-slate-300"
                            title="Jadwal sudah dimulai, tidak bisa diubah">
                                <i data-lucide="lock" class="w-4 h-4"></i>
                            </span>
                        @else
                            <!-- EDIT -->
                            <button
                                type="button"
                                onclick="openEditModal(this)"
                                data-id="{{ $item->id_jadwal }}"
                                data-dokter="{{ $item->id_dokter }}"
                                data-tanggal="{{ $item->tanggal }}"
                                data-hari="{{ $item->hari }}"
                                data-mulai="{{ $item->jam_mulai }}"
                                data-selesai="{{ $item->jam_selesai }}"
                                data-ruang="{{ $item->ruang }}"
                                data-kuota="{{ $item->kuota_harian }}"
                                class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-100 transition">
                                <i data-lucide="square-pen" class="w-4 h-4"></i>
                            </button>

                            <!-- DELETE -->
                            <button
                                type="button"
                                onclick="openDeleteModal(this)"
                                data-id="{{ $item->id_jadwal }}"
                                class="w-9 h-9 rounded-xl border border-red-200 flex items-center justify-center hover:bg-red-50 transition">
                                <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>
                            </button>
                        @endif

                    </div>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

{{-- =========================
EDIT MODAL
========================= --}}

<div
id="editModal"
class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[999] p-5">

<div class="bg-white rounded-[32px] w-full max-w-3xl shadow-2xl overflow-hidden">

<div class="px-8 py-6 border-b flex justify-between">

<div>

<h2 class="text-2xl font-bold">

Edit Schedule

</h2>

<p class="text-slate-400">

Update doctor schedule

</p>

</div>

<button
type="button"
onclick="closeEditModal()">

✕

</button>

</div>


<form
id="editForm"
method="POST">

@csrf
@method('PUT')

<div class="grid lg:grid-cols-2 gap-5 p-8">

<div>

<label>Doctor</label>

<select
name="id_dokter"
id="edit_dokter"
class="w-full border rounded-2xl px-4 py-3">

@foreach($dokters as $dokter)

<option value="{{ $dokter->id_dokter }}">

{{ $dokter->user->nama }}

</option>

@endforeach

</select>

</div>


<div>

<label>Date</label>

<input
type="date"
id="edit_tanggal"
name="tanggal"
class="w-full border rounded-2xl px-4 py-3">

</div>


<div>

<label>Day</label>

<input
type="text"
id="edit_hari"
name="hari"
class="w-full border rounded-2xl px-4 py-3">

</div>


<div>

<label>Start</label>

<input
type="time"
id="edit_mulai"
name="jam_mulai"
class="w-full border rounded-2xl px-4 py-3">

</div>


<div>

<label>End</label>

<input
type="time"
id="edit_selesai"
name="jam_selesai"
class="w-full border rounded-2xl px-4 py-3">

</div>


<div>

<label>Room</label>

<input
type="text"
id="edit_ruang"
name="ruang"
class="w-full border rounded-2xl px-4 py-3">

</div>


<div>

<label>Quota</label>

<input
type="number"
id="edit_kuota"
name="kuota_harian"
class="w-full border rounded-2xl px-4 py-3">

</div>

</div>

<div class="border-t p-6 flex justify-end gap-3">

<button
type="button"
onclick="closeEditModal()"
class="px-5 py-3 rounded-2xl border">

Cancel

</button>

<button
class="px-5 py-3 rounded-2xl bg-cyan-600 text-white">

Update Schedule

</button>

</div>

</form>

</div>

</div>
<div
id="deleteModal"
class="fixed inset-0 hidden items-center justify-center bg-black/40 backdrop-blur-sm z-[999]">

<div class="bg-white rounded-[32px] w-[420px] shadow-xl p-8">

<div class="text-center">

<div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto">

<i
data-lucide="trash-2"
class="w-10 h-10 text-red-500"></i>

</div>

<h2 class="text-2xl font-bold mt-5">

Delete Schedule?

</h2>

<p class="text-slate-400 mt-2">

This action cannot be undone.

</p>

</div>

<form
id="deleteForm"
method="POST"
class="mt-8">

@csrf
@method('DELETE')

<div class="flex gap-3">

<button
type="button"
onclick="closeDeleteModal()"
class="flex-1 py-3 rounded-2xl border">

Cancel

</button>

<button
class="flex-1 py-3 rounded-2xl bg-red-500 text-white">

Delete

</button>

</div>

</form>

</div>

</div>
<script>


function closeDeleteModal(){

document
.getElementById('deleteModal')
.classList
.remove('flex');

document
.getElementById('deleteModal')
.classList
.add('hidden');

}

function openDeleteModal(button){

    const id = button.dataset.id;

    document.getElementById('deleteForm').action =
        "/admin/schedule-management/delete/" + id;

    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');

}

setTimeout(()=>{

const success=document.getElementById('toast-success');

if(success){

success.style.opacity="0";

success.style.transform="translateX(50px)";

setTimeout(()=>{

success.remove();

},500);

}

const error=document.getElementById('toast-error');

if(error){

error.style.opacity="0";

error.style.transform="translateX(50px)";

setTimeout(()=>{

error.remove();

},500);

}

},3000);


function openEditModal(button){

    const id = button.dataset.id;

    document.getElementById('edit_dokter').value = button.dataset.dokter;
    document.getElementById('edit_tanggal').value = button.dataset.tanggal;
    document.getElementById('edit_hari').value = button.dataset.hari;
    document.getElementById('edit_mulai').value = button.dataset.mulai;
    document.getElementById('edit_selesai').value = button.dataset.selesai;
    document.getElementById('edit_ruang').value = button.dataset.ruang;
    document.getElementById('edit_kuota').value = button.dataset.kuota;

    document.getElementById('editForm').action =
        "/admin/schedule-management/update/" + id;

    const modal = document.getElementById('editModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal(){

    const modal = document.getElementById('editModal');

    modal.classList.remove('flex');
    modal.classList.add('hidden');

}

</script>
@endsection