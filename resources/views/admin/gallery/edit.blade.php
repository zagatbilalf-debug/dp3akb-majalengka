@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/gallery.css') }}">
@endpush

@section('content')
    <div class="card">
        <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="gallery-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul">Judul Penghargaan</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $gallery->judul) }}" class="form-control" required>
                @error('judul') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" name="tahun" id="tahun" value="{{ old('tahun', $gallery->tahun) }}" class="form-control" min="1990" max="2100" required>
                    @error('tahun') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="foto">Foto Penghargaan (kosongkan jika tidak diganti)</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                    @error('foto') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <img src="{{ asset('storage/' . $gallery->foto) }}" class="gallery-preview-img" id="previewFoto">

            <div class="form-group">
                <label for="deskripsi">Deskripsi (opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
                @error('deskripsi') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="gallery-form-actions">
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Update Penghargaan</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/gallery.js') }}" defer></script>
@endpush