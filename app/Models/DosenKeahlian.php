<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenKeahlian extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit karena bahasa Indonesia
    protected $table = 'dosen_keahlian';

    // Kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'bidang_keahlian'
    ];

    // Relasi balik ke tabel User (Dosen)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
