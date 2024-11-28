@if (Route::has('login'))
    @auth
        <a href="{{ url('/home') }}" class="btn-home">
            <i class="fas fa-home"></i>
        </a>
    @else
        <a href="{{ route('login') }}" class="btn-login">
            <i class="fas fa-sign-in-alt me-2"></i> {{ __('Iniciar sesión') }}
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn-register">
                <i class="fas fa-user-plus me-2"></i> {{ __('Registrarse') }}
            </a>
        @endif
    @endauth
@endif
