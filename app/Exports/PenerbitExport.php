<?php

namespace App\Exports;

use App\Models\Penerbit;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenerbitExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Penerbit::all();
    }

    public function map($penerbit): array
    {
        return [
            $penerbit->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama'
        ];
    }
}
