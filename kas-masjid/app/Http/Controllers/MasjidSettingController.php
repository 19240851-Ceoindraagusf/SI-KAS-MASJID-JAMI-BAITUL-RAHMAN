<?php

namespace App\Http\Controllers;

use App\Models\MasjidSetting;
use App\Services\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasjidSettingController extends Controller
{
    public function edit()
    {
        $setting = MasjidSetting::current();

        return view('settings.masjid', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = MasjidSetting::current();

        $validated = $request->validate([
            'nama_masjid' => 'required|string|max:150',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:50',
            'ketua_masjid' => 'nullable|string|max:100',
            'bendahara' => 'nullable|string|max:100',
            'catatan_laporan' => 'nullable|string|max:500',
            'transparansi_publik' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $oldValues = $setting->toArray();
        $validated['transparansi_publik'] = $request->boolean('transparansi_publik');

        if ($request->hasFile('logo')) {
            if ($setting->logo_path) {
                Storage::disk('public')->delete($setting->logo_path);
            }

            $validated['logo_path'] = $request->file('logo')->store('identitas-masjid', 'public');
        }

        unset($validated['logo']);
        $setting->update($validated);

        AuditLogger::record(
            'update_setting',
            'Memperbarui identitas masjid dan pengaturan laporan',
            $setting,
            $oldValues,
            $setting->fresh()->toArray()
        );

        return redirect()->route('settings.masjid.edit')->with('success', 'Identitas masjid berhasil diperbarui.');
    }
}
