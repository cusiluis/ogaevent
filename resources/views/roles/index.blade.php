@extends('layouts.app')

@section('title', 'Gestión de Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Roles</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-success mb-3">Crear Nuevo Rol</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Slug</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->nombre }}</td>
                <td>{{ $role->slug }}</td>
                <td>
                    @foreach($role->permisos as $permiso)
                        <span>{{ $permiso->nombre }}</span>@if(!$loop->last), @endif
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}">Editar</a>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection