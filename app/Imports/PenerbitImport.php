<?php

namespace App\Imports;

use App\Models\Penerbit;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PenerbitImport implements ToModel, WithHeadingRow, WithValidation
{

    public function rules(): array
    {
        return [
            'nama' => 'required|unique:penerbit',
        ];
    }

    public function model(array $row)
    {

        return new Penerbit([
            'nama'     => $row['nama'],
            'slug' => Str::slug($row['nama']),
        ]);
    }
}
