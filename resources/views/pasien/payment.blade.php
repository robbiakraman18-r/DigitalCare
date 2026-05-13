@extends('layouts.pasien')

@section('title', 'Payment')

@section('subtitle', 'Waiting payment at clinic reception')

@section('content')

<div class="flex items-center justify-center min-h-[60vh]">

    <div class="bg-white rounded-3xl shadow-xl border p-10 text-center max-w-md w-full">

        <!-- ICON -->
        <div class="w-24 h-24 mx-auto bg-orange-100 rounded-full flex items-center justify-center">
            <i data-lucide="wallet" class="w-10 h-10 text-orange-500"></i>
        </div>

        <!-- TITLE -->
        <h2 class="text-2xl font-bold mt-6 text-slate-800">
            Payment Information
        </h2>

        <!-- AMOUNT -->
        <div class="mt-6 bg-red-100 rounded-2xl p-5">
            <p class="text-sm text-slate-500">Total Payment</p>
            <p class="text-2xl font-bold text-slate-800">Rp. 250.000</p>
        </div>

        <!-- STATUS -->
        <div class="mt-4">
            <span class="px-4 py-2 rounded-full bg-green-500 text-white text-sm font-semibold">
                Cash Only
            </span>
        </div>

        <p class="text-sm text-slate-400 mt-5">
            Please pay directly at clinic reception desk
        </p>

    </div>

</div>

@endsection