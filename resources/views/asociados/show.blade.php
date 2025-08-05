@extends('layouts.app')

@section('title', 'Detalle del Asociado')

@section('content')
<div class="container">
    <h1>Detalle del Asociado</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $asociado->nombre }}</p>
            <p><strong>Email:</strong> {{ $asociado->email }}</p>
            <p><strong>Teléfono:</strong> {{ $asociado->telefono ?? 'N/A' }}</p>
            <p><strong>Cargo:</strong> {{ $asociado->cargo }}</p>
            <p><strong>Regional:</strong> {{ $asociado->regional }}</p>
            <p><strong>Creado:</strong> {{ $asociado->created_at ? date('d/m/Y H:i', strtotime($asociado->created_at)) : 'N/A' }}</p>
            <p><strong>Codigos:</strong>

                <ul>
                @foreach ($codigo as $item)
                    <li>
                        Código: {{ $item->codigo->codigo }} <br>
                    </li>
                @endforeach
                </ul>

            </p>
        </div>
    </div>

    <a href="{{ route('asociados.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
@endsection
