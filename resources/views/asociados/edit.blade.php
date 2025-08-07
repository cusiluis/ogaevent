@extends('layouts.app')

@section('title', 'Editar Asociado')

@section('content')
<div class="container">
    <h1>Editar Asociado</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asociados.update', $asociado) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" name="nombre" class="form-control" required value="{{ old('nombre', $asociado->nombre) }}">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $asociado->telefono) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', $asociado->email) }}">
        </div>

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" name="cargo" class="form-control" value="{{ old('cargo', $asociado->cargo) }}">
        </div>

        <div class="mb-3">
            <label for="regional" class="form-label">Regional *</label>
            <input type="text" name="regional" class="form-control" required value="{{ old('regional', $asociado->regional) }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password *</label>
            <input type="text" name="password" class="form-control" required value="{{ old('password', $asociado->password) }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('asociados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
