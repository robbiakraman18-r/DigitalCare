@extends('layouts.pasien')

@section('title', 'Clinic Information')

@section('subtitle', 'All information about the clinic')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">

    <!-- ABOUT -->
    <div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-lg">

        <h2 class="text-xl font-bold mb-4">About Clinic</h2>

        <p class="text-slate-600">
            DigitalCare Clinic is a modern healthcare system providing fast
            and efficient patient services.
        </p>

        <img src="https://source.unsplash.com/800x400/?hospital"
             class="rounded-2xl mt-5">

    </div>

    <!-- INFO -->
    <div class="space-y-4">

        <div class="bg-white p-5 rounded-3xl shadow">
            <h3 class="font-bold">Contact</h3>
            <p class="text-sm text-slate-500">0812-xxxx-xxxx</p>
        </div>

        <div class="bg-white p-5 rounded-3xl shadow">
            <h3 class="font-bold">Address</h3>
            <p class="text-sm text-slate-500">Batam, Indonesia</p>
        </div>

        <div class="bg-white p-5 rounded-3xl shadow">
            <h3 class="font-bold">Open Hours</h3>
            <p class="text-sm text-slate-500">08:00 - 21:00</p>
        </div>

    </div>

</div>

@endsection