@extends('layouts.pasien')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-[32px] shadow-xl border border-slate-100 overflow-hidden">

        <!-- HEADER -->
        <div class="px-8 py-6 border-b border-slate-100">

            <h1 class="text-3xl font-bold text-slate-800">
                On-Going
            </h1>

            <p class="text-slate-400 mt-2">
                Current consultation status
            </p>

        </div>

        <!-- CONTENT -->
        <div class="p-12 flex flex-col items-center justify-center text-center">

            <div class="w-28 h-28 rounded-full bg-teal-50 flex items-center justify-center mb-8">

                <i data-lucide="stethoscope" class="w-14 h-14 text-teal-500"></i>

            </div>

            <h2 class="text-4xl font-bold text-slate-800">
                In Consultation
            </h2>

            <p class="text-slate-500 mt-5 leading-relaxed max-w-lg">
                Your doctor is currently examining patients.
                Please wait until your queue number is called.
            </p>

            <div class="mt-10 inline-flex items-center gap-3 px-5 py-3 rounded-full bg-yellow-100 text-yellow-700 font-medium">

                <div class="w-3 h-3 rounded-full bg-yellow-500 animate-pulse"></div>

                Waiting Process

            </div>

        </div>

    </div>

</div>

@endsection