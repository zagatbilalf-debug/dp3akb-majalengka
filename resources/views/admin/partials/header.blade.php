<link rel="stylesheet" href="{{ asset('css/admin/partials/header.css') }}">

<div class="page-header">
    <div class="page-header-left">
        <h1 class="page-title">{{ $title ?? 'Judul Halaman' }}</h1>

        @if(isset($breadcrumbs))
            <nav class="page-breadcrumb" aria-label="breadcrumb">
                <ol>
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-house"></i>
                        </a>
                    </li>
                    @foreach($breadcrumbs as $label => $url)
                        @if(!$loop->last)
                            <li>
                                <a href="{{ $url }}">{{ $label }}</a>
                            </li>
                        @else
                            <li class="active" aria-current="page">{{ $label }}</li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif
    </div>

    @if(isset($actionLabel) && isset($actionRoute))
        <div class="page-header-right">
            <a href="{{ $actionRoute }}" class="page-header-btn">
                <i class="fa-solid fa-plus"></i>
                <span>{{ $actionLabel }}</span>
            </a>
        </div>
    @endif
</div>

<script src="{{ asset('js/admin/partials/header.js') }}" defer></script>