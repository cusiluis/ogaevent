{{-- resources/views/invitados/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Invitados')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Invitados</h1>
    <a href="{{ route('invitados.create') }}" class="btn btn-primary">Crear Invitado</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Documento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invitados as $invitado)
            <tr>
                <td>{{ $invitado->nombre }}</td>
                <td>{{ $invitado->email }}</td>
                <td>{{ $invitado->telefono }}</td>
                <td>{{ $invitado->documento_id }}</td>
                <td>
                    <a href="{{ route('invitados.show', $invitado) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('invitados.edit', $invitado) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('invitados.destroy', $invitado) }}" method="POST" class="d-inline">
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

{{ $invitados->links() }}
@endsection