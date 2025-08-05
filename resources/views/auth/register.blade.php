{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.auth')

@section('title', 'Registrarse')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre Completo</label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
               id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

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

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
        <input type="password" class="form-control" 
               id="password_confirmation" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Registrarse</button>
    
    <div class="text-center mt-3">
        <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</form>
@endsection