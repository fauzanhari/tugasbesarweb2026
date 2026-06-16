<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressBimbingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'keterangan',
        'file_lampiran',
        'tanggapan_dosen',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanLomba::class, 'pengajuan_id');
    }
}
