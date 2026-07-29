<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $fillable = [
        'lamaran_id',
        'nomor_sertifikat',
        'tgl_terbit',
        'path_pdf',
    ];

    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class);
    }
}