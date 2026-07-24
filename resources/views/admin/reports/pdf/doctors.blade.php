@extends('admin.reports.pdf._layout')

@section('report_title', 'Laporan Kinerja Dokter')

@section('report_body')

<table>
    <thead>
        <tr>
            <th>No. SIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Ketersediaan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dokterList as $dokter)
        <tr>
            <td>{{ $dokter->no_sip }}</td>
            <td>{{ $dokter->user->nama ?? '-' }}</td>
            <td>{{ $dokter->user->email ?? '-' }}</td>
            <td>{{ $dokter->gender === 'Male' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>{{ $dokter->status_ketersediaan === 'Available' ? 'Tersedia' : 'Tidak Tersedia' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection