@extends('layouts.app')

@section('title', 'Nuevo Invitado')

@section('content')
<h1>Nuevo Invitado</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ route('invitados.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nombre *</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
    </div>
    <div class="mb-3">
        <label>Documento de Identidad</label>
        <input type="text" name="documento_id" class="form-control" value="{{ old('documento_id') }}">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('invitados.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
