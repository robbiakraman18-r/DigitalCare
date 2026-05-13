@extends('layouts.pasien')

@section('title', 'Medical Detail')

@section('subtitle', 'Detailed medical consultation information')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">

    <!-- LEFT -->
    <div class="lg:col-span-2 space-y-6">

        <!-- CONSULTATION -->
        <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Consultation Detail
                    </h2>

                    <p class="text-slate-400 text-sm mt-1">
                        Medical examination information
                    </p>

                </div>

                <span class="px-4 py-2 rounded-full bg-green-100 text-green-500 text-sm font-semibold">
                    Completed
                </span>

            </div>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <p class="text-slate-400 text-sm">Visit Date</p>
                    <h3 class="font-semibold text-slate-700 mt-1">
                        20 March 2026
                    </h3>
                </div>

                <div>
                    <p class="text-slate-400 text-sm">Doctor</p>
                    <h3 class="font-semibold text-slate-700 mt-1">
                        dr. Andi Pratama
                    </h3>
                </div>

                <div>
                    <p class="text-slate-400 text-sm">Main Complaint</p>
                    <h3 class="font-semibold text-slate-700 mt-1">
                        Batuk dan pilek
                    </h3>
                </div>

                <div>
                    <p class="text-slate-400 text-sm">Diagnosis</p>
                    <h3 class="font-semibold text-slate-700 mt-1">
                        ISPA
                    </h3>
                </div>

            </div>

        </div>

        <!-- NOTES -->
        <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">

            <h2 class="text-xl font-bold text-slate-800 mb-4">
                Doctor Notes
            </h2>

            <p class="text-slate-600 leading-relaxed">
                Pasien mengalami gejala ISPA ringan. Disarankan istirahat cukup,
                minum air putih yang banyak, dan menghindari aktivitas berat.
            </p>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="space-y-6">

        <!-- PRESCRIPTION -->
        <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100">

            <h2 class="text-xl font-bold text-slate-800 mb-5">
                Prescription
            </h2>

            <div class="space-y-4">

                <div class="p-4 rounded-2xl bg-slate-50">

                    <h3 class="font-semibold text-slate-700">
                        Paracetamol
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        3x sehari setelah makan
                    </p>

                </div>

                <div class="p-4 rounded-2xl bg-slate-50">

                    <h3 class="font-semibold text-slate-700">
                        Vitamin C
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        1x sehari
                    </p>

                </div>
<a href="/download-rekam-medis"
   class="px-5 py-3 rounded-2xl bg-teal-500 text-white font-semibold hover:bg-teal-600 transition inline-flex items-center gap-2">

    <i data-lucide="download"></i>
    Download PDF
</a>
            </div>

        </div>

    </div>

</div>

@endsection