<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\PengajuanLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganController extends Controller
{
    // Menampilkan daftar mahasiswa bimbingan (yang proposalnya sudah di-ACC)
    public function index()
    {
        // Ambil pengajuan yang sudah di-ACC oleh dosen yang sedang login
        $bimbingans = PengajuanLomba::where('dosen_id', Auth::id())
            ->where('status', 'ACC')
            ->with('mahasiswa')
            ->orderBy('updated_at', 'desc')
            ->get();
            
        return view('dosen.bimbingan.index', compact('bimbingans'));
    }

    // Menampilkan detail bimbingan (timeline progress)
    public function show($id)
    {
        $bimbingan = PengajuanLomba::where('dosen_id', Auth::id())
            ->where('id', $id)
            ->where('status', 'ACC')
            ->with(['mahasiswa', 'progress' => function($q) {
                $q->orderBy('created_at', 'desc');
            }])
            ->firstOrFail();

        return view('dosen.bimbingan.show', compact('bimbingan'));
    }

    // Dosen memberikan tanggapan/komentar pada progress tertentu
    public function updateProgress(Request $request, $id, $progress_id)
    {
        $request->validate([
            'tanggapan_dosen' => 'required|string'
        ]);

        // Verifikasi kepemilikan pengajuan
        PengajuanLomba::where('dosen_id', Auth::id())
            ->where('id', $id)
            ->where('status', 'ACC')
            ->firstOrFail();

        $progress = \App\Models\ProgressBimbingan::where('id', $progress_id)
            ->where('pengajuan_id', $id)
            ->firstOrFail();

        $progress->update([
            'tanggapan_dosen' => $request->tanggapan_dosen
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim!');
    }
}
