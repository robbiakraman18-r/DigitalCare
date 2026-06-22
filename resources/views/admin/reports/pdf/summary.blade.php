@extends('admin.reports.pdf._layout')

@section('report_title', 'Clinic Summary Report')

@section('report_body')

<div class="stat-row">
    <div class="stat-box">
        <div class="label">Total Appointments</div>
        <div class="value">{{ $totalAppointments }}</div>
    </div>
    <div class="stat-box">
        <div class="label">Completed</div>
        <div class="value">{{ $completedAppointments }}</div>
    </div>
    <div class="stat-box">
        <div class="label">Total Patients</div>
        <div class="value">{{ $totalPatients }}</div>
    </div>
    <div class="stat-box">
        <div class="label">Total Doctors</div>
        <div class="value">{{ $totalDoctors }}</div>
    </div>
</div>

<p style="font-size: 11px; color: #64748b; margin-bottom: 16px;">
    Total medical records on file: <strong>{{ $totalMedicalRecords }}</strong>
</p>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recentAppointments as $appointment)
        <tr>
            <td>{{ \Carbon\Carbon::parse($appointment->tanggal_janji)->format('d M Y') }}</td>
            <td>{{ $appointment->pasien->user->nama ?? '-' }}</td>
            <td>{{ $appointment->dokter->user->nama ?? '-' }}</td>
            <td>{{ ucfirst($appointment->status_janji) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection