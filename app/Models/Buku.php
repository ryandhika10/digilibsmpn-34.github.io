<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $guarded = ['id'];
    protected $with = ['kategori', 'penerbit', 'tempat_terbit'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {

            return $query->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('penulis', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            return $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('slug', $kategori);
            });
        });

        $query->when(
            $filters['penerbit'] ?? false,
            fn ($query, $penerbit) =>
            $query->whereHas(
                'penerbit',
                fn ($query) =>
                $query->where('slug', $penerbit)
            )
        );

        $query->when(
            $filters['tempat_terbit'] ?? false,
            fn ($query, $tempat_terbit) =>
            $query->whereHas(
                'tempat_terbit',
                fn ($query) =>
                $query->where('slug', $tempat_terbit)
            )
        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function tempat_terbit()
    {
        return $this->belongsTo(TempatTerbit::class);
    }
    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    // mutator
    protected function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucfirst($value);
    }

    // cara 1 : juga merubah data di database
    protected function setPenulisAttribute($value)
    {
        $this->attributes['penulis'] = ucfirst($value);
    }

    // cara 2 : tanpa merubah data di database
    // protected function penulis(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn ($value) => ucfirst($value)
    //     );
    // }
}
