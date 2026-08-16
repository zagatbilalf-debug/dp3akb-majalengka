@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $berita)
                        <tr>
                            <td>
                                @if($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-thumb">
                                @else
                                    <div class="berita-thumb berita-thumb-empty">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $berita->judul }}</td>
                            <td>{{ $berita->kategori ?? '-' }}</td>
                            <td>
                                @if($berita->status === 'publish')
                                    <span class="badge badge-success">Publish</span>
                                @else
                                    <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                            <td>{{ $berita->tanggal_terbit ? \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d M Y') : '-' }}</td>
                            <td>
                                <div class="berita-actions">
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="js-delete-form" data-item-name="berita &quot;{{ $berita->judul }}&quot;">
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
                                Belum ada berita.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="berita-pagination">
            {{ $beritas->links() }}
        </div>
    </div>
@endsection