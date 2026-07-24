@extends('admin.reports.pdf._layout')

@section('report_title', 'Laporan Pasien')

@section('report_body')

<table>
    <thead>
        <tr>
            <th>No. RM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pasienList as $pasien)
        <tr>
            <td>{{ $pasien->no_rm }}</td>
            <td>{{ $pasien->user->nama ?? '-' }}</td>
            <td>{{ $pasien->user->email ?? '-' }}</td>
            <td>{{ $pasien->gender === 'Male' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>{{ $pasien->phone_number }}</td>
            <td>{{ $pasien->address }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection