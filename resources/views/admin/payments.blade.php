{{-- resources/views/admin/payments.blade.php --}}

@extends('layouts.admin')

@section('title', 'Payments')
@section('subtitle', 'Manage patient cash payments and queue confirmation.')

@section('content')

<div
x-data="{
    paymentModal:false,
    queueModal:false
}"
class="space-y-6">

    <!-- TOP CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Total Payments
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        248
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i data-lucide="wallet" class="w-6 h-6 text-green-600"></i>

                </div>

            </div>

            <p class="text-green-500 text-sm mt-4">
                +18 today
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Pending
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        12
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                    <i data-lucide="clock-3" class="w-6 h-6 text-yellow-600"></i>

                </div>

            </div>

            <p class="text-yellow-500 text-sm mt-4">
                Waiting confirmation
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Confirmed
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        221
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                    <i data-lucide="badge-check" class="w-6 h-6 text-cyan-600"></i>

                </div>

            </div>

            <p class="text-cyan-500 text-sm mt-4">
                Queue generated
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Revenue
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        $12,450
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i data-lucide="banknote" class="w-6 h-6 text-blue-600"></i>

                </div>

            </div>

            <p class="text-blue-500 text-sm mt-4">
                This month
            </p>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-6 border-b border-slate-100">

            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    Patient Payment List
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    Cash payments must be confirmed before queue number is generated.
                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex flex-col sm:flex-row gap-3">

                <!-- SEARCH -->
                <div class="relative">

                    <i data-lucide="search"
                    class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                    <input
                    type="text"
                    placeholder="Search patient..."
                    class="w-full sm:w-72 pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500">

                </div>

                <!-- BUTTON -->
                <button
                class="px-5 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold transition">

                    Export Payments

                </button>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1100px]">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Patient
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Doctor
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Payment
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Method
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Queue
                        </th>

                        <th class="px-6 py-4 text-left text-sm text-slate-400 font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-sm text-slate-400 font-semibold">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach([
                        ['John Smith','Dr. Emily','$120','Cash','A-012','Pending'],
                        ['Sarah Johnson','Dr. Carter','$80','Cash','B-021','Confirmed'],
                        ['Michael Brown','Dr. Wilson','$150','Cash','A-014','Pending'],
                        ['Emma Davis','Dr. Lee','$95','Cash','C-004','Confirmed'],
                        ['Daniel White','Dr. Robert','$70','Cash','D-009','Pending']
                    ] as $payment)

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <!-- PATIENT -->
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img
                                src="https://i.pravatar.cc/100?img={{ rand(10,60) }}"
                                class="w-12 h-12 rounded-2xl object-cover">

                                <div>

                                    <h3 class="font-semibold text-slate-800">
                                        {{ $payment[0] }}
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        Patient ID #00{{ $loop->iteration }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- DOCTOR -->
                        <td class="px-6 py-5 text-slate-600">
                            {{ $payment[1] }}
                        </td>

                        <!-- PAYMENT -->
                        <td class="px-6 py-5 font-semibold text-slate-800">
                            {{ $payment[2] }}
                        </td>

                        <!-- METHOD -->
                        <td class="px-6 py-5">

                            <span class="px-4 py-2 rounded-xl bg-green-100 text-green-600 text-xs font-semibold">
                                {{ $payment[3] }}
                            </span>

                        </td>

                        <!-- QUEUE -->
                        <td class="px-6 py-5">

                            <span class="font-bold text-teal-600">
                                {{ $payment[4] }}
                            </span>

                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-5">

                            @if($payment[5] == 'Confirmed')

                            <span class="px-4 py-2 rounded-xl bg-cyan-100 text-cyan-600 text-xs font-semibold">
                                Confirmed
                            </span>

                            @else

                            <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-600 text-xs font-semibold">
                                Pending
                            </span>

                            @endif

                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <!-- DETAIL -->
                                <button
                                @click="paymentModal=true"
                                class="w-10 h-10 rounded-xl bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">

                                    <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>

                                </button>

                                <!-- CONFIRM -->
                                <button
                                @click="queueModal=true"
                                class="px-4 py-2 rounded-xl bg-teal-500 hover:bg-teal-600 text-white text-sm font-semibold transition">

                                    Confirm

                                </button>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <!-- DETAIL MODAL -->
    <div
    x-show="paymentModal"
    x-transition
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 p-5"
    style="display:none;">

        <div
        @click.away="paymentModal=false"
        class="bg-white w-full max-w-2xl rounded-[32px] shadow-2xl overflow-hidden">

            <!-- TOP -->
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">

                <div>

                    <h2 class="text-xl font-bold text-slate-800">
                        Payment Detail
                    </h2>

                    <p class="text-sm text-slate-400 mt-1">
                        Patient cash payment information
                    </p>

                </div>

                <button
                @click="paymentModal=false"
                class="w-11 h-11 rounded-2xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center">

                    <i data-lucide="x" class="w-5 h-5 text-slate-600"></i>

                </button>

            </div>

            <!-- BODY -->
            <div class="p-6 space-y-5">

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
                            Dr. Emily
                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Payment Method
                        </p>

                        <h3 class="font-bold text-green-600 mt-2">
                            Cash
                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <p class="text-sm text-slate-400">
                            Total Payment
                        </p>

                        <h3 class="font-bold text-slate-800 mt-2">
                            $120
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CONFIRM MODAL -->
    <div
    x-show="queueModal"
    x-transition
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 p-5"
    style="display:none;">

        <div
        @click.away="queueModal=false"
        class="bg-white w-full max-w-md rounded-[32px] shadow-2xl p-8 text-center">

            <div class="w-20 h-20 rounded-full bg-teal-100 mx-auto flex items-center justify-center">

                <i data-lucide="badge-check" class="w-10 h-10 text-teal-600"></i>

            </div>

            <h2 class="text-2xl font-bold text-slate-800 mt-5">
                Payment Confirmed
            </h2>

            <p class="text-slate-400 mt-2">
                Patient payment has been accepted successfully.
            </p>

            <!-- QUEUE -->
            <div class="mt-6 bg-slate-50 rounded-3xl p-6">

                <p class="text-sm text-slate-400">
                    Queue Number
                </p>

                <h1 class="text-5xl font-black text-teal-600 mt-3">
                    A-012
                </h1>

            </div>

            <button
            @click="queueModal=false"
            class="mt-6 w-full py-4 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold transition">

                Done

            </button>

        </div>

    </div>

</div>

@endsection