@extends('layouts.app')

@section('title', 'Invitados')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Invitados registrados: {{ $evento->nombre }}</h1>
</div>
<div class="d-flex justify-content-between align-items-center mb-4">
        <p><strong>Fecha:</strong> {{ $evento->hora_inicio }}</p>
        <p><strong>Total de manillas:</strong> {{ $evento->total_manillas }}</p>
        <p><strong>Total registrados:</strong> {{ $evento->invitados->count() }}</p>

</div>
<?php //echo "<pre>"; print_r($evento); ?>
<div class="table-responsive">
    @if ($evento->invitados->isEmpty())
        <p>No hay invitados registrados.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre Invitado</th>
                    <th>Teléfono</th>
                    <th>Invitado por (Asociado)</th>
                    <th>Hora de Registro</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($evento->invitados as $index => $ei)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ei->invitado->nombre }}</td>
                    <td>{{ $ei->invitado->telefono }}</td>
                    <td>{{ $ei->asociado?->nombre ?? 'N/D' }}</td>
                    <td>{{ $ei->hora_de_registro }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
   
</div>

@endsection