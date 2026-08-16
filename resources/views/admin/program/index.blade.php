@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/program.css') }}">
@endpush

@section('content')
    <div class="program-grid">
        @forelse($programs as $program)
            <div class="program-card">
                <div class="program-card-image">
                    @if($program->gambar)
                        <img src="{{ asset('storage/' . $program->gambar) }}" alt="{{ $program->nama_program }}">
                    @else
                        <div class="program-card-image-empty">
                            <i class="fa-solid fa-star"></i>
                        </div>
                    @endif
                </div>
                <div class="program-card-body">
                    <h3 class="program-card-title">{{ $program->nama_program }}</h3>
                    <p class="program-card-desc">{{ Str::limit($program->deskripsi, 90) }}</p>
                    @if($program->link)
                        <a href="{{ $program->link }}" target="_blank" class="program-card-link">
                            <i class="fa-solid fa-link"></i> Lihat Link
                        </a>
                    @endif
                </div>
                <div class="program-card-actions">
                    <a href="{{ route('admin.program.edit', $program->id) }}" class="btn btn-outline btn-sm">
                        <i class="fa-solid fa-pen"></i> Edit
                    </a>
                    <form action="{{ route('admin.program.destroy', $program->id) }}" method="POST" class="js-delete-form" data-item-name="program &quot;{{ $program->nama_program }}&quot;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
                </div>
            </div>
        @empty
            <div class="program-empty">
                <i class="fa-solid fa-star"></i>
                <p>Belum ada program unggulan.</p>
            </div>
        @endforelse
    </div>

    <div class="program-pagination">
        {{ $programs->links() }}
    </div>
@endsection