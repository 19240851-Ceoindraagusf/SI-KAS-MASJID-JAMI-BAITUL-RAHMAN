@extends('layouts.app')

@section('title', 'Kas Masuk')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h3>Data Kas Masuk</h3>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('kas_masuk.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kas Masuk
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Penginput</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td><strong>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</strong></td>
                        <td>{{ $item->user->name }}</td>
                        <td>
                            <a href="{{ route('kas_masuk.edit', $item) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('kas_masuk.destroy', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada data kas masuk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $items->links() }}
</div>
@endsection
