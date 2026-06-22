<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AppointmentsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Appointment::with(['pasien.user', 'dokter.user'])
            ->latest('tanggal_janji')
            ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Patient', 'Doctor', 'Date', 'Queue No', 'Status', 'Chief Complaint'];
    }

    public function map($appointment): array
    {
        return [
            $appointment->id_janji,
            $appointment->pasien->user->nama ?? '-',
            $appointment->dokter->user->nama ?? '-',
            $appointment->tanggal_janji,
            $appointment->nomor_antrian,
            ucfirst($appointment->status_janji),
            $appointment->keluhan_utama,
        ];
    }
}