@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/pimpinan.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pimpinans as $pimpinan)
                        <tr>
                            <td>
                                <img src="{{ str_starts_with($pimpinan->foto, 'http') ? $pimpinan->foto : asset('storage/' . $pimpinan->foto) }}" alt="{{ $pimpinan->nama }}" class="pimpinan-thumb">
                            </td>
                            <td>
                                <div class="pimpinan-nama">{{ $pimpinan->nama }}</div>
                                @if($pimpinan->nip)
                                    <div class="pimpinan-nip">NIP. {{ $pimpinan->nip }}</div>
                                @endif
                            </td>
                            <td>{{ $pimpinan->jabatan }}</td>
                            <td><span class="badge badge-info">{{ $pimpinan->kategori }}</span></td>
                            <td>
                                @if($pimpinan->status === 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-warning">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="pimpinan-actions">
                                    <a href="{{ route('admin.pimpinan.edit', $pimpinan->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.pimpinan.destroy', $pimpinan->id) }}" method="POST" class="js-delete-form" data-item-name="pimpinan &quot;{{ $pimpinan->nama }}&quot;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 30px 0; color:#9ca3af;">
                                Belum ada data pimpinan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pimpinan-pagination">
            {{ $pimpinans->links() }}
        </div>
    </div>
@endsection