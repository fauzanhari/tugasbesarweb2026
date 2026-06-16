<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoLomba extends Model
{
    use HasFactory;

    protected $table = 'info_lombas';

    protected $fillable = [
        'judul',
        'penyelenggara',
        'deskripsi',
        'tanggal_batas',
        'link_pendaftaran'
    ];
}
