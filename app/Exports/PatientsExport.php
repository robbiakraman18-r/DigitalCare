<?php

namespace App\Exports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PatientsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Pasien::with('user')->get();
    }

    public function headings(): array
    {
        return ['No. RM', 'Name', 'Email', 'Gender', 'Birth Date', 'Phone', 'Address'];
    }

    public function map($pasien): array
    {
        return [
            $pasien->no_rm,
            $pasien->user->nama ?? '-',
            $pasien->user->email ?? '-',
            $pasien->gender,
            $pasien->birth_date,
            $pasien->phone_number,
            $pasien->address,
        ];
    }
}