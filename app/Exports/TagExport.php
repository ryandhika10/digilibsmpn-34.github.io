<?php

namespace App\Exports;

use App\Models\Tag;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TagExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Tag::all();
    }

    public function map($tag): array
    {
        return [
            $tag->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama'
        ];
    }
}
