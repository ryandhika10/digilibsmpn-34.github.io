<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'rak';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }

    // accesor
    protected function getLokasiAttribute()
    {
        return "Rak : {$this->rak}, Baris : {$this->baris}";
    }
}
