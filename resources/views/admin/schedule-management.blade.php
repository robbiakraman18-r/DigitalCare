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
    <div class="flex flex-col lg:flex-row justify-between gap-5">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Schedule Management
            </h1>

            <p class="text-slate-400 mt-1">
                Manage doctor schedule and clinic availability.
            </p>

        </div>

        <button
        onclick="openAddModal()"
        class="px-5 py-3 rounded-2xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold">

            + Add Schedule

        </button>

    </div>



    {{-- STATS --}}

    <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-5">

        <div class="bg-white rounded-[28px] p-6 shadow-sm border">

            <p class="text-slate-400">
                Total Schedule
            </p>

            <h2 class="text-3xl font-bold mt-3">
                {{ $jadwal->count() }}
            </h2>

        </div>

        <div class="bg-white rounded-[28px] p-6 shadow-sm border">

            <p class="text-slate-400">
                Available
            </p>

            <h2 class="text-3xl font-bold mt-3 text-green-600">

                {{ $jadwal->where('status_jadwal','Available')->count() }}

            </h2>

        </div>

        <div class="bg-white rounded-[28px] p-6 shadow-sm border">

            <p class="text-slate-400">
                Full
            </p>

            <h2 class="text-3xl font-bold mt-3 text-red-600">

                {{ $jadwal->where('status_jadwal','Full')->count() }}

            </h2>

        </div>

        <div class="bg-white rounded-[28px] p-6 shadow-sm border">

            <p class="text-slate-400">
                Closed
            </p>

            <h2 class="text-3xl font-bold mt-3 text-slate-700">

                {{ $jadwal->where('status_jadwal','Closed')->count() }}

            </h2>

        </div>

    </div>



    {{-- FILTER --}}

    <div class="bg-white rounded-[30px] shadow-sm border overflow-hidden">

        <div class="p-6 border-b">

            <form
            method="GET"
            class="flex flex-col lg:flex-row gap-4">

                <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search doctor..."
                class="border rounded-2xl px-5 py-3 flex-1">

                <select
                name="status"
                class="border rounded-2xl px-5 py-3">

                    <option value="">
                        All Status
                    </option>

                    <option
                    value="Available"
                    {{ request('status')=="Available" ? 'selected':'' }}>
                        Available
                    </option>

                    <option
                    value="Full"
                    {{ request('status')=="Full" ? 'selected':'' }}>
                        Full
                    </option>

                    <option
                    value="Closed"
                    {{ request('status')=="Closed" ? 'selected':'' }}>
                        Closed
                    </option>

                </select>

                <button
                class="bg-cyan-600 text-white rounded-2xl px-6">

                    Filter

                </button>

            </form>

        </div>



        {{-- TABLE --}}

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                <tr>

                    <th class="py-4 px-6 text-left">
                        Doctor
                    </th>

                    <th>
                        Date
                    </th>

                    <th>
                        Time
                    </th>

                    <th>
                        Room
                    </th>

                    <th>
                        Quota
                    </th>

                    <th>
                        Filled
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Action
                    </th>

                </tr>

                </thead>

                <tbody>

                @foreach($jadwal as $item)

                <tr class="border-b hover:bg-slate-50">

                    <td class="py-5 px-6">

                        <div>

                            <h2 class="font-semibold">

                                {{ $item->dokter->user->nama }}

                            </h2>

                            <p class="text-slate-400 text-sm">

                                {{ $item->dokter->spesialis }}

                            </p>

                        </div>

                    </td>

                    <td>

                        {{ $item->tanggal }}

                    </td>

                    <td>

                        {{ $item->jam_mulai }}

                        -

                        {{ $item->jam_selesai }}

                    </td>

                    <td>

                        {{ $item->ruang }}

                    </td>

                    <td>

                        {{ $item->kuota_harian }}

                    </td>

                    <td>

                        {{ $item->terisi }}

                    </td>

                    <td>

                        @if($item->status_jadwal=="Available")

                        <span class="px-3 py-1 rounded-xl bg-green-100 text-green-600">
                            Available
                        </span>

                        @elseif($item->status_jadwal=="Full")

                        <span class="px-3 py-1 rounded-xl bg-red-100 text-red-600">
                            Full
                        </span>

                        @else

                        <span class="px-3 py-1 rounded-xl bg-slate-100 text-slate-700">
                            Closed
                        </span>

                        @endif

                    </td>

                    <td>

                        <div class="flex justify-center gap-2">

    <button
    type="button"
    class="w-8 h-8 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-50"
    onclick="openEditModal(this)"

    data-id="{{ $item->id_jadwal }}"
    data-dokter="{{ $item->id_dokter }}"
    data-tanggal="{{ $item->tanggal }}"
    data-hari="{{ $item->hari }}"
    data-mulai="{{ $item->jam_mulai }}"
    data-selesai="{{ $item->jam_selesai }}"
    data-ruang="{{ $item->ruang }}"
    data-kuota="{{ $item->kuota_harian }}"
>
    <i data-lucide="square-pen" class="w-4 h-4"></i>
</button>


    <button
    type="button"
    onclick="openDeleteModal(this)"
    data-id="{{ $item->id_jadwal }}"
    class="w-8 h-8 rounded-xl border border-red-200 flex items-center justify-center hover:bg-red-50">

    <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>

</button>

</div>

                    </td>

                </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
{{-- ===========================
ADD SCHEDULE MODAL
=========================== --}}

<div
id="addModal"
class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[999] p-5">

    <div class="bg-white rounded-[32px] w-full max-w-3xl shadow-2xl overflow-hidden">

        {{-- HEADER --}}
        <div class="px-8 py-6 border-b flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Add Doctor Schedule
                </h2>

                <p class="text-slate-400 mt-1">
                    Create new doctor schedule
                </p>

            </div>

            <button
            onclick="closeAddModal()"
            class="text-2xl">

                ✕

            </button>

        </div>

        {{-- FORM --}}
        <form
        action="{{ route('admin.schedule.store') }}"
        method="POST">

            @csrf

            <div class="grid lg:grid-cols-2 gap-5 p-8">

                {{-- DOCTOR --}}
                <div>

                    <label class="font-semibold text-slate-700">
                        Doctor
                    </label>

                    <select
                    name="id_dokter"
                    required
                    class="w-full mt-2 rounded-2xl border px-4 py-3">

                        <option value="">
                            Select Doctor
                        </option>

                        @foreach($dokters as $dokter)

                        <option value="{{ $dokter->id_dokter }}">

                            {{ $dokter->user->nama }}

                        </option>

                        @endforeach

                    </select>

                </div>


                {{-- TANGGAL --}}

                <div>

                    <label class="font-semibold">

                        Date

                    </label>

                    <input
                    type="date"
                    name="tanggal"
                    required
                    class="w-full mt-2 rounded-2xl border px-4 py-3">

                </div>


                {{-- HARI --}}

                <div>

                    <label class="font-semibold">

                        Day

                    </label>

                    <select
                    name="hari"
                    required
                    class="w-full mt-2 rounded-2xl border px-4 py-3">

                        <option>Monday</option>
                        <option>Tuesday</option>
                        <option>Wednesday</option>
                        <option>Thursday</option>
                        <option>Friday</option>
                        <option>Saturday</option>
                        <option>Sunday</option>

                    </select>

                </div>


                {{-- JAM MULAI --}}

                <div>

                    <label class="font-semibold">

                        Start Time

                    </label>

                    <input
                    type="time"
                    name="jam_mulai"
                    required
                    class="w-full mt-2 rounded-2xl border px-4 py-3">

                </div>


                {{-- JAM SELESAI --}}

                <div>

                    <label class="font-semibold">

                        End Time

                    </label>

                    <input
                    type="time"
                    name="jam_selesai"
                    required
                    class="w-full mt-2 rounded-2xl border px-4 py-3">

                </div>


                {{-- RUANG --}}

                <div>

                    <label class="font-semibold">

                        Room

                    </label>

                    <input
                    type="text"
                    name="ruang"
                    required
                    class="w-full mt-2 rounded-2xl border px-4 py-3">

                </div>


                {{-- KUOTA --}}

                <div>

                    <label class="font-semibold">

                        Daily Quota

                    </label>

                    <input
                    type="number"
                    name="kuota_harian"
                    required
                    class="w-full mt-2 rounded-2xl border px-4 py-3">

                </div>

            </div>


            {{-- FOOTER --}}

            <div class="px-8 py-5 border-t flex justify-end gap-3">

                <button
                type="button"
                onclick="closeAddModal()"
                class="px-5 py-3 rounded-2xl border">

                    Cancel

                </button>

                <button
                class="px-5 py-3 rounded-2xl bg-cyan-600 text-white">

                    Save Schedule

                </button>

            </div>

        </form>

    </div>

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
id="edit_quota"
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

function openAddModal(){

    document
    .getElementById('addModal')
    .classList
    .remove('hidden');

    document
    .getElementById('addModal')
    .classList
    .add('flex');

}

function closeAddModal(){

    document
    .getElementById('addModal')
    .classList
    .remove('flex');

    document
    .getElementById('addModal')
    .classList
    .add('hidden');

}

function openEditModal(el) {

    const data = el.dataset;

    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    form.action = `/admin/schedule-management/update/${data.id}`;

    document.getElementById('edit_dokter').value = data.dokter;
    document.getElementById('edit_tanggal').value = data.tanggal;
    document.getElementById('edit_hari').value = data.hari;
    document.getElementById('edit_mulai').value = data.mulai;
    document.getElementById('edit_selesai').value = data.selesai;
    document.getElementById('edit_ruang').value = data.ruang;
    document.getElementById('edit_quota').value = data.kuota;
}

function closeEditModal(){

document.getElementById('editModal').classList.remove('flex');

document.getElementById('editModal').classList.add('hidden');

}

function openDeleteModal(el) {

    const id = el.dataset.id;

    document.getElementById('deleteModal')
        .classList.remove('hidden');

    document.getElementById('deleteModal')
        .classList.add('flex');

    document.getElementById('deleteForm').action =
        `/admin/schedule-management/delete/${id}`;
}

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

</script>
@endsection