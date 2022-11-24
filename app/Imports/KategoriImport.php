<?php

namespace App\Imports;

use App\Models\Kategori;
use Illuminate\Support\Str;
use App\Models\JenisKategori;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KategoriImport implements ToModel, WithHeadingRow, WithValidation
{
    private $jenisKategori;

    public function __construct()
    {
        $this->jenisKategori = JenisKategori::select('id', 'kategori')->where('id', '<', 3)->get();
    }

    public function model(array $row)
    {
        $row['jenis_kategori'] = Str::ucfirst($row['jenis_kategori']);
        $jenisKategori = $this->jenisKategori->where('kategori', $row['jenis_kategori'])->first();
        return new Kategori([
            'nama'     => $row['nama'],
            'slug' => Str::slug($row['nama']),
            'digunakan' => 0,
            'jenis_kategori_id' => $jenisKategori->id ?? 0,
        ]);
    }

    public function rules(): array
    {
        $rules = [
            'nama' => 'required|min:3|max:30',
            'jenis_kategori' => 'required|exists:jenis_kategori,kategori',
        ];
        return $rules;
    }
}
