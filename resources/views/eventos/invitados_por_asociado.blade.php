@extends('layouts.app')

@section('content')
<?php //echo "<pre>"; print_r($invitadosEvento) ?>
<div class="container">
    <h3>🎉 Invitados registrados por: {{ $asociado->nombre }} en el evento "{{ $evento->nombre }}"</h3>

    <p><strong>Manillas asignadas:</strong> {{ $pivot->manillas_asignadas }}</p>
    <p><strong>Manillas utilizadas:</strong> {{ $pivot->manillas_utilizadas }}</p>
    <p><strong>Manillas disponibles:</strong> {{ $pivot->manillas_asignadas - $pivot->manillas_utilizadas }}</p>

    <hr>

    <h5>📋 Lista de Invitados Registrados</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invitadosEvento as $eventoInvitado)
                <tr>
                    <td>{{ $eventoInvitado->invitado->nombre }}</td>
                    <td>{{ $eventoInvitado->invitado->telefono }}</td>
                    <td>{{ $eventoInvitado->hora_de_registro->format('d/m/Y H:i') }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay invitados registrados por este asociado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('eventos.show', $evento) }}" class="btn btn-secondary mt-3">⬅️ Volver al evento</a>
</div>
@endsection
