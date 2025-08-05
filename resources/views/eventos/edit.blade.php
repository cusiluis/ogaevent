@extends('layouts.app')

@section('title', 'Editar Evento')

@section('content')
<h1>Editar Evento</h1>

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

<form action="{{ route('eventos.update', $evento) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre *</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $evento->nombre) }}" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control">{{ old('descripcion', $evento->descripcion) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora de Inicio *</label>
        <input type="datetime-local" name="hora_inicio" class="form-control" value="{{ old('hora_inicio', $evento->hora_inicio->format('Y-m-d\TH:i')) }}" required>
    </div>

    <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora de Fin *</label>
        <input type="datetime-local" name="hora_fin" class="form-control" value="{{ old('hora_fin', $evento->hora_fin->format('Y-m-d\TH:i')) }}" required>
    </div>

    <div class="mb-3">
        <label for="ubicacion" class="form-label">Ubicación</label>
        <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion', $evento->ubicacion) }}">
    </div>

   <div class="mb-3">
        <label for="total_manillas" class="form-label">Total manillas</label>
        <input type="number" name="total_manillas" min="10" class="form-control" value="{{ old('total_manillas', $evento->total_manillas) }}">
    </div>  

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
