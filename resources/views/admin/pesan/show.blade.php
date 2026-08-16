@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/pesan.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="pesan-detail-header">
            <div>
                <h3 class="pesan-detail-subjek">{{ $pesan->subjek }}</h3>
                <span class="pesan-detail-meta">
                    Dari <strong>{{ $pesan->nama }}</strong> ({{ $pesan->email }})
                    &middot; {{ $pesan->created_at->translatedFormat('d M Y, H:i') }} WIB
                </span>
            </div>
            <a href="mailto:{{ $pesan->email }}?subject=RE: {{ $pesan->subjek }}" class="btn btn-primary">
                <i class="fa-solid fa-reply"></i> Balas via Email
            </a>
        </div>

        <hr class="pesan-divider">

        <div class="pesan-isi">
            {{ $pesan->pesan }}
        </div>

        <div class="pesan-form-actions">
            <a href="{{ route('admin.pesan.index') }}" class="btn btn-outline">Kembali</a>
          <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" class="js-delete-form" data-item-name="pesan &quot;{{ $pesan->subjek }}&quot;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
        </div>
    </div>
@endsection