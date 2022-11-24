<?php

namespace App\Exports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class KategoriExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Kategori::with('jenis_kategori')->whereNot('nama', 'None')->where('jenis_kategori_id', '<', 3)->get();
    }

    public function map($kategori): array
    {
        return [
            $kategori->nama,
            $kategori->jenis_kategori->kategori,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Jenis Kategori',
        ];
    }
}
