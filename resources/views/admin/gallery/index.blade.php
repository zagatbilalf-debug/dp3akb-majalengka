@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/gallery.css') }}">
@endpush

@section('content')
    <div class="gallery-grid">
        @forelse($galleries as $gallery)
            <div class="gallery-card">
                <div class="gallery-card-image">
                    <img src="{{ str_starts_with($gallery->foto, 'http') ? $gallery->foto : asset('storage/' . $gallery->foto) }}" alt="{{ $gallery->judul }}">
                    <span class="gallery-card-year">{{ $gallery->tahun }}</span>
                </div>
                <div class="gallery-card-body">
                    <h3 class="gallery-card-title">{{ $gallery->judul }}</h3>
                    @if($gallery->deskripsi)
                        <p class="gallery-card-desc">{{ Str::limit($gallery->deskripsi, 80) }}</p>
                    @endif
                </div>
                <div class="gallery-card-actions">
                    <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-outline btn-sm">
                        <i class="fa-solid fa-pen"></i> Edit
                    </a>
                   <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" class="js-delete-form" data-item-name="gallery &quot;{{ $gallery->judul }}&quot;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fa-solid fa-trash"></i>
    </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="gallery-empty">
                <i class="fa-solid fa-trophy"></i>
                <p>Belum ada penghargaan.</p>
            </div>
        @endforelse
    </div>

    <div class="gallery-pagination">
        {{ $galleries->links() }}
    </div>
@endsection