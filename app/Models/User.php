<?php

namespace App\Models;

// MustVerifyEmail dihapus - verifikasi email tidak diperlukan
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔗 RELASI: Satu user memiliki satu profil pelamar
    public function profilPelamar()
    {
        return $this->hasOne(ProfilPelamar::class);
    }

    // 🔗 RELASI: Satu user bisa memiliki banyak riwayat lamaran
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class);
    }

    // 🔗 RELASI: Satu user bisa menulis banyak komentar di logbook
    public function komentarLogbooks()
    {
        return $this->hasMany(KomentarLogbook::class);
    }

    public function pesans()
    {
        return $this->hasMany(Pesan::class);
    }
}
