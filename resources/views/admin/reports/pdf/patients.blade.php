@extends('admin.reports.pdf._layout')

@section('report_title', 'Patient Report')

@section('report_body')

<table>
    <thead>
        <tr>
            <th>No. RM</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pasienList as $pasien)
        <tr>
            <td>{{ $pasien->no_rm }}</td>
            <td>{{ $pasien->user->nama ?? '-' }}</td>
            <td>{{ $pasien->user->email ?? '-' }}</td>
            <td>{{ $pasien->gender }}</td>
            <td>{{ $pasien->phone_number }}</td>
            <td>{{ $pasien->address }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection