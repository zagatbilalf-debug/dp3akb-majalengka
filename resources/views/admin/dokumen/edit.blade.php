@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dokumen.css') }}">
@endpush

@section('content')
    <div class="card">
        <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data" class="dokumen-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul">Judul Dokumen</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $dokumen->judul) }}" class="form-control" required>
                @error('judul') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="SK" {{ old('kategori', $dokumen->kategori) === 'SK' ? 'selected' : '' }}>SK</option>
                        <option value="Perbup" {{ old('kategori', $dokumen->kategori) === 'Perbup' ? 'selected' : '' }}>Perbup</option>
                        <option value="Regulasi" {{ old('kategori', $dokumen->kategori) === 'Regulasi' ? 'selected' : '' }}>Regulasi</option>
                        <option value="Panduan" {{ old('kategori', $dokumen->kategori) === 'Panduan' ? 'selected' : '' }}>Panduan</option>
                        <option value="Lainnya" {{ old('kategori', $dokumen->kategori) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal Dokumen</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $dokumen->tanggal?->format('Y-m-d')) }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="file">File Dokumen (kosongkan jika tidak diganti)</label>
                <input type="file" name="file" id="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                @error('file') <span class="form-error">{{ $message }}</span> @enderror
                <small class="dokumen-file-hint">Format: PDF, DOC, DOCX, XLS, XLSX (Maks. 10MB)</small>

                <div class="dokumen-current-file">
                    <i class="fa-solid fa-file"></i>
                    File saat ini:
                    <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank">{{ basename($dokumen->file) }}</a>
                </div>

                <div id="fileNamePreview" class="dokumen-filename-preview" style="display:none;"></div>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi (opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control">{{ old('deskripsi', $dokumen->deskripsi) }}</textarea>
                @error('deskripsi') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="dokumen-form-actions">
                <a href="{{ route('admin.dokumen.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Update Dokumen</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/dokumen.js') }}" defer></script>
@endpush