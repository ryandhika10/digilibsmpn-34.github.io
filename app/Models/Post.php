<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'post';
    protected $guarded = ['id'];
    protected $with = ['user', 'kategori', 'tag'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('konten', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            return $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('slug', $kategori);
            });
        });

        $query->when(
            $filters['user'] ?? false,
            fn ($query, $user) =>
            $query->whereHas(
                'user',
                fn ($query) =>
                $query->where('username', $user)
            )
        );

        $query->when(
            $filters['tag'] ?? false,
            fn ($query, $tag) =>
            $query->whereHas(
                'tag',
                fn ($query) =>
                $query->where('slug', $tag)
            )
        );
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucfirst($value);
    }

    public function rekomendasi()
    {
        return $this->hasOne(Rekomendasi::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }
}
