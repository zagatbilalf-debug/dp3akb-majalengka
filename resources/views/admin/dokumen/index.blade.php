@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dokumen.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokumens as $dokumen)
                        @php
                            $fileUrl = str_starts_with($dokumen->file, 'http')
                                ? str_replace('/upload/', '/upload/fl_attachment/', $dokumen->file)
                                : asset('storage/' . $dokumen->file);
                        @endphp
                        <tr>
                            <td>{{ $dokumen->judul }}</td>
                            <td>
                                @if($dokumen->kategori)
                                    <span class="badge badge-info">{{ $dokumen->kategori }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $dokumen->tanggal?->translatedFormat('d M Y') ?? '-' }}</td>
                            <td>
                                <a href="{{ $fileUrl }}" target="_blank" class="dokumen-file-link">
                                    <i class="fa-solid fa-file-arrow-down"></i> Unduh
                                </a>
                            </td>
                            <td>
                                <div class="dokumen-actions">
                                    <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                  <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST" class="js-delete-form" data-item-name="dokumen &quot;{{ $dokumen->judul }}&quot;">
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
                            <td colspan="5" style="text-align:center; padding: 30px 0; color:#9ca3af;">
                                Belum ada dokumen.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="dokumen-pagination">
            {{ $dokumens->links() }}
        </div>
    </div>
@endsection