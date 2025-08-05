@extends('layouts.app')
@section('content')
<?php //echo "<pre>"; print_r($resumen); ?>
<div class="container">
    <h1>Resumen de Manillas - Evento: {{ $evento->nombre }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre Asociado</th>
                <th>Manillas Asignadas</th>
                <th>Manillas Utilizadas</th>
                <th>Manillas Disponibles</th>
                 <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($evento->asociados as $asociado)
                <tr>
                    <td>{{ $asociado->nombre }}</td>
                    <td>{{ $asociado->pivot->manillas_asignadas }}</td>
                    <td>{{ $asociado->pivot->manillas_utilizadas }}</td>
                    <td>{{ $asociado->pivot->manillas_asignadas - $asociado->pivot->manillas_utilizadas }}</td>
                    <td><a href="{{ route('eventos.invitados.asociado', [$evento->id, $asociado->id]) }}" class="btn btn-sm btn-info">Ver</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection