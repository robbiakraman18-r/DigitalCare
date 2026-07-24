@extends('admin.reports.pdf._layout')

@section('report_title', 'Laporan Janji Temu')

@section('report_body')

@php
    $statusLabel = [
        'pending' => 'Menunggu',
        'called' => 'Dipanggil',
        'in_consultation' => 'Konsultasi',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
    ];
@endphp

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Antrian</th>
            <th>Pasien</th>
            <th>Dokter</th>
            <th>Status</th>
            <th>Keluhan Utama</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
        <tr>
            <td>{{ \Carbon\Carbon::parse($appointment->tanggal_janji)->translatedFormat('d M Y') }}</td>
            <td>{{ $appointment->nomor_antrian }}</td>
            <td>{{ $appointment->pasien->user->nama ?? '-' }}</td>
            <td>{{ $appointment->dokter->user->nama ?? '-' }}</td>
            <td>{{ $statusLabel[$appointment->status_janji] ?? ucfirst($appointment->status_janji) }}</td>
            <td>{{ $appointment->keluhan_utama }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection