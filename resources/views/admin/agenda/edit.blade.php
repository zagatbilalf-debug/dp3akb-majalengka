@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/agenda.css') }}">
@endpush

@section('content')
    <div class="card">
        <form action="{{ route('admin.agenda.update', $agenda->id) }}" method="POST" class="agenda-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', $agenda->nama_kegiatan) }}" class="form-control" required>
                @error('nama_kegiatan') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $agenda->tanggal->format('Y-m-d')) }}" class="form-control" required>
                    @error('tanggal') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $agenda->lokasi) }}" class="form-control" required>
                    @error('lokasi') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="6" class="form-control">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                @error('deskripsi') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="agenda-form-actions">
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Update Agenda</button>
            </div>
        </form>
    </div>
@endsection