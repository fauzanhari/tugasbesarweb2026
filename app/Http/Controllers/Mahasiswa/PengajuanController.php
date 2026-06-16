<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PengajuanLomba;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    // Menampilkan riwayat pengajuan lomba mahasiswa
    public function index()
    {
        $pengajuans = PengajuanLomba::where('mahasiswa_id', Auth::id())->with('dosen')->get();
        return view('mahasiswa.pengajuan.index', compact('pengajuans'));
    }

    // Menampilkan form untuk mengajukan lomba baru ke dosen tertentu
    public function create(Request $request)
    {
        $dosen_id = $request->query('dosen_id');
        $dosen = null;
        if ($dosen_id) {
            $dosen = User::where('id', $dosen_id)->where('role', 'dosen')->first();
        }

        // Ambil semua dosen untuk opsi dropdown jika user tidak datang dari halaman Cari Dosen
        $semuaDosen = User::where('role', 'dosen')->get();

        return view('mahasiswa.pengajuan.create', compact('dosen', 'semuaDosen'));
    }

    // Menyimpan data pengajuan dan file PDF ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul_lomba' => 'required|string|max:255',
            'dosen_id' => 'required|exists:users,id',
            'file_proposal' => 'required|mimes:pdf|max:5120', // Maksimal 5MB, hanya PDF
        ]);

        // Menyimpan file PDF ke folder public/storage/proposals
        $filePath = $request->file('file_proposal')->store('proposals', 'public');

        PengajuanLomba::create([
            'mahasiswa_id' => Auth::id(),
            'dosen_id' => $request->dosen_id,
            'judul_lomba' => $request->judul_lomba,
            'file_proposal' => $filePath,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('mahasiswa.pengajuan.index')->with('success', 'Proposal Lomba berhasil diajukan! Menunggu persetujuan dosen.');
    }

    // Menampilkan detail pengajuan dan catatan revisi
    public function show($id)
    {
        $pengajuan = PengajuanLomba::where('mahasiswa_id', Auth::id())
                        ->with(['dosen', 'progress'])
                        ->findOrFail($id);
        
        return view('mahasiswa.pengajuan.show', compact('pengajuan'));
    }

    // Memproses unggahan file revisi
    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanLomba::where('mahasiswa_id', Auth::id())->findOrFail($id);

        // Pastikan hanya bisa update jika statusnya Revisi
        if ($pengajuan->status !== 'Revisi') {
            return redirect()->back()->with('error', 'Hanya proposal dengan status Revisi yang dapat diubah.');
        }

        $request->validate([
            'file_proposal' => 'required|mimes:pdf|max:5120',
        ]);

        // Simpan file baru
        $filePath = $request->file('file_proposal')->store('proposals', 'public');

        // Update database: ganti file dan ubah status jadi Menunggu lagi
        $pengajuan->update([
            'file_proposal' => $filePath,
            'status' => 'Menunggu'
        ]);

        return redirect()->route('mahasiswa.pengajuan.show', $id)->with('success', 'Revisi proposal berhasil dikirim! Menunggu dosen memeriksa ulang.');
    }
}
