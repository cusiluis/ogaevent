@extends('layouts.app')

@section('title', 'Gestión de Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
<h1>{{ isset($role) ? 'Editar Rol' : 'Crear Rol' }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
</div>

<div class="card-body">
  
    <form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
        @csrf
        @if(isset($role))
            @method('PUT')
        @endif

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $role->nombre ?? '') }}" required>

        <label for="slug">Slug:</label>
        <input type="text" name="slug" value="{{ old('slug', $role->slug ?? '') }}" required>

        <h3>Permisos:</h3>
        @foreach($permisos as $permiso)
            <label>
                <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}"
                    {{ isset($role) && $role->permisos->contains($permiso->id) ? 'checked' : '' }}>
                {{ $permiso->nombre }}
            </label><br>
        @endforeach

        <button type="submit">{{ isset($role) ? 'Actualizar' : 'Guardar' }}</button>
    </form>

</div>
@endsection