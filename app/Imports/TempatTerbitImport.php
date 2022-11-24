<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\TempatTerbit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TempatTerbitImport implements ToModel, WithHeadingRow, WithValidation
{

    public function rules(): array
    {
        return [
            'nama' => 'required|unique:tempat_terbit',
        ];
    }

    public function model(array $row)
    {

        return new TempatTerbit([
            'nama'     => $row['nama'],
            'slug' => Str::slug($row['nama']),
        ]);
    }
}
