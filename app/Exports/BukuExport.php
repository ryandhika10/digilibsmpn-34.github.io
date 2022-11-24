<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BukuExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Buku::with('tempat_terbit', 'penerbit', 'kategori', 'rak')->get();
    }

    public function map($buku): array
    {
        return [
            $buku->judul,
            $buku->penulis,
            $buku->tahun_terbit,
            $buku->tempat_terbit->nama,
            $buku->penerbit->nama,
            $buku->kategori->nama,
            $buku->rak->rak,
            $buku->rak->baris,
            $buku->stok,
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
            'Rak',
            'Baris',
            'Stok'
        ];
    }
}
