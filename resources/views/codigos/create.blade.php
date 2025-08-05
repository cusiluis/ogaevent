@extends('layouts.app')

@section('title', 'Crear Codigo')

@section('content')
<div class="container">
    <h2>Crear Código</h2>
    <form action="{{ route('codigos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="codigo" class="form-label">Código:</label>
            <input type="text" name="codigo"  class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo:</label>
            <select name="tipo" class="form-control">
                <option value="qr">QR</option>
                <option value="barra">Barras</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="evento_id" class="form-label">Evento:</label>
            <select name="evento_id" class="form-control">
                @foreach($eventos as $evento)
                <option value="{{ $evento->id }}">{{ $evento->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_generacion" class="form-label">Fecha de Generación:</label>
            <input type="date" name="fecha_generacion" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>    
@endsection
