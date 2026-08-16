@extends('layouts.app')

@section('title', 'Form Laporan Masyarakat - DP3AKB Kab. Majalengka')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/layanan/pengaduan.css') }}">
@endpush

@section('content')
<div class="pengaduan-page-wrapper">

    @include('layouts.partials.page-header', [
        'title' => 'Form Laporan Masyarakat',
        'subtitle' => 'Sampaikan laporan, keluhan, atau masukan Anda terkait pelayanan publik. Kami akan menindaklanjuti laporan Anda.',    ])

    <div class="container-custom">
        <div class="form-card-container">

            @if(session('success'))
                <div class="alert-box alert-box-success" style="display: block;">
                    {{ session('success') }}
                </div>
            @endif

            <form id="laporanForm" class="pengaduan-form" action="{{ route('layanan.form-laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h3 class="form-section-title">1. Informasi Pelapor</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nama_pelapor">Nama Lengkap</label>
                        <input type="text" id="nama_pelapor" name="nama_pelapor" class="form-control" placeholder="Masukkan nama Anda" value="{{ old('nama_pelapor') }}" required>
                        @error('nama_pelapor') <small class="form-text form-text-error">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kontak_pelapor">Nomor Telepon / Email</label>
                        <input type="text" id="kontak_pelapor" name="kontak_pelapor" class="form-control" placeholder="08xxxxxxxxxx atau email" value="{{ old('kontak_pelapor') }}" required>
                        @error('kontak_pelapor') <small class="form-text form-text-error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <h3 class="form-section-title">2. Detail Laporan</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="judul">Judul Laporan</label>
                        <input type="text" id="judul" name="judul" class="form-control" placeholder="Ringkasan singkat laporan Anda" value="{{ old('judul') }}" required>
                        @error('judul') <small class="form-text form-text-error">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori Laporan</label>
                        <select id="kategori" name="kategori" class="form-control">
                            <option value="">Pilih Kategori (Opsional)</option>
                            <option value="Pelayanan Publik" {{ old('kategori') === 'Pelayanan Publik' ? 'selected' : '' }}>Pelayanan Publik</option>
                            <option value="Infrastruktur" {{ old('kategori') === 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                            <option value="Sosial" {{ old('kategori') === 'Sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="Lainnya" {{ old('kategori') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi Terkait (Opsional)</label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Contoh: Jl. Merdeka No. 10, Majalengka" value="{{ old('lokasi') }}">
                </div>

                <div class="form-group">
                    <label for="isi_laporan">Isi Laporan</label>
                    <textarea id="isi_laporan" name="isi_laporan" rows="5" class="form-control" placeholder="Jelaskan laporan Anda secara detail..." required>{{ old('isi_laporan') }}</textarea>
                    @error('isi_laporan') <small class="form-text form-text-error">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="lampiran">Unggah Lampiran (Opsional - Foto/Dokumen)</label>
                    <input type="file" id="lampiran" name="lampiran" class="form-control-file">
                    <small class="form-text">Format: JPG, PNG, PDF (Maks. 5MB)</small>
                    @error('lampiran') <small class="form-text form-text-error">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn-submit-pengaduan">Kirim Laporan</button>
            </form>

            <div id="alertBox" class="alert-box" style="display: none;"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/layanan/pengaduan.js') }}"></script>
@endpush