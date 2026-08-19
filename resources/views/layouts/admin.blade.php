<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} | DP3AKB Kab. Majalengka</title>

    <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{ asset('assets/images/logo3.png') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS Global -->
    <link rel="stylesheet" href="{{ asset('css/admin/partials/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/confirm-modal.css') }}">

    @stack('styles')
</head>
<body>

    {{-- ===== Sidebar ===== --}}
    @include('admin.partials.sidebar')

    {{-- ===== Wrapper konten utama ===== --}}
    <div class="main-content" id="mainContent">
        {{-- ===== Judul halaman + breadcrumb ===== --}}
        @include('admin.partials.header', [
            'title' => $title ?? 'Judul Halaman',
            'breadcrumbs' => $breadcrumbs ?? null,
            'actionLabel' => $actionLabel ?? null,
            'actionRoute' => $actionRoute ?? null,
        ])

        {{-- ===== Notifikasi flash message ===== --}}
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="alert-close">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error" role="alert">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                    <button type="button" class="alert-close">&times;</button>
                </div>
            @endif

            {{-- ===== Konten setiap halaman ditaruh di sini ===== --}}
            @yield('content')
        </div>
    </div>

    {{-- ===== Modal Konfirmasi Hapus (Global) ===== --}}
    @include('admin.partials.confirm-delete-modal')

    <!-- JS Global -->
    <script src="{{ asset('js/admin/main.js') }}" defer></script>
    <script src="{{ asset('js/admin/confirm-modal.js') }}" defer></script>

    @stack('scripts')
</body>
</html>