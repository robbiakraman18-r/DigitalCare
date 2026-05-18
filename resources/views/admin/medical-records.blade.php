@extends('layouts.admin')

@section('title', 'Medical Records')
@section('subtitle', 'Manage and monitor all patient medical records.')

@section('content')

<div
x-data="{
    detailModal:false
}"
class="space-y-6">

    <!-- TOP -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Total Records
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        3,562
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i data-lucide="file-text" class="w-6 h-6 text-blue-600"></i>

                </div>

            </div>

            <p class="text-xs text-green-500 mt-4 font-medium">
                +12% from last month
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Active Patients
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        1,248
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-teal-100 flex items-center justify-center">

                    <i data-lucide="users" class="w-6 h-6 text-teal-600"></i>

                </div>

            </div>

            <p class="text-xs text-green-500 mt-4 font-medium">
                +8% from last month
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        New Records
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        86
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                    <i data-lucide="clipboard-plus" class="w-6 h-6 text-yellow-600"></i>

                </div>

            </div>

            <p class="text-xs text-green-500 mt-4 font-medium">
                +15 today
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Archived
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        214
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                    <i data-lucide="archive" class="w-6 h-6 text-red-500"></i>

                </div>

            </div>

            <p class="text-xs text-slate-400 mt-4 font-medium">
                Last updated today
            </p>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4 p-6 border-b border-slate-100">

            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    Medical Record List
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    View and manage patient medical history.
                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex flex-col lg:flex-row gap-3">

                <!-- SEARCH -->
                <div class="relative">

                    <i data-lucide="search"
                    class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                    <input
                    type="text"
                    placeholder="Search patient..."
                    class="w-full lg:w-72 pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <!-- FILTER -->
                <select
                class="px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 text-slate-700">

                    <option>All Doctors</option>
                    <option>Cardiology</option>
                    <option>Neurology</option>
                    <option>Orthopedic</option>

                </select>

                <!-- BUTTON -->
                <button
                class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                    Export Record

                </button>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1200px]">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-400">
                            Patient
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-400">
                            Doctor
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-400">
                            Diagnosis
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-400">
                            Treatment
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-400">
                            Date
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-400">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-sm font-semibold text-slate-400">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <!-- ROW -->
                    @foreach([
                        [
                            'name'=>'John Smith',
                            'img'=>'12',
                            'doctor'=>'Dr. Emily Carter',
                            'diagnosis'=>'Hypertension',
                            'treatment'=>'Medication & Monitoring',
                            'date'=>'14 May 2025',
                            'status'=>'Active'
                        ],
                        [
                            'name'=>'Sarah Johnson',
                            'img'=>'32',
                            'doctor'=>'Dr. James Wilson',
                            'diagnosis'=>'Migraine',
                            'treatment'=>'Pain Therapy',
                            'date'=>'13 May 2025',
                            'status'=>'Recovered'
                        ],
                        [
                            'name'=>'Michael Brown',
                            'img'=>'45',
                            'doctor'=>'Dr. David Lee',
                            'diagnosis'=>'Diabetes',
                            'treatment'=>'Insulin Therapy',
                            'date'=>'12 May 2025',
                            'status'=>'Monitoring'
                        ],
                        [
                            'name'=>'Emily Davis',
                            'img'=>'28',
                            'doctor'=>'Dr. Robert Kim',
                            'diagnosis'=>'Asthma',
                            'treatment'=>'Inhaler Treatment',
                            'date'=>'11 May 2025',
                            'status'=>'Active'
                        ],
                        [
                            'name'=>'Robert Lee',
                            'img'=>'55',
                            'doctor'=>'Dr. Carter',
                            'diagnosis'=>'Fracture',
                            'treatment'=>'Physical Therapy',
                            'date'=>'10 May 2025',
                            'status'=>'Recovered'
                        ]
                    ] as $record)

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <!-- PATIENT -->
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img
                                src="https://i.pravatar.cc/100?img={{ $record['img'] }}"
                                class="w-12 h-12 rounded-2xl object-cover">

                                <div>

                                    <h3 class="font-semibold text-slate-800">
                                        {{ $record['name'] }}
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        MR-2025-00{{ $loop->iteration }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- DOCTOR -->
                        <td class="px-6 py-5 text-slate-600">
                            {{ $record['doctor'] }}
                        </td>

                        <!-- DIAGNOSIS -->
                        <td class="px-6 py-5 text-slate-600">
                            {{ $record['diagnosis'] }}
                        </td>

                        <!-- TREATMENT -->
                        <td class="px-6 py-5 text-slate-600">
                            {{ $record['treatment'] }}
                        </td>

                        <!-- DATE -->
                        <td class="px-6 py-5 text-slate-600">
                            {{ $record['date'] }}
                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-5">

                            @if($record['status'] == 'Active')

                            <span class="px-4 py-2 rounded-xl bg-blue-100 text-blue-600 text-xs font-semibold">
                                Active
                            </span>

                            @elseif($record['status'] == 'Recovered')

                            <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                Recovered
                            </span>

                            @else

                            <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                Monitoring
                            </span>

                            @endif

                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                <button
                                @click="detailModal=true"
                                class="w-10 h-10 rounded-xl bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">

                                    <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>

                                </button>

                                <button
                                class="w-10 h-10 rounded-xl bg-green-100 hover:bg-green-200 flex items-center justify-center transition">

                                    <i data-lucide="download" class="w-4 h-4 text-green-600"></i>

                                </button>

                                <button
                                class="w-10 h-10 rounded-xl bg-red-100 hover:bg-red-200 flex items-center justify-center transition">

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

    <!-- MODAL -->
    <div
    x-show="detailModal"
    x-transition
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 p-5"
    style="display:none;">

        <div
        @click.away="detailModal=false"
        class="bg-white w-full max-w-3xl rounded-[32px] shadow-2xl overflow-hidden">

            <!-- TOP -->
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">

                <div>

                    <h2 class="text-xl font-bold text-slate-800">
                        Medical Record Detail
                    </h2>

                    <p class="text-sm text-slate-400 mt-1">
                        Patient diagnosis and treatment detail
                    </p>

                </div>

                <button
                @click="detailModal=false"
                class="w-11 h-11 rounded-2xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center">

                    <i data-lucide="x" class="w-5 h-5 text-slate-600"></i>

                </button>

            </div>

            <!-- BODY -->
            <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Patient Name
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            John Smith
                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Doctor
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            Dr. Emily Carter
                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Diagnosis
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            Hypertension
                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Treatment
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            Medication Therapy
                        </h3>

                    </div>

                </div>

                <div class="bg-slate-50 rounded-2xl p-5">

                    <h3 class="font-bold text-slate-800 mb-3">
                        Doctor Notes
                    </h3>

                    <p class="text-slate-600 leading-relaxed">
                        Patient shows stable blood pressure after medication adjustment.
                        Continue monitoring every 2 weeks and maintain healthy diet.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection