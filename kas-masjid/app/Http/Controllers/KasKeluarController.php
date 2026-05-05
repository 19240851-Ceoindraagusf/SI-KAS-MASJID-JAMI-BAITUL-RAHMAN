<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use App\Models\Kategori;
use App\Http\Requests\StoreKasKeluarRequest;
use App\Http\Requests\UpdateKasKeluarRequest;
use Illuminate\Http\Request;

class KasKeluarController extends Controller
{
    /**
     * Tampilkan semua data kas keluar
     */
    public function index()
    {
        $userRole = auth()->user()->role;
        
        // Admin melihat semua, Bendahara hanya miliknya sendiri
        if ($userRole === 'bendahara') {
            $items = KasKeluar::where('user_id', auth()->id())
                ->with('kategori', 'user')
                ->orderBy('tanggal', 'desc')
                ->paginate(15);
        } else {
            $items = KasKeluar::with('kategori', 'user')
                ->orderBy('tanggal', 'desc')
                ->paginate(15);
        }
        
        return view('kas_keluar.index', compact('items'));
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

        KasKeluar::create($validated);

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
        $kasKeluar->update($validated);

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
        
        $kasKeluar->update(['status' => 'approved']);
        
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
        
        $kasKeluar->update(['status' => 'rejected']);
        
        return redirect()->route('kas_keluar.index')
            ->with('success', 'Kas keluar berhasil ditolak');
    }
}
