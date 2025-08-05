@extends('layouts.app')

@section('title', 'Gestión de Asociados')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Asociados</h1>
    <a href="{{ route('asociados.create') }}" class="btn btn-primary">Crear Asociado</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Cargo</th>
                <th>Regional</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asociados as $asociado)
            <tr>
                <td>{{ $asociado->id }}</td>
                <td>{{ $asociado->nombre }}</td>
                <td>{{ $asociado->email }}</td>
                <td>{{ $asociado->telefono }}</td>
                <td>{{ $asociado->cargo }}</td>
                <td>{{ $asociado->regional }}</td>
                <td>{{ $asociado->created_at ? date('d/m/Y H:i', strtotime($asociado->created_at)) : 'N/A' }}</td>
                <td>
                    <a href="{{ route('asociados.show', $asociado) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('asociados.edit', $asociado) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('asociados.destroy', $asociado) }}" method="POST" class="d-inline">
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

{{ $asociados->links() }}
@endsection
