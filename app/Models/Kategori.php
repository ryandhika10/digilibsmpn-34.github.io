<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $guarded = ['id'];

    public function rak()
    {
        return $this->hasMany(Rak::class);
    }

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }

    public function ebook()
    {
        return $this->hasMany(Ebook::class);
    }

    public function blog()
    {
        return $this->hasMany(Post::class);
    }

    public function jenis_kategori()
    {
        return $this->belongsTo(JenisKategori::class);
    }

    // mutator
    protected function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucfirst($value);
    }
}
