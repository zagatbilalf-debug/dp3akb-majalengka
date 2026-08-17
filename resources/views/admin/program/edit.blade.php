@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/program.css') }}">
@endpush

@section('content')
    <div class="card">
        <form action="{{ route('admin.program.update', $program->id) }}" method="POST" enctype="multipart/form-data" class="program-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_program">Nama Program</label>
                <input type="text" name="nama_program" id="nama_program" value="{{ old('nama_program', $program->nama_program) }}" class="form-control" required>
                @error('nama_program') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="gambar">Gambar / Icon</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                @error('gambar') <span class="form-error">{{ $message }}</span> @enderror

                @if($program->gambar)
                    <img src="{{ str_starts_with($program->gambar, 'http') ? $program->gambar : asset('storage/' . $program->gambar) }}" class="program-preview-img" id="previewGambar">
                @else
                    <img id="previewGambar" class="program-preview-img" style="display:none;">
                @endif
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="6" class="form-control" required>{{ old('deskripsi', $program->deskripsi) }}</textarea>
                @error('deskripsi') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="link">Link Detail (opsional)</label>
                <input type="text" name="link" id="link" value="{{ old('link', $program->link) }}" class="form-control" placeholder="https://...">
                @error('link') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="program-form-actions">
                <a href="{{ route('admin.program.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Update Program</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/program.js') }}" defer></script>
@endpush