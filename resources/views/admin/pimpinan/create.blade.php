@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/pimpinan.css') }}">
@endpush

@section('content')
    <div class="card">
        <form action="{{ route('admin.pimpinan.store') }}" method="POST" enctype="multipart/form-data" class="pimpinan-form">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" required>
                @error('nama') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nip">NIP (opsional)</label>
                    <input type="text" name="nip" id="nip" value="{{ old('nip') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" class="form-control" required>
                    @error('jabatan') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Utama" {{ old('kategori') === 'Utama' ? 'selected' : '' }}>Utama</option>
                        <option value="Sekretariat" {{ old('kategori') === 'Sekretariat' ? 'selected' : '' }}>Sekretariat</option>
                        <option value="Kepala Bidang" {{ old('kategori') === 'Kepala Bidang' ? 'selected' : '' }}>Kepala Bidang</option>
                        <option value="UPTD" {{ old('kategori') === 'UPTD' ? 'selected' : '' }}>UPTD</option>
                    </select>
                    @error('kategori') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
                @error('foto') <span class="form-error">{{ $message }}</span> @enderror
                <img id="previewFoto" class="pimpinan-preview-img" style="display:none;">
            </div>

            <div class="pimpinan-form-actions">
                <a href="{{ route('admin.pimpinan.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/pimpinan.js') }}" defer></script>
@endpush