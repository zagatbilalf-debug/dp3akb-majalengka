@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/partials/ganti-password.css') }}">

<div class="ganti-password-wrapper">
    <div class="page-title-row">
        <h1>Ganti Password</h1>
        <p>Ubah password akun admin kamu secara berkala untuk menjaga keamanan.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="ganti-password-card">
        <form method="POST" action="{{ route('admin.ganti-password.update') }}" id="gantiPasswordForm">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password">Password Saat Ini</label>
                <div class="input-with-icon">
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        placeholder="Masukkan password saat ini"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="toggle-password" data-target="current_password" aria-label="Tampilkan password">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <div class="input-with-icon">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        required
                        minlength="8"
                        autocomplete="new-password"
                    >
                    <button type="button" class="toggle-password" data-target="password" aria-label="Tampilkan password">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <div class="input-with-icon">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password baru"
                        required
                        minlength="8"
                        autocomplete="new-password"
                    >
                    <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Tampilkan password">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <small class="field-hint" id="matchHint"></small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Simpan Password Baru</button>
                <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/admin/partials/ganti-password.js') }}" defer></script>
@endsection