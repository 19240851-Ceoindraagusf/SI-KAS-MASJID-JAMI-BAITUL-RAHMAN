<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KasKeluarController extends Controller
{
    public function index()
    {
        $items = KasKeluar::with('kategori', 'user')->orderBy('tanggal', 'desc')->paginate(15);
        return view('kas_keluar.index', compact('items'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('kas_keluar.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        $validated['user_id'] = auth()->id();

        KasKeluar::create($validated);

        return redirect()->route('kas_keluar.index')->with('success', 'Kas keluar berhasil ditambahkan.');
    }

    public function edit(KasKeluar $kasKeluar)
    {
        $kategoris = Kategori::all();
        return view('kas_keluar.edit', compact('kasKeluar', 'kategoris'));
    }

    public function update(Request $request, KasKeluar $kasKeluar)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        $kasKeluar->update($validated);

        return redirect()->route('kas_keluar.index')->with('success', 'Kas keluar berhasil diperbarui.');
    }

    public function destroy(KasKeluar $kasKeluar)
    {
        $kasKeluar->delete();
        return redirect()->route('kas_keluar.index')->with('success', 'Kas keluar dihapus.');
    }
}
