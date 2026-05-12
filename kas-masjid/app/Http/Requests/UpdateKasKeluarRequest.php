<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKasKeluarRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'jumlah' => preg_replace('/[^\d]/', '', (string) $this->input('jumlah')),
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $kasKeluar = $this->route('kas_keluar');
        
        // Admin bisa update status
        // Bendahara hanya bisa edit jika masih pending
        if (auth()->user()->role === 'admin') {
            return true;
        }
        
        if (auth()->user()->role === 'bendahara') {
            return $kasKeluar->status === 'pending' && $kasKeluar->user_id === auth()->id();
        }
        
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tanggal' => 'required|date|date_format:Y-m-d',
            'jumlah' => 'required|numeric|min:0.01|max:999999999.99',
            'keterangan' => 'required|string|max:255|min:3',
            'kategori_id' => 'required|integer|exists:kategoris,id',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Tanggal harus berupa tanggal yang valid',
            'tanggal.date_format' => 'Format tanggal tidak sesuai (YYYY-MM-DD)',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal Rp 0,01',
            'jumlah.max' => 'Jumlah terlalu besar',
            'keterangan.required' => 'Keterangan harus diisi',
            'keterangan.string' => 'Keterangan harus berupa teks',
            'keterangan.max' => 'Keterangan maksimal 255 karakter',
            'keterangan.min' => 'Keterangan minimal 3 karakter',
            'kategori_id.required' => 'Kategori harus dipilih',
            'kategori_id.exists' => 'Kategori tidak ditemukan',
            'bukti.mimes' => 'Bukti harus berupa JPG, PNG, atau PDF',
            'bukti.max' => 'Ukuran bukti maksimal 2MB',
        ];
    }
}
