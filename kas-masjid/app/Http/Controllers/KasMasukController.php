<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KasMasukController extends Controller
{
    public function index()
    {
        $items = KasMasuk::with('kategori', 'user')->orderBy('tanggal', 'desc')->paginate(15);
        return view('kas_masuk.index', compact('items'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('kas_masuk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $validated['user_id'] = auth()->id();

        KasMasuk::create($validated);

        return redirect()->route('kas_masuk.index')->with('success', 'Kas masuk berhasil ditambahkan.');
    }

    public function edit(KasMasuk $kasMasuk)
    {
        $kategoris = Kategori::all();
        return view('kas_masuk.edit', compact('kasMasuk', 'kategoris'));
    }

    public function update(Request $request, KasMasuk $kasMasuk)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $kasMasuk->update($validated);

        return redirect()->route('kas_masuk.index')->with('success', 'Kas masuk berhasil diperbarui.');
    }

    public function destroy(KasMasuk $kasMasuk)
    {
        $kasMasuk->delete();
        return redirect()->route('kas_masuk.index')->with('success', 'Kas masuk dihapus.');
    }
}
