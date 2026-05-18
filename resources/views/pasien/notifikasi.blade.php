@extends('layouts.pasien')

@section('title', 'Notifications')

@section('subtitle', 'All system updates and announcements')

@section('content')

<div class="space-y-4">

    <!-- ANNOUNCEMENT -->
    <div class="bg-blue-50 p-5 rounded-2xl border">
        <h3 class="font-bold">Clinic Announcement</h3>
        <p class="text-sm text-slate-600">
            Clinic will be closed on Sunday for maintenance.
        </p>
    </div>

    <!-- NOTIF 1 -->
    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="font-semibold">Appointment Confirmed</p>
        <p class="text-sm text-slate-500">Your booking has been approved</p>
    </div>

    <!-- NOTIF 2 -->
    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="font-semibold">Payment Reminder</p>
        <p class="text-sm text-slate-500">Please complete your payment</p>
    </div>

</div>

@endsection