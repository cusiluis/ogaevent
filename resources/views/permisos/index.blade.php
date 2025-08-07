@extends('layouts.app')

@section('title', 'Gestión de Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Permisos</h1>
 
</div>

<div class="table-responsive">
 
    <form action="{{ route('permisos.store') }}" method="POST">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre del permiso" required>
        <input type="text" name="slug" placeholder="Slug" required>
        <button type="submit">Crear Permiso</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Slug</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permisos as $permiso)
            <tr>
                <td>{{ $permiso->nombre }}</td>
                <td>{{ $permiso->slug }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection