<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenLamaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'lamaran_id',
        'jenis',
        'path_file',
        'original_name',
    ];

    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class);
    }
}