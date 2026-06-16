<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanLomba extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_lomba';

    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',
        'judul_lomba',
        'file_proposal',
        'status',
        'catatan'
    ];

    // Relasi ke User (Mahasiswa yang mengajukan)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    // Relasi ke User (Dosen pembimbing yang dituju)
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function progress()
    {
        return $this->hasMany(ProgressBimbingan::class, 'pengajuan_id');
    }
}
