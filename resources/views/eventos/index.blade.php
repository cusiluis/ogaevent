{{-- resources/views/eventos/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Eventos</h1>
    <a href="{{ route('eventos.create') }}" class="btn btn-primary">Crear Evento</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Ubicación</th>
                <th>Creado por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->nombre }}</td>
                <td>{{ $evento->hora_inicio->format('d/m/Y H:i') }}</td>
                <td>{{ $evento->hora_fin->format('d/m/Y H:i') }}</td>
                <td>{{ $evento->ubicacion }}</td>
                <td>{{ $evento->creador->nombre }}</td>
                <td>
                    <a href="{{ route('eventos.show', $evento) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('eventos.destroy', $evento) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $eventos->links() }}
@endsection