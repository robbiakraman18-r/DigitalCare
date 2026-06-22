@extends('admin.reports.pdf._layout')

@section('report_title', 'Doctor Performance Report')

@section('report_body')

<table>
    <thead>
        <tr>
            <th>No. SIP</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Availability</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dokterList as $dokter)
        <tr>
            <td>{{ $dokter->no_sip }}</td>
            <td>{{ $dokter->user->nama ?? '-' }}</td>
            <td>{{ $dokter->user->email ?? '-' }}</td>
            <td>{{ $dokter->gender }}</td>
            <td>{{ $dokter->status_ketersediaan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection