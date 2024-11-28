@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('/img/laravel_96.png') }}" alt="Logo" class="img-fluid mb-4" style="width: 96px;">
                </a>
            </div>
            <div class="card auth-card bg-glass border-0 shadow-lg animate__animated animate__fadeIn">
                <div class="card-body p-4">
                    <h4 class="text-center text-white mb-4">{{ __('Iniciar sesión') }}</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input id="email" type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" 
                                       required autocomplete="email" autofocus
                                       placeholder="Email">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password"
                                       placeholder="Contraseña">
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-white" for="remember">
                                    {{ __('Recordarme') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="ibtn">
                                {{ __('Iniciar sesión') }}
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-white-50">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div>

                        @if (Route::has('register'))
                            <div class="text-center mt-3">
                                <span class="text-white-50">¿No tienes cuenta?</span>
                                <a href="{{ route('register') }}" class="text-white ms-1">
                                    {{ __('Regístrate') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
