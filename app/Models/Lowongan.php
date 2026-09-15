<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'kuota',
        'durasi_bulan',
        'tgl_buka',
        'tgl_tutup',
        'status',
    ];

    protected $casts = [
        'tgl_buka'  => 'date',
        'tgl_tutup' => 'date',
    ];

    public function isAktif()
    {
        return $this->status === 'buka'
            && now()->between($this->tgl_buka, $this->tgl_tutup);
    }
}