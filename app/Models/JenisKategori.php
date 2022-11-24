<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKategori extends Model
{
    use HasFactory;
    protected $table = 'jenis_kategori';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->hasMany(Kategori::class);
    }
}
