@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/partials/pengaturan.css') }}">

<div class="pengaturan-wrapper">
    <div class="page-title-row">
        <h1>Pengaturan</h1>
        <p>Kelola pengaturan akun admin kamu di sini.</p>
    </div>

    <div class="pengaturan-grid">
        <a href="{{ route('admin.pengaturan.ubah-password') }}" class="pengaturan-card">
            <div class="pengaturan-card-icon">
                <i class="fa-solid fa-key"></i>
            </div>
            <div class="pengaturan-card-text">
                <h3>Ubah Password</h3>
                <p>Perbarui password akun admin kamu secara berkala.</p>
            </div>
            <i class="fa-solid fa-chevron-right pengaturan-card-arrow"></i>
        </a>

        {{-- Opsi pengaturan lain bisa ditambahkan di sini nanti --}}
    </div>
</div>
@endsection