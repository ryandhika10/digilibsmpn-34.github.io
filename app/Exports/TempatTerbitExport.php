<?php

namespace App\Exports;

use App\Models\TempatTerbit;
use Maatwebsite\Excel\Concerns\FromCollection;

class TempatTerbitExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TempatTerbit::all();
    }

    public function map($tempat_terbit): array
    {
        return [
            $tempat_terbit->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama'
        ];
    }
}
