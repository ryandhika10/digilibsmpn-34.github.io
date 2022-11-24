<?php

namespace App\Imports;

use App\Models\Rak;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Support\Str;
use App\Models\TempatTerbit;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class BukuImport implements ToModel, WithHeadingRow, WithValidation
{
    private $kategori, $penerbit, $tempat_terbit, $rak;

    public function rules(): array
    {
        return [
            'judul' => 'required|unique:buku',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required|numeric|min:1',
            'kategori' => [
                'required', Rule::exists('kategori', 'nama')->where(function ($query) {
                    return $query->where('jenis_kategori_id', 1);
                }),
            ],
            'rak' => 'required|numeric|exists:rak,rak',
            'baris' => 'required|numeric|exists:rak,baris',
            'penerbit' => 'required|exists:penerbit,nama',
            'tempat_terbit' => 'required|exists:tempat_terbit,nama',
        ];
    }

    public function __construct()
    {
        $this->kategori = Kategori::select('id', 'nama', 'digunakan')->where('jenis_kategori_id', 1)->get();
        $this->penerbit = Penerbit::select('id', 'nama')->get();
        $this->tempat_terbit = TempatTerbit::select('id', 'nama')->get();
        $this->rak = Rak::select('id', 'rak', 'baris', 'kategori_id')->get();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $kategori = $this->kategori->where('nama', $row['kategori'])->first();
        $kategori->increment('digunakan');
        $tempat_terbit = $this->tempat_terbit->where('nama', $row['tempat_terbit'])->first();
        $penerbit = $this->penerbit->where('nama', $row['penerbit'])->first();
        $rak = $this->rak->where('rak', $row['rak'])->where('baris', $row['baris'])->first();

        return new Buku([
            'judul'     => $row['judul'],
            'slug' => Str::slug($row['judul']),
            'sampul' => 'buku/tidak_ada_sampul.png',
            'penulis'    => $row['penulis'],
            'tahun_terbit'    => $row['tahun_terbit'],
            'dilihat'    => 0,
            'tempat_terbit_id'    => $tempat_terbit->id ?? NULL,
            'penerbit_id'    => $penerbit->id ?? NULL,
            'kategori_id'    => $kategori->id ?? NULL,
            'rak_id'    => $rak->id ?? NULL,
            'stok'    => $row['stok'],
        ]);
    }
}
