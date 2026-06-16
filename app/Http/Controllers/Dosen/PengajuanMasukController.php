<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\PengajuanLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanMasukController extends Controller
{
    // Menampilkan daftar proposal yang masuk ke dosen ini
    public function index()
    {
        $pengajuans = PengajuanLomba::where('dosen_id', Auth::id())
            ->with('mahasiswa')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('dosen.pengajuan.index', compact('pengajuans'));
    }

    // Menampilkan detail proposal dan form aksi (ACC/Revisi)
    public function show($id)
    {
        $pengajuan = PengajuanLomba::where('dosen_id', Auth::id())
            ->where('id', $id)
            ->with('mahasiswa')
            ->firstOrFail();

        return view('dosen.pengajuan.show', compact('pengajuan'));
    }

    // Memproses aksi ACC atau Revisi dari Dosen
    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanLomba::where('dosen_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'status' => 'required|in:ACC,Revisi,Menunggu',
            'catatan' => 'nullable|string',
        ]);

        $pengajuan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        if ($request->status == 'ACC') {
            $pesan = 'Proposal berhasil disetujui (ACC).';
        } elseif ($request->status == 'Revisi') {
            $pesan = 'Catatan revisi berhasil dikirim ke mahasiswa.';
        } else {
            $pesan = 'Keputusan ACC berhasil dibatalkan. Status dikembalikan ke Menunggu.';
        }

        return redirect()->route('dosen.pengajuan.index')->with('success', $pesan);
    }
}
