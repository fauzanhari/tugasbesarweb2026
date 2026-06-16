<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PengajuanLomba;
use App\Models\ProgressBimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    // Menyimpan progress baru dari mahasiswa
    public function store(Request $request, $pengajuan_id)
    {
        // Validasi apakah pengajuan ini milik mahasiswa yang sedang login dan berstatus ACC
        $pengajuan = PengajuanLomba::where('mahasiswa_id', Auth::id())
            ->where('id', $pengajuan_id)
            ->where('status', 'ACC')
            ->firstOrFail();

        $request->validate([
            'keterangan' => 'required|string',
            'file_lampiran' => 'nullable|file|max:5120', // Opsional, maks 5MB
        ]);

        $filePath = null;
        if ($request->hasFile('file_lampiran')) {
            $filePath = $request->file('file_lampiran')->store('progress', 'public');
        }

        ProgressBimbingan::create([
            'pengajuan_id' => $pengajuan->id,
            'keterangan' => $request->keterangan,
            'file_lampiran' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Progress berhasil ditambahkan!');
    }
}
