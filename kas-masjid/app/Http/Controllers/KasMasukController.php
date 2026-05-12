<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use App\Models\Kategori;
use App\Services\AuditLogger;
use App\Services\TransactionCodeGenerator;
use Illuminate\Http\Request;

class KasMasukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategoriId = $request->input('kategori_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $items = KasMasuk::with('kategori', 'user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('keterangan', 'like', "%{$search}%")
                        ->orWhereHas('kategori', fn ($q) => $q->where('nama_kategori', 'like', "%{$search}%"))
                        ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($kategoriId, fn ($query) => $query->where('kategori_id', $kategoriId))
            ->when($startDate, fn ($query) => $query->whereDate('tanggal', '>=', $startDate))
            ->when($endDate, fn ($query) => $query->whereDate('tanggal', '<=', $endDate))
            ->orderBy('tanggal', 'desc')
            ->paginate(15)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('kas_masuk.index', compact('items', 'kategoris', 'search', 'kategoriId', 'startDate', 'endDate'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('kas_masuk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'jumlah' => preg_replace('/[^\d]/', '', (string) $request->input('jumlah')),
        ]);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['kode_transaksi'] = TransactionCodeGenerator::generate('KM', KasMasuk::class);

        $kasMasuk = KasMasuk::create($validated);

        AuditLogger::record(
            'create',
            "Menambahkan kas masuk {$kasMasuk->kode_transaksi}",
            $kasMasuk,
            null,
            $kasMasuk->toArray()
        );

        return redirect()->route('kas_masuk.index')->with('success', 'Kas masuk berhasil ditambahkan.');
    }

    public function edit(KasMasuk $kasMasuk)
    {
        $kategoris = Kategori::all();
        return view('kas_masuk.edit', compact('kasMasuk', 'kategoris'));
    }

    public function update(Request $request, KasMasuk $kasMasuk)
    {
        $request->merge([
            'jumlah' => preg_replace('/[^\d]/', '', (string) $request->input('jumlah')),
        ]);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $oldValues = $kasMasuk->toArray();
        $kasMasuk->update($validated);

        AuditLogger::record(
            'update',
            "Memperbarui kas masuk {$kasMasuk->kode_transaksi}",
            $kasMasuk,
            $oldValues,
            $kasMasuk->fresh()->toArray()
        );

        return redirect()->route('kas_masuk.index')->with('success', 'Kas masuk berhasil diperbarui.');
    }

    public function destroy(KasMasuk $kasMasuk)
    {
        AuditLogger::record(
            'delete',
            "Menghapus kas masuk {$kasMasuk->kode_transaksi}",
            $kasMasuk,
            $kasMasuk->toArray(),
            null
        );

        $kasMasuk->delete();
        return redirect()->route('kas_masuk.index')->with('success', 'Kas masuk dihapus.');
    }
}
