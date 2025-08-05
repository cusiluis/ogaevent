@extends('layouts.app')

@section('title', 'Asignar Código a Asociado')

@section('content')
<h2>Asignar Código a Asociado</h2>
<form action="{{ route('codigo-asociado.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="asociado_id" class="form-label">Asociado:</label>
        <select name="asociado_id" class="form-control" required>
            <option value="">---</option>
            @foreach($asociados as $a)
            <option value="{{ $a->id }}">{{ $a->nombre }}</option>
            @endforeach
        </select>        
    </div>

    <div class="mb-3">
        <label for="codigo_id" class="form-label">Código:</label>
        <select name="codigo_id" class="form-control" required>
            <option value="">---</option>
            @foreach($codigos as $c)
            <option value="{{ $c->id }}">{{ $c->codigo }} ({{ $c->tipo }})</option>
            @endforeach
        </select>        
    </div>    

    <button type="submit"  class="btn btn-primary">Asignar</button>
</form>
@endsection
