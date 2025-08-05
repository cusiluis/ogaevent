@extends('layouts.app')

@section('title', 'Gestion de Codigos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Codigos</h1>
    <a href="{{ route('codigos.create') }}" class="btn btn-primary">Crear nuevo código</a>
</div>


<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Tipo</th>
                <th>Evento</th>
                <th>Asignado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($codigos as $codigo)
            <tr>
                <td>{{ $codigo->id }}</td>
                <td>{{ $codigo->codigo }}</td>
                <td>{{ $codigo->tipo }}</td>
                <td>{{ $codigo->evento->nombre }}</td>
                <td>{{ $codigo->asignado ? 'Sí' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>    
@endsection
