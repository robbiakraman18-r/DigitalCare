@extends('admin.reports.pdf._layout')

@section('report_title', 'Medical Records Report')

@section('report_body')

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Diagnosis</th>
            <th>Chief Complaint</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rekamMedisList as $rekam)
        @php $pasien = $rekam->appointment->pasien ?? null; @endphp
        <tr>
            <td>{{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->format('d M Y H:i') }}</td>
            <td>{{ $pasien->user->nama ?? '-' }}</td>
            <td>{{ $rekam->dokter->user->nama ?? '-' }}</td>
            <td>{{ $rekam->diagnosa }}</td>
            <td>{{ $rekam->keluhan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection