@extends('admin.reports.pdf._layout')

@section('report_title', 'Appointment Report')

@section('report_body')

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Queue</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Status</th>
            <th>Chief Complaint</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
        <tr>
            <td>{{ \Carbon\Carbon::parse($appointment->tanggal_janji)->format('d M Y') }}</td>
            <td>{{ $appointment->nomor_antrian }}</td>
            <td>{{ $appointment->pasien->user->nama ?? '-' }}</td>
            <td>{{ $appointment->dokter->user->nama ?? '-' }}</td>
            <td>{{ ucfirst($appointment->status_janji) }}</td>
            <td>{{ $appointment->keluhan_utama }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection