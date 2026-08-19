@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/flatpickr-theme.css') }}">
@endpush

@section('content')
    <div class="card">
        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="berita-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul">Judul Berita</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" class="form-control" required>
                @error('judul') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Kegiatan" {{ old('kategori', $berita->kategori) === 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Pengumuman" {{ old('kategori', $berita->kategori) === 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="Berita Umum" {{ old('kategori', $berita->kategori) === 'Berita Umum' ? 'selected' : '' }}>Berita Umum</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="draft" {{ old('status', $berita->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="publish" {{ old('status', $berita->status) === 'publish' ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_terbit">Tanggal Terbit</label>
                    <input type="text" name="tanggal_terbit" id="tanggal_terbit" value="{{ old('tanggal_terbit', $berita->tanggal_terbit) }}" class="form-control" placeholder="Pilih tanggal" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar Cover</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                @error('gambar') <span class="form-error">{{ $message }}</span> @enderror

                @if($berita->gambar)
                    <img src="{{ $berita->gambar }}" class="berita-preview-img" id="previewGambar">
                @else
                    <img id="previewGambar" class="berita-preview-img" style="display:none;">
                @endif
            </div>

            <div class="form-group">
                <label for="konten">Konten Berita</label>
                <textarea name="konten" id="konten" rows="10">{{ old('konten', $berita->konten) }}</textarea>
                @error('konten') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="berita-form-actions">
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Update Berita</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js" defer></script>
    <script src="{{ asset('js/admin/berita.js') }}" defer></script>
    <script defer>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#tanggal_terbit", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d F Y",
                locale: "id",
                allowInput: true,
            });
        });
    </script>
@endpush