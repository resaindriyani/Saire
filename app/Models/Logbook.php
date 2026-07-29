<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'lamaran_id',
        'tanggal',
        'judul_kegiatan',
        'deskripsi_kegiatan',
        'link_tugas',
        'foto',
    ];

    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class);
    }

    public function komentarLogbooks()
    {
        return $this->hasMany(KomentarLogbook::class);
    }
}