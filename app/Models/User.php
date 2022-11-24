<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFoto()
    {
        if (!isset($this->avatar)) {
            return asset('storage/foto-user/user.png');
        }

        return asset('storage/' . $this->foto);
    }

    public function nama()
    {
        return $this->nama;

        return asset('storage/' . $this->foto);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public static function getPenulis()
    {
        return DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->whereBetween('role_id', [2, 4])
            ->get();
    }

    // accesor
    protected function setNameAttribute($value)
    {
        $this->attributes['nama'] = ucfirst($value);
    }
}
