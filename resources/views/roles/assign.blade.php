@extends('layouts.app')

@section('title', 'Gestión de Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Asignar Rol a Usuario</h1>
</div>

<div class="card-body">
  
    <form action="{{ route('roles.assign') }}" method="POST">
        @csrf

        <label for="user_id">Usuario:</label>
        <select name="user_id" required>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
            @endforeach
        </select>

        <h3>Roles:</h3>
        @foreach($roles as $role)
            <label>
                <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                {{ $role->nombre }}
            </label><br>
        @endforeach

        <button type="submit">Asignar</button>
    </form>   

</div>


<div class="card-body">

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