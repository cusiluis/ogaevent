{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Bienvenido, {{ auth()->user()->nombre }}</h1>
        <p class="text-muted">Rol: {{ ucfirst(auth()->user()->rol) }}</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total de Eventos</h5>
                <h2>{{ $totalEventos }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Total de Invitados</h5>
                <h2>{{ $totalInvitados }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Próximos Eventos</h5>
            </div>
            <div class="card-body">
                @if($eventosProximos->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($eventosProximos as $evento)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <strong>{{ $evento->nombre }}</strong><br>
                                <small class="text-muted">{{ $evento->hora_inicio->format('d/m/Y H:i') }}</small>
                            </div>
                            <a href="{{ route('eventos.show', $evento) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No hay eventos próximos</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Registros Recientes</h5>
            </div>
            <div class="card-body">
                @if($registrosRecientes->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($registrosRecientes as $registro)
                        <li class="list-group-item">
                            <strong>{{ $registro->invitado->nombre }}</strong><br>
                            <small class="text-muted">{{ $registro->evento->nombre }}</small><br>
                            <small class="text-success">{{ $registro->hora_de_registro->format('d/m/Y H:i') }}</small>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No hay registros recientes</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection