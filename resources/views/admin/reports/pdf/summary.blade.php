@extends('admin.reports.pdf._layout')

@section('report_title', 'Laporan Ringkasan Klinik')

@section('report_body')

<div class="stat-row">
    <div class="stat-box">
        <div class="label">Total Janji Temu</div>
        <div class="value">{{ $totalAppointments }}</div>
    </div>
    <div class="stat-box">
        <div class="label">Selesai</div>
        <div class="value">{{ $completedAppointments }}</div>
    </div>
    <div class="stat-box">
        <div class="label">Total Pasien</div>
        <div class="value">{{ $totalPatients }}</div>
    </div>
    <div class="stat-box">
        <div class="label">Total Dokter</div>
        <div class="value">{{ $totalDoctors }}</div>
    </div>
</div>

<p style="font-size: 11px; color: #64748b; margin-bottom: 16px;">
    Total rekam medis tercatat: <strong>{{ $totalMedicalRecords }}</strong>
</p>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Pasien</th>
            <th>Dokter</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recentAppointments as $appointment)
        <tr>
            <td>{{ \Carbon\Carbon::parse($appointment->tanggal_janji)->translatedFormat('d M Y') }}</td>
            <td>{{ $appointment->pasien->user->nama ?? '-' }}</td>
            <td>{{ $appointment->dokter->user->nama ?? '-' }}</td>
            <td>
                @php
                    $statusLabel = [
                        'pending' => 'Menunggu',
                        'called' => 'Dipanggil',
                        'in_consultation' => 'Konsultasi',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ];
                @endphp
                {{ $statusLabel[$appointment->status_janji] ?? ucfirst($appointment->status_janji) }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection