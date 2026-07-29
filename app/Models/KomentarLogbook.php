<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarLogbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'logbook_id',
        'user_id',
        'komentar',
    ];

    public function logbook()
    {
        return $this->belongsTo(Logbook::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}