<?php

namespace App\Imports;

use App\Models\Ebook;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Support\Str;
use App\Models\TempatTerbit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EbookImport implements ToModel, WithHeadingRow, WithValidation
{
    private $kategori, $penerbit, $tempat_terbit;

    public function rules(): array
    {
        return [
            'judul' => 'required|unique:buku',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'kategori' => 'required|exists:kategori,nama',
            'penerbit' => 'required|exists:penerbit,nama',
            'tempat_terbit' => 'required|exists:tempat_terbit,nama',
        ];
    }

    public function __construct()
    {
        $this->kategori = Kategori::select('id', 'nama', 'digunakan')->get();
        $this->penerbit = Penerbit::select('id', 'nama')->get();
        $this->tempat_terbit = TempatTerbit::select('id', 'nama')->get();
    }

    public function model(array $row)
    {
        $kategori = $this->kategori->where('nama', $row['kategori'])->first();
        $kategori->increment('digunakan');
        $tempat_terbit = $this->tempat_terbit->where('nama', $row['tempat_terbit'])->first();
        $penerbit = $this->penerbit->where('nama', $row['penerbit'])->first();

        return new Ebook([
            'judul'     => $row['judul'],
            'slug' => Str::slug($row['judul']),
            'sampul' => 'ebook/tidak_ada_sampul.png',
            'file' => NULL,
            'penulis'    => $row['penulis'],
            'dilihat'    => 0,
            'tahun_terbit'    => $row['tahun_terbit'],
            'tempat_terbit_id'    => $tempat_terbit->id ?? NULL,
            'penerbit_id'    => $penerbit->id ?? NULL,
            'kategori_id'    => $kategori->id ?? NULL,
        ]);
    }
}
