<?php

namespace App\Exports;

use App\Models\Ebook;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class EbookExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ebook::with('tempat_terbit', 'penerbit', 'kategori')->get();
    }

    public function map($ebook): array
    {
        return [
            $ebook->judul,
            $ebook->penulis,
            $ebook->tahun_terbit,
            $ebook->tempat_terbit->nama,
            $ebook->penerbit->nama,
            $ebook->kategori->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Penulis',
            'Tahun Terbit',
            'Tempat Terbit',
            'Penerbit',
            'Kategori',
        ];
    }
}
