{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" 
               id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" 
               id="password" name="password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Recordarme</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
    
    <div class="text-center mt-3">
        <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a>
    </div>
</form>
@endsection