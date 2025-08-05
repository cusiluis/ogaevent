{{-- resources/views/usuarios/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Crear Usuario</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                    <span class="badge bg-{{ $usuario->rol === 'admin' ? 'danger' : 'primary' }}">
                        {{ ucfirst($usuario->rol) }}
                    </span>
                </td>
                <td>{{ $usuario->created_at ? date('d/m/Y H:i', strtotime($usuario->created_at)) : 'N/A' }}</td>
                <td>
                    <a href="{{ route('usuarios.show', $usuario) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning">Editar</a>
                    @if($usuario->id !== auth()->id())
                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $usuarios->links() }}
@endsection