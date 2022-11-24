<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GuruExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Guru::all();
    }

    public function map($guru): array
    {
        return [
            $guru->nip,
            $guru->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
        ];
    }
}
