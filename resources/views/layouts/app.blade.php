<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSRF Token (Wajib untuk Fetch/AJAX JS Laravel) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Company Profile')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/Group 2.svg') }}">
    
    <!-- Font Awesome (ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS Global (semua halaman) -->
    <link rel="stylesheet" href="{{ asset('css/page/components/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/components/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/components/foot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/components/page-header.css') }}">
    
    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.partials.nav')

    {{-- Konten Utama --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    <!-- JS Navbar & Footer -->
    <script src="{{ asset('js/partials/nav.js') }}"></script>
    <script src="{{ asset('js/partials/foot.js') }}"></script>
    
    @stack('scripts')

</body>
</html>