<?php

namespace App\Exports;

use App\Models\RekamMedis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MedicalRecordsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return RekamMedis::with(['appointment.pasien.user', 'dokter.user'])
            ->latest('waktu_pemeriksaan')
            ->get();
    }

    public function headings(): array
    {
        return ['Date', 'Patient', 'Doctor', 'Diagnosis', 'Chief Complaint', 'Doctor Notes'];
    }

    public function map($rekam): array
    {
        $pasien = $rekam->appointment->pasien ?? null;

        return [
            $rekam->waktu_pemeriksaan,
            $pasien->user->nama ?? '-',
            $rekam->dokter->user->nama ?? '-',
            $rekam->diagnosa,
            $rekam->keluhan,
            $rekam->catatan_dokter,
        ];
    }
}