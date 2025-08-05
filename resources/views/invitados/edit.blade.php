@extends('layouts.app')

@section('title', 'Editar Invitado')

@section('content')
<h1>Editar Invitado</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ route('invitados.update', $invitado) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nombre *</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $invitado->nombre) }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $invitado->email) }}">
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $invitado->telefono) }}">
    </div>
    <div class="mb-3">
        <label>Documento de Identidad</label>
        <input type="text" name="documento_id" class="form-control" value="{{ old('documento_id', $invitado->documento_id) }}">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('invitados.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
