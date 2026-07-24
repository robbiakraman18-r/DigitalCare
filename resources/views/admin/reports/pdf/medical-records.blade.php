@extends('admin.reports.pdf._layout')

@section('report_title', 'Laporan Rekam Medis')

@section('report_body')

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Pasien</th>
            <th>Dokter</th>
            <th>Diagnosis</th>
            <th>Keluhan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rekamMedisList as $rekam)
        @php $pasien = $rekam->appointment->pasien ?? null; @endphp
        <tr>
            <td>{{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->translatedFormat('d M Y H:i') }}</td>
            <td>{{ $pasien->user->nama ?? '-' }}</td>
            <td>{{ $rekam->dokter->user->nama ?? '-' }}</td>
            <td>{{ $rekam->diagnosa }}</td>
            <td>{{ $rekam->keluhan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection