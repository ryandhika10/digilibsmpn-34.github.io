<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    // mutator
    protected function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucfirst($value);
    }
}
