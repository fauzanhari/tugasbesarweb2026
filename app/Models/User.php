<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    // Relasi untuk Dosen
    public function keahlian()
    {
        return $this->hasOne(DosenKeahlian::class, 'user_id');
    }

    public function pengajuanLombaSebagaiDosen()
    {
        return $this->hasMany(PengajuanLomba::class, 'dosen_id');
    }

    // Relasi untuk Mahasiswa
    public function pengajuanLombaSebagaiMahasiswa()
    {
        return $this->hasMany(PengajuanLomba::class, 'mahasiswa_id');
    }
}
