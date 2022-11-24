<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peminjaman::where('status', 3)->with('detail_peminjaman')->get();
    }

    public function map($peminjaman): array
    {
        // foreach ($peminjaman->detail_peminjaman as $value) {
        $peminjam = User::whereId($peminjaman->peminjam_id)->firstOrFail();
        $petugas_pinjam = User::whereId($peminjaman->petugas_pinjam)->firstOrFail();
        $petugas_kembali = User::whereId($peminjaman->petugas_kembali)->firstOrFail();
        $peminjam = $peminjam->nama;
        $petugas_pinjam = $petugas_pinjam->nama;
        $petugas_kembali = $petugas_kembali->nama;

        return [
            $peminjaman->kode_pinjam,
            $peminjam,
            $peminjaman->detail_peminjaman[0]->buku->judul,
            $peminjaman->detail_peminjaman[1]->buku->judul ?? '-',
            $peminjaman->detail_peminjaman[0]->buku->rak->lokasi,
            $peminjaman->detail_peminjaman[1]->buku->rak->lokasi ?? '-',
            $petugas_pinjam,
            Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y'),
            $petugas_kembali,
            Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y'),
            $peminjaman->denda,
        ];
        // }
    }

    public function headings(): array
    {
        return [
            'Kode Pinjam',
            'Peminjam',
            'Judul Buku 1',
            'Judul Buku 2',
            'Lokasi Buku 1',
            'Lokasi Buku 2',
            'Petugas yang meminjamkan',
            'Tanggal Pinjam',
            'Petugas yang mengembalikan',
            'Tanggal Kembali',
            'Denda',
        ];
    }
}
