<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    protected $fillable = [
        'user_id',
        'universitas',
        'tgl_mulai',
        'tgl_selesai',
        'durasi_bulan',
        'status',
        'catatan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenLamaran::class);
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class);
    }

    public function jadwalInterview()
    {
        return $this->hasOne(JadwalInterview::class);
    }
}