@extends('layouts.app')

@section('title', 'Crear Evento')

@section('content')
<h1>Crear Evento</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>¡Error!</strong> Por favor corrige los errores e intenta nuevamente.
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('eventos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre *</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora de Inicio *</label>
        <input type="datetime-local" name="hora_inicio" class="form-control" value="{{ old('hora_inicio') }}" required>
    </div>

    <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora de Fin *</label>
        <input type="datetime-local" name="hora_fin" class="form-control" value="{{ old('hora_fin') }}" required>
    </div>

    <div class="mb-3">
        <label for="ubicacion" class="form-label">Ubicación</label>
        <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}">
    </div>

    <div class="mb-3">
        <label for="total_manillas" class="form-label">Total manillas</label>
        <input type="number" name="total_manillas" min="10" class="form-control" value="{{ old('total_manillas') }}">
    </div>    

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
