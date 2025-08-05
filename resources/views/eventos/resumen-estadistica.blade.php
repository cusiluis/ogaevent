@extends('layouts.app')
@section('content')
<style>
    .containercard {
      padding: 2rem;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 1.5rem;
    }    
    .card {
      background-color: #fff;
      padding: 1.2rem;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: translateY(-3px);
    }

    .card h3 {
      margin: 0 0 0.5rem 0;
      font-size: 1.1rem;
      color: #111827;
    }

    .card p {
      margin: 0.3rem 0;
      color: #6b7280;
      font-size: 0.95rem;
    }

    .progress-bar-containercard {
      margin-top: 0.5rem;
      background-color: #e5e7eb;
      height: 8px;
      border-radius: 4px;
      overflow: hidden;
    }

    .progress-bar {
      height: 8px;
      background-color: #10b981;
      width: 0%;
      transition: width 0.3s ease;
      border-radius: 4px;
    }
</style>
<!-- <div class="container">
    <h1>Resumen de Manillas - Evento: {{ $evento->nombre }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre Asociado</th>
                <th>Telefono</th>
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
                    <td>{{ $asociado->telefono }}</td>
                    <td>{{ $asociado->pivot->manillas_asignadas }}</td>
                    <td>{{ $asociado->pivot->manillas_utilizadas }}</td>
                    <td>{{ $asociado->pivot->manillas_asignadas - $asociado->pivot->manillas_utilizadas }}</td>
                    <td><a href="{{ route('eventos.invitados.asociado', [$evento->id, $asociado->id]) }}" class="btn btn-sm btn-info">Ver</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> -->

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Estadisticas - Evento: {{ $evento->nombre }}</h1>
</div>

<div class="containercard">
    @foreach($evento->asociados as $asociado)
    <div class="card">
      <h3>{{ $asociado->nombre }}</h3>
      <p>Teléfono: {{ $asociado->telefono }}</p>
      <div class="progress-bar-container">
        <div class="progress-bar"></div>
      </div>
      <p>Invitados registrados: {{ $asociado->pivot->manillas_utilizadas }} de {{ $asociado->pivot->manillas_asignadas }}</p>
    </div>
    @endforeach

</div>
@endsection
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const cards = document.querySelectorAll('.card');

      cards.forEach(card => {
        const text = card.querySelector('p:last-of-type').textContent;
        const match = text.match(/(\d+)\s*de\s*(\d+)/i);

        if (match) {
          const registrados = parseInt(match[1], 10);
          const total = parseInt(match[2], 10);
          const porcentaje = total > 0 ? (registrados / total) * 100 : 0;

          const progressBar = card.querySelector('.progress-bar');
          if (progressBar) {
            progressBar.style.width = porcentaje + '%';
          }
        }
      });
    });
  </script>
