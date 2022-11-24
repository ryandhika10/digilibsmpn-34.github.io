<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GuruImport implements ToModel, WithHeadingRow, WithValidation
{

    public function rules(): array
    {
        return [
            'nip' => 'required|digits_between:7,18|unique:guru,nip|unique:users,kode',
            'nama' => 'required|min:3|max:60',
        ];
    }

    public function model(array $row)
    {

        return new Guru([
            'nip'     => $row['nip'],
            'nama'     => $row['nama'],
        ]);
    }
}
