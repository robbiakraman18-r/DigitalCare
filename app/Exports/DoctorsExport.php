<?php

namespace App\Exports;

use App\Models\Dokter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DoctorsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Dokter::with('user')->get();
    }

    public function headings(): array
    {
        return ['No. SIP', 'Name', 'Email', 'Gender', 'Availability Status'];
    }

    public function map($dokter): array
    {
        return [
            $dokter->no_sip,
            $dokter->user->nama ?? '-',
            $dokter->user->email ?? '-',
            $dokter->gender,
            $dokter->status_ketersediaan,
        ];
    }
}