@extends('layouts.app')
@section('content')
<?php //print_r($invitadosPorAsociado) ?>
<div class="container">
    <h1>Resumen de Manillas - Evento: {{ $evento->nombre }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre Asociado</th>
                <th>Manillas Asignadas</th>
                <th>Manillas Utilizadas</th>
                <th>Manillas Disponibles</th>
                <th>Invitados</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evento->asociados as $asociado)
                <tr>
                    <td>{{ $asociado->nombre }}</td>
                    <td>{{ $asociado->pivot->manillas_asignadas }}</td>
                    <td>{{ $asociado->pivot->manillas_utilizadas }}</td>
                    <td>{{ $asociado->pivot->manillas_asignadas - $asociado->pivot->manillas_utilizadas }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#invitados-{{ $asociado->id }}">
                            Ver
                        </button>
                    </td>
                </tr>
                <tr class="collapse" id="invitados-{{ $asociado->id }}">
                    <td colspan="5">
     

                        @if(isset($invitadosPorAsociado[$asociado->id]) && count($invitadosPorAsociado[$asociado->id]) > 0)
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Fecha Registro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invitadosPorAsociado[$asociado->id] as $eventoInvitado)
                                            <tr>
                                                <td>{{ $eventoInvitado->invitado->nombre }}</td>
                                                <td>{{ $eventoInvitado->invitado->telefono }}</td>
                                                <td>{{ $eventoInvitado->hora_de_registro->format('d/m/Y H:i') }}</td>

                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                        @else
                            <em>No hay invitados registrados por este asociado.</em>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
