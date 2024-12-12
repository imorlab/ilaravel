<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Social Media Meta Tags -->
    <meta property="og:title" content="{{ config('app.name', 'iLaravel') }}">
    <meta property="og:description" content="Herramientas para desarrolladores">
    <meta property="og:image" content="{{ asset('img/laravel_hero.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ config('app.name', 'iLaravel') }}">
    <meta name="twitter:description" content="Herramientas para desarrolladores">
    <meta name="twitter:image" content="{{ asset('img/laravel_hero.png') }}">

    <title>{{ config('app.name', 'iLaravel') }}</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/laravel_96.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/laravel_96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/laravel_96.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/laravel_96.png') }}">
    <link rel="shortcut icon" href="{{ asset('img/laravel_96.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js',
        'resources/js/card-effects.js'
    ])

    <!-- Scripts -->
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div id="app" class="min-vh-100">
        <x-notch-nav />
        <div class="preload" id="preloader">
            <div class="preloader-inner">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="background-shapes">
            <div class="cube-shape cube-1">
                <svg x-data="{ animate: false }" x-init="setTimeout(() => animate = true, 0)" :class="{ 'animate-cube': animate }" class="text-primary" width="46" height="53" viewBox="0 0 46 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="m23.102 1 22.1 12.704v25.404M23.101 1l-22.1 12.704v25.404" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel"></path>
                    <path d="m45.202 39.105-22.1 12.702L1 39.105" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel"></path>
                    <path transform="matrix(.86698 .49834 .00003 1 1 13.699)" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel" d="M0 0h25.491v25.405H0z"></path>
                    <path transform="matrix(.86698 -.49834 -.00003 1 23.102 26.402)" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel" d="M0 0h25.491v25.405H0z"></path>
                    <path transform="matrix(.86701 -.49829 .86701 .49829 1 13.702)" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel" d="M0 0h25.491v25.491H0z"></path>
                </svg>
            </div>
            <div class="cube-shape cube-2">
                <svg x-data="{ animate: false }" x-init="setTimeout(() => animate = true, 1000)" :class="{ 'animate-cube': animate }" class="text-primary" width="46" height="53" viewBox="0 0 46 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="m23.102 1 22.1 12.704v25.404M23.101 1l-22.1 12.704v25.404" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel"></path>
                    <path d="m45.202 39.105-22.1 12.702L1 39.105" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel"></path>
                    <path transform="matrix(.86698 .49834 .00003 1 1 13.699)" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel" d="M0 0h25.491v25.405H0z"></path>
                    <path transform="matrix(.86698 -.49834 -.00003 1 23.102 26.402)" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel" d="M0 0h25.491v25.405H0z"></path>
                    <path transform="matrix(.86701 -.49829 .86701 .49829 1 13.702)" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel" d="M0 0h25.491v25.491H0z"></path>
                </svg>
            </div>
            <div class="cube-shape cube-3">
                <svg x-data="{ animate: false }" x-init="setTimeout(() => animate = true, 2000)" :class="{ 'animate-cube': animate }" class="text-primary" width="46" height="53" viewBox="0 0 46 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="m23.102 1 22.1 12.704v25.404M23.101 1l-22.1 12.704v25.404" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel"></path>
                    <path d="m45.202 39.105-22.1 12.702L1 39.105" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel"></path>
                    <path transform="matrix(.86698 .49834 .00003 1 1 13.699)" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel" d="M0 0h25.491v25.405H0z"></path>
                    <path transform="matrix(.86698 -.49834 -.00003 1 23.102 26.402)" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel" d="M0 0h25.491v25.405H0z"></path>
                    <path transform="matrix(.86701 -.49829 .86701 .49829 1 13.702)" stroke="currentColor" stroke-width="1.435" stroke-linejoin="bevel" d="M0 0h25.491v25.491H0z"></path>
                </svg>
            </div>
        </div>

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            {{-- @include('layouts.navigation') --}}
            <x-auth-button />

            <main>
                @yield('content')
            </main>

            <!-- @if(Route::currentRouteName() !== '/')
                <x-footer-nav />
            @endif -->

            <!-- Sidebar Component -->
            <livewire:sidebar />

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @livewireScripts
    @stack('scripts')
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('preloader').style.display = 'none';
            }, 500);
        });

        // Prevenir múltiples inicializaciones
        if (typeof window.livewireInitialized === 'undefined') {
            window.livewireInitialized = false;
        }

        document.addEventListener('livewire:initialized', () => {
            if (!window.livewireInitialized) {
                window.livewireInitialized = true;
                // Inicializar componentes de Bootstrap
                const accordionElements = document.querySelectorAll('.accordion-collapse');
                accordionElements.forEach(element => {
                    new bootstrap.Collapse(element, {
                        toggle: false
                    });
                });

                const tabElements = document.querySelectorAll('[data-bs-toggle="tab"]');
                tabElements.forEach(element => {
                    new bootstrap.Tab(element);
                });
            }
        });
    </script>
</body>
</html>
