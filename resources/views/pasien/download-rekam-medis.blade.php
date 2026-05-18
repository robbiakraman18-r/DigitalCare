@extends('layouts.pasien')

@section('title', 'Medical Report')

@section('subtitle', 'Download or print your medical record')

@section('content')

<div class="bg-white p-8 rounded-3xl shadow-lg border">

    <h1 class="text-2xl font-bold mb-6">Medical Record Report</h1>

    <div class="space-y-3 text-slate-700">

        <p><b>Patient:</b> Rizki A</p>
        <p><b>Doctor:</b> dr. Andi Pratama</p>
        <p><b>Date:</b> 20 March 2026</p>
        <p><b>Diagnosis:</b> ISPA</p>
        <p><b>Complaint:</b> Batuk dan pilek</p>

    </div>

    <div class="mt-8 flex gap-3">

        <button onclick="window.print()"
            class="px-5 py-3 bg-teal-500 text-white rounded-2xl hover:bg-teal-600">
            Print / Save PDF
        </button>

        <a href="/detail-rekam-medis"
            class="px-5 py-3 bg-slate-200 rounded-2xl">
            Back
        </a>

    </div>

</div>

@endsection