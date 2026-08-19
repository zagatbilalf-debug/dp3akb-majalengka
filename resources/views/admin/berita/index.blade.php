@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}">
@endpush

@php
    // Bangun URL sort: klik kolom yang lagi non-aktif -> asc,
    // klik kolom yang lagi aktif -> kebalikan arah sekarang.
    $sortUrl = function (string $column) {
        $nextDirection = (request('sort') === $column && request('direction', 'asc') === 'asc')
            ? 'desc'
            : 'asc';

        return request()->fullUrlWithQuery([
            'sort' => $column,
            'direction' => $nextDirection,
            'page' => null,
        ]);
    };

    // Icon panah: netral (fa-sort) kalau kolom ini belum jadi acuan sort,
    // fa-sort-up/fa-sort-down kalau kolom ini yang lagi aktif.
    $sortIconClass = function (string $column) {
        if (request('sort') !== $column) {
            return 'fa-sort';
        }

        return request('direction', 'asc') === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
    };
@endphp

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>
                            <a href="{{ $sortUrl('judul') }}" class="sort-link @if(request('sort') === 'judul') is-active @endif">
                                Judul
                                <i class="fa-solid {{ $sortIconClass('judul') }} sort-icon"></i>
                            </a>
                        </th>
                        <th>Kategori</th>
                        <th>
                            <a href="{{ $sortUrl('status') }}" class="sort-link @if(request('sort') === 'status') is-active @endif">
                                Status
                                <i class="fa-solid {{ $sortIconClass('status') }} sort-icon"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ $sortUrl('tanggal_terbit') }}" class="sort-link @if(request('sort') === 'tanggal_terbit') is-active @endif">
                                Tanggal Terbit
                                <i class="fa-solid {{ $sortIconClass('tanggal_terbit') }} sort-icon"></i>
                            </a>
                        </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $berita)
                        <tr>
                            <td>
                                @if($berita->gambar)
                                    <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" class="berita-thumb">
                                @else
                                    <div class="berita-thumb berita-thumb-empty">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $berita->judul }}</td>
                            <td>{{ $berita->kategori ?? '-' }}</td>
                            <td>
                                @if($berita->status === 'publish')
                                    <span class="badge badge-success">Publish</span>
                                @else
                                    <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                            <td>{{ $berita->tanggal_terbit ? \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d M Y') : '-' }}</td>
                            <td>
                                <div class="berita-actions">
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="js-delete-form" data-item-name="berita &quot;{{ $berita->judul }}&quot;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 30px 0; color:#9ca3af;">
                                Belum ada berita.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="berita-pagination">
            {{ $beritas->links() }}
        </div>
    </div>
@endsection