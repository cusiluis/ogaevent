@extends('layouts.app')

@section('title', 'Detalle del Evento')

@section('content')

<h1>{{ $evento->nombre }}</h1>

<p><strong>Descripción:</strong> {{ $evento->descripcion ?? 'N/A' }}</p>
<p><strong>Inicio:</strong> {{ $evento->hora_inicio->format('d/m/Y H:i') }}</p>
<p><strong>Fin:</strong> {{ $evento->hora_fin->format('d/m/Y H:i') }}</p>
<p><strong>Ubicación:</strong> {{ $evento->ubicacion ?? 'N/A' }}</p>
<p><strong>Creado por:</strong> {{ $evento->creador->nombre }}</p>
<p><strong>Total manillas:</strong> {{ $evento->total_manillas }}</p>
<p><strong>Manillas disponibles:</strong> {{ $evento->manillasDisponibles() }}</p>
<p><strong>Manillas utilizadas:</strong> {{ $evento->manillasUtilizadas() }}</p>
<p><strong>Porcentaje manillas utilizadas:</strong> {{ $evento->porcentajeManillasUtilizadas() }}%</p>

<p><strong>Codigos asignados:</strong> {{ $codigo->count() }}</p>
<p style="display:none">
@foreach ($codigo as $codigos)
    {{ $codigos->codigo }} <br />
@endforeach
<p>

<hr>

<!-- <h3>Invitados</h3>

<form action="{{ route('eventos.agregar-invitado', $evento) }}" method="POST" class="mb-3">
    @csrf
    <div class="input-group">
        <select name="invitado_id" class="form-select" required>
            <option value="">Selecciona un invitado</option>
            @foreach($invitados as $invitado)
                <option value="{{ $invitado->id }}">{{ $invitado->nombre }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success">Agregar</button>
    </div>
</form> -->

@if ($evento->invitados->isEmpty())
    <p>No hay invitados registrados.</p>
@else
    <!-- <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invitado</th>
                <th>Estado</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evento->invitados as $registro)
                <tr>
                    <td>{{ $registro->invitado->nombre }}</td>
                    <td>{{ ucfirst($registro->estado) }}</td>
                    <td>{{ $registro->hora_de_registro ? $registro->hora_de_registro->format('H:i:s') : '-' }}</td>
                    <td>{{ $registro->hora_de_salida ? $registro->hora_de_salida->format('H:i:s') : '-' }}</td>
                    <td>
                        @if (!$registro->hora_de_registro)
                            <a href="{{ route('eventos.registrar-entrada', [$evento, $registro->invitado_id]) }}" class="btn btn-sm btn-primary">Registrar Entrada</a>
                        @endif
                        @if ($registro->hora_de_registro && !$registro->hora_de_salida)
                            <a href="{{ route('eventos.registrar-salida', [$evento, $registro->invitado_id]) }}" class="btn btn-sm btn-secondary">Registrar Salida</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> -->
@endif

<div>
    <a href="{{ route('eventos.registroInvitadoForm', $evento) }}" class="btn btn-primary btn-sm">Registrar Invitado</a>
    <a href="{{ route('asignaciones.create', $evento) }}" class="btn btn-info btn-sm">Asignar Manillas</a>
    <a href="{{ route('eventos.invitados-evento', $evento) }}" class="btn btn-info btn-sm">Invitados registrados</a>
    <a href="{{ route('eventos.resumen-estadistica', $evento) }}" class="btn btn-info btn-sm">Estadisticas</a>
    <a href="{{ route('eventos.resumen', $evento) }}" class="btn btn-info btn-sm">Resumen</a>
</div>


<a href="{{ route('eventos.index') }}" class="btn btn-link">← Volver al listado</a>
@endsection
