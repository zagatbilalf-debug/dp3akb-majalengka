@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/laporan.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Pelapor</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $laporan)
                        <tr>
                            <td>{{ $laporan->nama_pelapor }}</td>
                            <td>{{ Str::limit($laporan->judul, 40) }}</td>
                            <td>{{ $laporan->kategori ?? '-' }}</td>
                            <td>
                                @if($laporan->status === 'baru')
                                    <span class="badge badge-info">Baru</span>
                                @elseif($laporan->status === 'diproses')
                                    <span class="badge badge-warning">Diproses</span>
                                @else
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                            <td>{{ $laporan->tanggal_lapor?->translatedFormat('d M Y') }}</td>
                            <td>
                                <div class="laporan-actions">
                                    <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                   <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST" class="js-delete-form" data-item-name="laporan &quot;{{ $laporan->judul }}&quot;">
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
                                Belum ada laporan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="laporan-pagination">
            {{ $laporans->links() }}
        </div>
    </div>
@endsection