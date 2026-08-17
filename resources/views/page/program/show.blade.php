@extends('layouts.app')

@section('title', $program->nama_program . ' - DP3AKB Jawa Barat')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page/program/show.css') }}">
@endpush

@section('content')
<div class="program-show-wrapper">

    @include('layouts.partials.page-header', [
        'title' => $program->nama_program,
        'subtitle' => Str::limit($program->deskripsi, 120),
       'bgImage' => $program->gambar
    ? (str_starts_with($program->gambar, 'http') ? $program->gambar : asset('storage/'.$program->gambar))
    : asset('assets/images/gedung-sate.jpg')
    ])

    <div class="program-show-content">

        @if($program->gambar)
            <img src="{{ str_starts_with($program->gambar, 'http') ? $program->gambar : asset('storage/'.$program->gambar) }}"
                 alt="{{ $program->nama_program }}"
                 class="program-show-image">
        @endif

        <div class="program-show-body">
            {!! nl2br(e($program->deskripsi)) !!}
        </div>

        @if($program->link)
            <a href="{{ $program->link }}" target="_blank" rel="noopener" class="program-show-link-btn">
                Kunjungi Link Terkait &rarr;
            </a>
        @endif
    </div>

</div>
@endsection