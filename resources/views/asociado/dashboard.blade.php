@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Bienvenido, {{ Auth::guard('asociado')->user()->nombre }}</h2>
    <p>Selecciona un evento para ver o registrar invitados.</p>

    <a href="{{ route('asociado.logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="btn btn-danger">
       Cerrar sesión
    </a>

    <form id="logout-form" action="{{ route('asociado.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

@endsection