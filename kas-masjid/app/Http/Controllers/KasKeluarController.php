<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use App\Models\Kategori;
use App\Http\Requests\StoreKasKeluarRequest;
use App\Http\Requests\UpdateKasKeluarRequest;
use App\Services\AuditLogger;
use App\Services\TransactionCodeGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KasKeluarController extends Controller
{
    /**
     * Tampilkan semua data kas keluar
     */
    public function index(Request $request)
    {
        $userRole = auth()->user()->role;
        $search = $request->input('search');
        $kategoriId = $request->input('kategori_id');
        $status = $request->input('status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = KasKeluar::with('kategori', 'user')
            ->when($userRole === 'bendahara', fn ($q) => $q->where('user_id', auth()->id()))
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('keterangan', 'like', "%{$search}%")
                        ->orWhereHas('kategori', fn ($q) => $q->where('nama_kategori', 'like', "%{$search}%"))
                        ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($kategoriId, fn ($q) => $q->where('kategori_id', $kategoriId))
            ->when($status, fn ($q) => $q->where('status', $status))
            ->when($startDate, fn ($q) => $q->whereDate('tanggal', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('tanggal', '<=', $endDate));

        $items = $query->orderBy('tanggal', 'desc')
            ->paginate(15)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();
        
        return view('kas_keluar.index', compact('items', 'kategoris', 'search', 'kategoriId', 'status', 'startDate', 'endDate'));
    }

    /**
     * Tampilkan form untuk membuat kas keluar baru
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('kas_keluar.create', compact('kategoris'));
    }

    /**
     * Simpan kas keluar baru
     */
    public function store(StoreKasKeluarRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending'; // Status default adalah pending
        $validated['kode_transaksi'] = TransactionCodeGenerator::generate('KK', KasKeluar::class);

        if ($request->hasFile('bukti')) {
            $validated['bukti_path'] = $request->file('bukti')->store('bukti-kas-keluar', 'public');
        }

        $kasKeluar = KasKeluar::create($validated);

        AuditLogger::record(
            'create',
            "Menambahkan kas keluar {$kasKeluar->kode_transaksi}",
            $kasKeluar,
            null,
            $kasKeluar->toArray()
        );

        return redirect()->route('kas_keluar.index')
            ->with('success', 'Kas keluar berhasil ditambahkan. Menunggu persetujuan admin.');
    }

    /**
     * Tampilkan form edit kas keluar
     */
    public function edit(KasKeluar $kasKeluar)
    {
        $userRole = auth()->user()->role;
        
        // Validasi akses
        if ($userRole === 'bendahara' && $kasKeluar->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini');
        }
        
        // Bendahara tidak boleh edit data yang sudah di-approve atau reject
        if ($userRole === 'bendahara' && $kasKeluar->status !== 'pending') {
            abort(403, 'Anda tidak bisa mengubah data yang sudah diproses');
        }
        
        $kategoris = Kategori::all();
        return view('kas_keluar.edit', compact('kasKeluar', 'kategoris'));
    }

    /**
     * Update kas keluar
     */
    public function update(UpdateKasKeluarRequest $request, KasKeluar $kasKeluar)
    {
        $validated = $request->validated();
        $oldValues = $kasKeluar->toArray();

        if ($request->hasFile('bukti')) {
            if ($kasKeluar->bukti_path) {
                Storage::disk('public')->delete($kasKeluar->bukti_path);
            }

            $validated['bukti_path'] = $request->file('bukti')->store('bukti-kas-keluar', 'public');
        }

        $kasKeluar->update($validated);

        AuditLogger::record(
            'update',
            "Memperbarui kas keluar {$kasKeluar->kode_transaksi}",
            $kasKeluar,
            $oldValues,
            $kasKeluar->fresh()->toArray()
        );

        return redirect()->route('kas_keluar.index')
            ->with('success', 'Kas keluar berhasil diperbarui.');
    }

    /**
     * Hapus kas keluar
     */
    public function destroy(KasKeluar $kasKeluar)
    {
        $userRole = auth()->user()->role;
        
        // Validasi akses
        if ($userRole === 'bendahara' && $kasKeluar->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini');
        }
        
        // Bendahara hanya boleh hapus jika masih pending
        if ($userRole === 'bendahara' && $kasKeluar->status !== 'pending') {
            abort(403, 'Anda tidak bisa menghapus data yang sudah diproses');
        }
        
        AuditLogger::record(
            'delete',
            "Menghapus kas keluar {$kasKeluar->kode_transaksi}",
            $kasKeluar,
            $kasKeluar->toArray(),
            null
        );

        if ($kasKeluar->bukti_path) {
            Storage::disk('public')->delete($kasKeluar->bukti_path);
        }

        $kasKeluar->delete();
        return redirect()->route('kas_keluar.index')
            ->with('success', 'Kas keluar berhasil dihapus.');
    }

    /**
     * Approve kas keluar (Admin only)
     */
    public function approve(KasKeluar $kasKeluar)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat approve');
        }
        
        if ($kasKeluar->status !== 'pending') {
            return redirect()->route('kas_keluar.index')
                ->with('error', 'Hanya kas keluar dengan status pending yang bisa di-approve');
        }
        
        $oldValues = $kasKeluar->toArray();
        $kasKeluar->update(['status' => 'approved']);

        AuditLogger::record(
            'approve',
            "Menyetujui kas keluar {$kasKeluar->kode_transaksi}",
            $kasKeluar,
            $oldValues,
            $kasKeluar->fresh()->toArray()
        );
        
        return redirect()->route('kas_keluar.index')
            ->with('success', 'Kas keluar berhasil disetujui');
    }

    /**
     * Reject kas keluar (Admin only)
     */
    public function reject(Request $request, KasKeluar $kasKeluar)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat reject');
        }
        
        if ($kasKeluar->status !== 'pending') {
            return redirect()->route('kas_keluar.index')
                ->with('error', 'Hanya kas keluar dengan status pending yang bisa di-reject');
        }
        
        $oldValues = $kasKeluar->toArray();
        $kasKeluar->update(['status' => 'rejected']);

        AuditLogger::record(
            'reject',
            "Menolak kas keluar {$kasKeluar->kode_transaksi}",
            $kasKeluar,
            $oldValues,
            $kasKeluar->fresh()->toArray()
        );
        
        return redirect()->route('kas_keluar.index')
            ->with('success', 'Kas keluar berhasil ditolak');
    }
}
