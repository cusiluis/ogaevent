@extends('layouts.app')

@section('title', 'Registrar Invitado')

@section('content')
<div class="card mx-auto" style="max-width: 400px">
    <div class="card-body">
        <h3 class="card-title text-center mb-4">Registrar Invitado</h3>

        {{-- Registro Manual --}}
        <h5 class="mb-3" style="text-align:center">{{ $evento_nombre }}</h5>
        <form method="POST" action="{{ route('eventos.registroManual', $evento) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre Completo del Invitado</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej. Ana Sofía López" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono de Contacto</label>
                <input type="text" name="telefono" class="form-control" placeholder="Ej. 5512345678">
            </div>

               <?php //print_r($asociados) ?> 
            <div class="mb-3">
                <label class="form-label">Asociado que invito</label>
                <input type="text" id="buscadorAsociado" class="form-control" list="listaAsociados" placeholder="Escriba nombre">
                <datalist id="listaAsociados">
                    @foreach($asociados as $asociado)
                        <option data-id="{{ $asociado->id }}"
                                data-cargo="{{ $asociado->cargo }}"
                                data-regional="{{ $asociado->regional }}"
                                data-asignadas="{{ $asociado->manillas_asignadas }}"
                                data-utilizadas="{{ $asociado->manillas_utilizadas }}"
                                data-disponibles="{{ $asociado->manillas_disponibles }}"
                                data-sasignacion="{{ $asociado->sin_asignacion }}"
                                value="{{ $asociado->nombre }}">
                    @endforeach
                </datalist>
            </div>

            <div id="datosAsociado" class="alert alert-success" style="display: none">
                <p><strong>Cargo:</strong> <span id="cargo"></span></p>
                <p><strong>Regional:</strong> <span id="regional"></span></p>

                <p id="sasignacion" class="text-danger" style="display:none">⚠ No tiene manillas asignadas para este evento</p>

                <p id="asignadas1"><strong>Manillas asignadas:</strong> <span id="asignadas"></span></p>
                <p id="utilizadas1"><strong>Manillas utilizadas:</strong> <span id="utilizadas"></span></p>
                <p id="disponibles1"><strong>Manillas disponibles:</strong> <span id="disponibles"></span></p>
            </div>

            <input type="hidden" name="asociado_id" id="asociado_id">
            <input type="hidden" name="codigo_id" id="codigo_id">


            <div class="mb-3">
                <label class="form-label">Código QR/Barras</label>
                <input type="text" id="codigoInput" class="form-control" placeholder="Escanea o ingresa el código" disabled>
            </div>    
            
            <div id="datosAsociado" class="alert alert-success" style="display: none">
                <p><strong>Nombre:</strong> <span id="nombre"></span></p>
                <p><strong>Email:</strong> <span id="email"></span></p>
                <p><strong>Teléfono:</strong> <span id="telefono"></span></p>
                <p><strong>Cargo:</strong> <span id="cargo"></span></p>
                <p><strong>Regional:</strong> <span id="regional"></span></p>
            </div>

            <div id="errorCodigo" class="alert alert-danger" style="display: none">
                Código no válido o no asignado.
            </div>


            <button type="submit" class="btn btn-dark w-100">Registrar</button>
        </form>

        <hr class="my-4">

    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buscador = document.getElementById('buscadorAsociado');
        if (!buscador) return;

        buscador.addEventListener('input', function () {
            const input = this.value;
            const datalist = document.getElementById('listaAsociados').options;

            let encontrado = false;

            for (let i = 0; i < datalist.length; i++) {
                if (datalist[i].value === input) {
                    const option = datalist[i];

                    document.getElementById('cargo').textContent = option.dataset.cargo || '—';
                    document.getElementById('regional').textContent = option.dataset.regional || '—';
                    document.getElementById('asignadas').textContent = option.dataset.asignadas || '—';
                    document.getElementById('utilizadas').textContent = option.dataset.utilizadas || '—';
                    document.getElementById('disponibles').textContent = option.dataset.disponibles || '—';
                    document.getElementById('asociado_id').value = option.dataset.id;

                   const sasignacion = option.dataset.sasignacion;

                    if (sasignacion == '' || sasignacion == '0') {
                        // Mostrar mensaje de que no tiene asignación
                        document.getElementById('sasignacion').style.display = 'block';
                        document.getElementById('asignadas1').style.display = 'none';
                        document.getElementById('utilizadas1').style.display = 'none';
                        document.getElementById('disponibles1').style.display = 'none';
                    }

                    document.getElementById('datosAsociado').style.display = 'block';
                    encontrado = true;
                    break;
                }
            }

            if (!encontrado) {
                document.getElementById('datosAsociado').style.display = 'none';
                document.getElementById('asociado_id').value = '';
            }
        });



        document.getElementById('codigoInput').addEventListener('change', async function () {
            const codigo = this.value.trim();
            const eventoId = {{ $evento_id }};

            if (!codigo) return;

            try {
                const response = await fetch(`/buscar-asociado-por-codigo/${codigo}?evento_id=${eventoId}`);
                const result = await response.json();

                if (result.status === 'ok') {
                    document.getElementById('nombre').textContent = result.data.nombre;
                    document.getElementById('email').textContent = result.data.email ?? '—';
                    document.getElementById('telefono').textContent = result.data.telefono ?? '—';
                    document.getElementById('cargo').textContent = result.data.cargo;
                    document.getElementById('regional').textContent = result.data.regional;
                    document.getElementById('buscadorAsociado').value = result.data.nombre;
                    document.getElementById('asociado_id').value = result.data.asociado_id;
                    document.getElementById('codigo_id').value = result.data.codigo_id;

                    document.getElementById('datosAsociado').style.display = 'block';
                    document.getElementById('errorCodigo').style.display = 'none';
                } else {
                    throw new Error();
                }
            } catch (e) {
                document.getElementById('datosAsociado').style.display = 'none';
                document.getElementById('errorCodigo').style.display = 'block';
            }
        });




    });
</script>
