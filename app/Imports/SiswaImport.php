<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{

    public function rules(): array
    {
        return [
            'nis' => 'required|digits:5|unique:siswa,nis|unique:users,kode',
            'nama' => 'required|min:3|max:60',
            'kelas' => 'required|min:2|max:2',
        ];
    }

    public function model(array $row)
    {

        return new Siswa([
            'nis'     => $row['nis'],
            'nama'     => $row['nama'],
            'kelas'     => $row['kelas'],
        ]);
    }
}
