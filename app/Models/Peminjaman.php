<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = ['kode_pinjam', 'peminjam_id', 'petugas_pinjam', 'petugas_kembali', 'status', 'denda', 'tanggal_pinjam', 'tanggal_kembali', 'tanggal_pengembalian'];

    // relation
    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // accesor (merubah nilai yg ada di view tidak di database)
    protected function denda(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? "Rp. {$value}" : '-'
        );
    }

    protected function tanggal_pinjam(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value->format("dd/mm/Y"),
        );
    }

    protected function getTanggalKembaliAttribute($value)
    {
        return Carbon::create($value)->format('d-M-Y');
    }

    protected function getTanggalPengembalianAttribute($value)
    {
        return Carbon::create($value)->format('d-M-Y');
    }
}
