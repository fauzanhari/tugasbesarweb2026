<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        // Mengambil semua akun yang role-nya 'dosen' beserta tabel keahliannya
        $dosens = User::where('role', 'dosen')->with('keahlian')->get();
        
        return view('mahasiswa.dosen.index', compact('dosens'));
    }
}
