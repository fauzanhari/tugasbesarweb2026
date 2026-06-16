<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoLomba;
use Illuminate\Http\Request;

class InfoLombaController extends Controller
{
    public function index()
    {
        $lombas = InfoLomba::orderBy('created_at', 'desc')->get();
        return view('admin.infolomba.index', compact('lombas'));
    }

    public function create()
    {
        return view('admin.infolomba.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_batas' => 'nullable|date',
            'link_pendaftaran' => 'nullable|url'
        ]);

        InfoLomba::create($request->all());

        return redirect()->route('admin.infolomba.index')->with('success', 'Info lomba berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $lomba = InfoLomba::findOrFail($id);
        return view('admin.infolomba.edit', compact('lomba'));
    }

    public function update(Request $request, $id)
    {
        $lomba = InfoLomba::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_batas' => 'nullable|date',
            'link_pendaftaran' => 'nullable|url'
        ]);

        $lomba->update($request->all());

        return redirect()->route('admin.infolomba.index')->with('success', 'Info lomba berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $lomba = InfoLomba::findOrFail($id);
        $lomba->delete();

        return redirect()->route('admin.infolomba.index')->with('success', 'Info lomba berhasil dihapus!');
    }
}
