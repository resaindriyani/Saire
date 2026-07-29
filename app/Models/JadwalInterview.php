<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalInterview extends Model
{
    protected $fillable = [
        'lamaran_id',
        'waktu_interview',
        'lokasi_atau_link',
        'tipe',
        'catatan',
        'sudah_dibaca',
    ];

    protected $casts = [
        'waktu_interview' => 'datetime',
        'sudah_dibaca'    => 'boolean',
    ];

    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class);
    }
}