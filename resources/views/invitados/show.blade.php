@extends('layouts.app')

@section('title', 'Detalle del Invitado')

@section('content')
<h1>{{ $invitado->nombre }}</h1>

<p><strong>Email:</strong> {{ $invitado->email ?? 'N/A' }}</p>
<p><strong>Teléfono:</strong> {{ $invitado->telefono ?? 'N/A' }}</p>
<p><strong>Documento de Identidad:</strong> {{ $invitado->documento_id ?? 'N/A' }}</p>

<hr>

<h3>Eventos Asignados</h3>

@if ($invitado->eventos->isEmpty())
    <p>Este invitado no está registrado en ningún evento.</p>
@else
    <ul>
        @foreach ($invitado->eventos as $eventoInvitado)
            <li>
                {{ $eventoInvitado->evento->nombre }} - {{ $eventoInvitado->evento->hora_inicio->format('d/m/Y H:i') }}
            </li>
        @endforeach
    </ul>
@endif

<a href="{{ route('invitados.index') }}" class="btn btn-link">← Volver al listado</a>
@endsection
