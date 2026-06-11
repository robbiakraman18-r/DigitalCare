@extends('layouts.admin')

@section('title', 'Complaint Management')
@section('subtitle', 'Manage complaints and user feedback.')

@section('content')

<div x-data="{ detailModal:false }" class="space-y-6">

    <!-- TOP CARD -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- Total Complaint -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-400">Total Complaint</p>
                    <h2 class="text-3xl font-bold text-slate-800 mt-2">45</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">
                    <i data-lucide="message-square-warning" class="w-6 h-6 text-red-500"></i>
                </div>

            </div>

            <p class="text-xs text-red-500 mt-4 font-medium">+3 new today</p>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-400">Pending</p>
                    <h2 class="text-3xl font-bold text-slate-800 mt-2">12</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">
                    <i data-lucide="clock" class="w-6 h-6 text-yellow-600"></i>
                </div>

            </div>

            <p class="text-xs text-yellow-500 mt-4 font-medium">Waiting response</p>
        </div>

        <!-- Solved -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-400">Solved</p>
                    <h2 class="text-3xl font-bold text-slate-800 mt-2">28</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                </div>

            </div>

            <p class="text-xs text-green-500 mt-4 font-medium">Successfully handled</p>
        </div>

        <!-- Rejected -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-400">Rejected</p>
                    <h2 class="text-3xl font-bold text-slate-800 mt-2">5</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                    <i data-lucide="x-circle" class="w-6 h-6 text-slate-500"></i>
                </div>

            </div>

            <p class="text-xs text-slate-400 mt-4 font-medium">Closed complaint</p>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="flex items-center justify-between p-6 border-b border-slate-100">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Complaint List</h2>
                <p class="text-sm text-slate-400 mt-1">
                    Monitor and manage all complaints.
                </p>
            </div>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full">

                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">User</th>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Complaint</th>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Date</th>
                        <th class="px-6 py-4 text-left text-sm text-slate-400">Status</th>
                        <th class="px-6 py-4 text-center text-sm text-slate-400">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($complaints as $complaint)
                        <tr class="border-b border-slate-100 hover:bg-slate-50">

                            <td class="px-6 py-5 font-semibold text-slate-800">
                                {{ $complaint->user_name }}
                            </td>

                            <td class="px-6 py-5 text-slate-600">
                                {{ $complaint->message }}
                            </td>

                            <td class="px-6 py-5 text-slate-600">
                                {{ $complaint->created_at->format('d M Y') }}
                            </td>

                            <td class="px-6 py-5">
                                @if($complaint->status == 'pending')
                                    <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                        Pending
                                    </span>

                                @elseif($complaint->status == 'selesai')
                                    <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                        Selesai
                                    </span>

                                @else
                                    <span class="px-4 py-2 rounded-xl bg-blue-100 text-blue-600 text-xs font-semibold">
                                        Diproses
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5">
                                <form action="/admin/complaint/{{ $complaint->id }}" method="POST">
                                    @csrf

                                    <div class="flex items-center gap-2">
                                        <select name="status" class="border rounded-xl p-2 text-sm">
                                            <option value="pending">Pending</option>
                                            <option value="diproses">Diproses</option>
                                            <option value="selesai">Selesai</option>
                                        </select>

                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-500 text-white rounded-xl text-sm">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-slate-400">
                                Belum ada complaint
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection