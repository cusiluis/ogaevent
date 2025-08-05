@extends('layouts.app')

@section('title', 'Ver Usuario')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detalle del Usuario</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre Completo</label>
                    <div class="form-control-plaintext">{{ $usuario->nombre }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Correo Electrónico</label>
                    <div class="form-control-plaintext">{{ $usuario->email }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Rol</label>
                    <div class="form-control-plaintext text-capitalize">{{ $usuario->rol }}</div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver a la lista</a>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary">Editar Usuario</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
