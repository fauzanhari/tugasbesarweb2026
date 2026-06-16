<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\InfoLomba;
use App\Models\PengajuanLomba;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Highlight Berita dan Lomba terbaru
        $beritas = Berita::orderBy('tanggal', 'desc')->take(3)->get();
        $infolombas = InfoLomba::orderBy('created_at', 'desc')->take(3)->get();

        // Statistik
        $stats = [
            'total_mahasiswa' => User::where('role', 'mahasiswa')->count(),
            'total_dosen' => User::where('role', 'dosen')->count(),
            'total_proposal' => PengajuanLomba::count(),
            'total_lomba_aktif' => InfoLomba::where('tanggal_batas', '>=', now()->format('Y-m-d'))->count()
        ];

        return view('public.index', compact('beritas', 'infolombas', 'stats'));
    }

    public function berita()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->paginate(9);
        return view('public.berita.index', compact('beritas'));
    }

    public function beritaDetail($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Ambil berita terbaru lainnya untuk sidebar
        $recentBeritas = Berita::where('id', '!=', $id)->orderBy('tanggal', 'desc')->take(5)->get();
        
        return view('public.berita.show', compact('berita', 'recentBeritas'));
    }

    public function lomba()
    {
        $lombas = InfoLomba::orderBy('created_at', 'desc')->paginate(9);
        return view('public.lomba.index', compact('lombas'));
    }

    public function lombaDetail($id)
    {
        $lomba = InfoLomba::findOrFail($id);
        return view('public.lomba.show', compact('lomba'));
    }

    public function tentang()
    {
        return view('public.tentang');
    }
}
