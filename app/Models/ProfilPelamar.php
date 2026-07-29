<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPelamar extends Model
{
    protected $fillable = [
        'user_id',
        'nim_nis',
        'institusi',
        'jurusan',
        'no_hp',
        'foto',
        'bio',
        'instagram',
        'tiktok',
        'linkedin',
        'github',
        'skills',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}