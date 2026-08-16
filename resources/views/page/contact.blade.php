@extends('layouts.app')

@section('title', 'Kontak Kami - DP3AKB Jawa Barat')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/contact.css') }}">
@endpush

@section('content')
<div class="kontak-page-wrapper">

    {{-- Memanggil Header Partials --}}
    @include('layouts.partials.page-header', [
        'title' => 'Kontak Kami',
        'subtitle' => 'Hubungi instansi melalui informasi di bawah atau kirimkan pesan/pengaduan secara langsung.',
    ])

    <div class="container-custom">
        <div class="kontak-layout">
            
            {{-- Bagian Informasi Kontak & Alamat --}}
            <div class="kontak-info-area">
                <h2 class="section-heading">Informasi Instansi</h2>
                <p class="section-desc">Silakan kunjungi kantor kami atau hubungi melalui saluran komunikasi resmi berikut.</p>
                
                <div class="info-cards-grid">
                    <div class="info-card">
                        <div class="icon-box"><i class="fa-solid fa-location-dot"></i></div>
                        <h4>Alamat Kantor</h4>
                        <p>Jl. Turangga No.25, Lengkong, Kec. Lengkong, Kota Bandung, Jawa Barat 40264</p>
                    </div>
                    <div class="info-card">
                        <div class="icon-box"><i class="fa-solid fa-phone"></i></div>
                        <h4>Telepon / Fax</h4>
                        <p>(022) 7301234 / (022) 7305678</p>
                    </div>
                    <div class="info-card">
                        <div class="icon-box"><i class="fa-solid fa-envelope"></i></div>
                        <h4>Email Resmi</h4>
                        <p>dp3akb@jabarprov.go.id</p>
                    </div>
                    <div class="info-card">
                        <div class="icon-box"><i class="fa-solid fa-clock"></i></div>
                        <h4>Jam Operasional</h4>
                        <p>Senin - Jumat: 08:00 - 16:00 WIB</p>
                    </div>
                </div>
            </div>

            {{-- Bagian Form Kontak --}}
            <div class="kontak-form-area">
                <h2 class="section-heading">Kirim Pesan</h2>
                <p class="section-desc">Punya pertanyaan atau pengaduan? Isi formulir di bawah ini.</p>

                @if(session('success'))
                    <div class="form-alert form-alert-success" style="display: block;">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="contactForm" class="contact-form" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                        @error('name') <small class="form-text form-text-error">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
                        @error('email') <small class="form-text form-text-error">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Subjek Pesan</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Perihal pesan Anda" value="{{ old('subject') }}" required>
                        @error('subject') <small class="form-text form-text-error">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Pesan / Pengaduan</label>
                        <textarea id="message" name="message" rows="5" class="form-control" placeholder="Tuliskan pesan Anda secara detail..." required>{{ old('message') }}</textarea>
                        @error('message') <small class="form-text form-text-error">{{ $message }}</small> @enderror
                    </div>
                    <button type="submit" class="btn-submit">Kirim Pesan</button>
                </form>
                
                <div id="formAlert" class="form-alert" style="display: none;"></div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/contact.js') }}"></script>
@endpush