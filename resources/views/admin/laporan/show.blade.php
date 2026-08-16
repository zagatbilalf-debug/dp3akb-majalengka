@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/laporan.css') }}">
@endpush

@section('content')
    <div class="laporan-detail-grid">
        {{-- Detail Laporan --}}
        <div class="card">
            <h3 class="laporan-detail-title">Informasi Pelapor</h3>
            <div class="laporan-info-row">
                <span class="laporan-info-label">Nama</span>
                <span class="laporan-info-value">{{ $laporan->nama_pelapor }}</span>
            </div>
            <div class="laporan-info-row">
                <span class="laporan-info-label">Kontak</span>
                <span class="laporan-info-value">{{ $laporan->kontak_pelapor }}</span>
            </div>
            <div class="laporan-info-row">
                <span class="laporan-info-label">Tanggal Lapor</span>
                <span class="laporan-info-value">{{ $laporan->tanggal_lapor?->translatedFormat('d M Y, H:i') }}</span>
            </div>

            <hr class="laporan-divider">

            <h3 class="laporan-detail-title">Detail Laporan</h3>
            <div class="laporan-info-row">
                <span class="laporan-info-label">Judul</span>
                <span class="laporan-info-value">{{ $laporan->judul }}</span>
            </div>
            <div class="laporan-info-row">
                <span class="laporan-info-label">Kategori</span>
                <span class="laporan-info-value">{{ $laporan->kategori ?? '-' }}</span>
            </div>
            <div class="laporan-info-row">
                <span class="laporan-info-label">Lokasi</span>
                <span class="laporan-info-value">{{ $laporan->lokasi ?? '-' }}</span>
            </div>
            <div class="laporan-info-row laporan-info-row-block">
                <span class="laporan-info-label">Isi Laporan</span>
                <p class="laporan-info-text">{{ $laporan->isi_laporan }}</p>
            </div>

           @if($laporan->lampiran)
    @php
        $ext = strtolower(pathinfo($laporan->lampiran, PATHINFO_EXTENSION));
        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
        $lampiranUrl = asset('storage/' . $laporan->lampiran);
    @endphp
    <div class="laporan-info-row">
        <span class="laporan-info-label">Lampiran</span>
        @if($isImage)
            <a href="#" class="laporan-attachment-link" onclick="openLampiranModal('{{ $lampiranUrl }}'); return false;">
                <i class="fa-solid fa-image"></i> Lihat Lampiran
            </a>
        @else
            <a href="{{ $lampiranUrl }}" target="_blank" class="laporan-attachment-link">
                <i class="fa-solid fa-paperclip"></i> Lihat Lampiran
            </a>
        @endif
    </div>
@endif
        </div>

        {{-- Form Tanggapan --}}
        <div class="card">
            <h3 class="laporan-detail-title">Tindak Lanjut</h3>
            <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" class="laporan-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="status">Status Laporan</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="baru" {{ $laporan->status === 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="diproses" {{ $laporan->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $laporan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggapan">Tanggapan</label>
                    <textarea name="tanggapan" id="tanggapan" rows="6" class="form-control" placeholder="Tulis tanggapan untuk pelapor...">{{ old('tanggapan', $laporan->tanggapan) }}</textarea>
                </div>

                <div class="laporan-form-actions">
                    <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Tanggapan</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Modal Preview Lampiran --}}
    <div id="lampiranModal" class="lampiran-modal">
        <div class="lampiran-modal-overlay" onclick="closeLampiranModal()"></div>
        <div class="lampiran-modal-content">
            <button type="button" class="lampiran-modal-close" onclick="closeLampiranModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <img id="lampiranModalImage" src="" alt="Lampiran Laporan">
            <a id="lampiranModalDownload" href="" target="_blank" class="lampiran-modal-download">
                <i class="fa-solid fa-up-right-from-square"></i> Buka di Tab Baru
            </a>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function openLampiranModal(url) {
            document.getElementById('lampiranModalImage').src = url;
            document.getElementById('lampiranModalDownload').href = url;
            document.getElementById('lampiranModal').classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeLampiranModal() {
            document.getElementById('lampiranModal').classList.remove('is-open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeLampiranModal();
            }
        });
    </script>
@endpush