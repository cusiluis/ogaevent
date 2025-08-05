@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Asignar Manillas - Evento: {{ $evento->nombre }}</h1>
    <form action="{{ route('asignaciones.store') }}" method="POST">
        @csrf
        <input type="hidden" name="evento_id" value="{{ $evento->id }}">
        <div class="mb-3">
            <label class="form-label">Asociado</label>
            <select name="asociado_id" class="form-control" required>
                 <option value="">---</option>
                @foreach($asociados as $asociado)
                    <option value="{{ $asociado->id }}">{{ $asociado->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Manillas a Asignar</label>
            <input type="number" name="manillas_asignadas" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Asignar</button>
    </form>
</div>
@endsection