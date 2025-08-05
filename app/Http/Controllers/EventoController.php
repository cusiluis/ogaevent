<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Invitado;
use App\Models\Usuario;
use App\Models\Asociado;
use App\Models\CodigoAsociado;
use App\Models\Codigo;
use App\Models\EventoInvitado;
use Illuminate\Http\Request;
use DB;


class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $eventos = Evento::with('creador')->orderBy('hora_inicio', 'desc')->paginate(10);
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'hora_inicio' => 'required|date',
            'hora_fin' => 'required|date|after:hora_inicio',
            'ubicacion' => 'nullable|string|max:150',
            'total_manillas' => 'nullable|int',
        ]);

        Evento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'ubicacion' => $request->ubicacion,
            'total_manillas' => $request->total_manillas,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('eventos.index')->with('success', 'Evento creado exitosamente');
    }

    public function show(Evento $evento)
    {
        $evento->load('creador', 'invitados.invitado');
        $codigo = Codigo::where('evento_id', $evento->id)
                            ->get();

        //$codigo = Codigo::all();                           

        $invitados = Invitado::all();
        return view('eventos.show', compact('evento', 'invitados', 'codigo'));
    }

    public function edit(Evento $evento)
    {
        $this->authorize('update', $evento);
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $this->authorize('update', $evento);
        
        $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'hora_inicio' => 'required|date',
            'hora_fin' => 'required|date|after:hora_inicio',
            'ubicacion' => 'nullable|string|max:150',
            'total_manillas' => 'nullable|int',
        ]);

        $evento->update($request->all());

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado exitosamente');
    }

    public function destroy(Evento $evento)
    {
        $this->authorize('delete', $evento);
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminado exitosamente');
    }

    public function agregarInvitado(Request $request, Evento $evento)
    {
        $request->validate([
            'invitado_id' => 'required|exists:invitados,id',
        ]);

        $exists = EventoInvitado::where('evento_id', $evento->id)
                              ->where('invitado_id', $request->invitado_id)
                              ->exists();

        if ($exists) {
            return back()->with('error', 'El invitado ya está registrado en este evento');
        }

        EventoInvitado::create([
            'evento_id' => $evento->id,
            'invitado_id' => $request->invitado_id,
            'registrado_por' => auth()->id(),
            'estado' => 'pendiente',
        ]);

        return back()->with('success', 'Invitado agregado al evento exitosamente');
    }

    public function registrarEntrada(Evento $evento, $invitadoId)
    {
        $eventoInvitado = EventoInvitado::where('evento_id', $evento->id)
                                      ->where('invitado_id', $invitadoId)
                                      ->first();

        if (!$eventoInvitado) {
            return back()->with('error', 'Invitado no encontrado en este evento');
        }

        $eventoInvitado->update([
            'hora_de_registro' => now(),
            'estado' => 'registrado',
        ]);

        return back()->with('success', 'Entrada registrada exitosamente');
    }

    public function registrarSalida(Evento $evento, $invitadoId)
    {
        $eventoInvitado = EventoInvitado::where('evento_id', $evento->id)
                                      ->where('invitado_id', $invitadoId)
                                      ->first();

        if (!$eventoInvitado) {
            return back()->with('error', 'Invitado no encontrado en este evento');
        }

        $eventoInvitado->update([
            'hora_de_salida' => now(),
        ]);

        return back()->with('success', 'Salida registrada exitosamente');
    }



    // public function registroInvitadoForm(Evento $evento)
    // {
    //     //print_r($evento->id);exit;
    //     $evento_id = $evento->id;
    //     $evento_nombre = $evento->nombre;
    //     $asociados = Asociado::orderBy('nombre')->get();
    //     return view('eventos.registro_invitado', compact('evento', 'asociados', 'evento_id', 'evento_nombre'));
    // }


    public function registroInvitadoForm(Evento $evento)
    {
        $evento_id = $evento->id;
        $evento_nombre = $evento->nombre;

        $asociados = Asociado::orderBy('nombre')->get();

        foreach ($asociados as $asociado) {
            // Buscar la relación con el evento actual en la tabla pivote
            $relacion = $evento->asociados()->where('asociado_id', $asociado->id)->first();

            if ($relacion) {
                $pivot = $relacion->pivot;
                $asociado->manillas_asignadas = $pivot->manillas_asignadas;
                $asociado->manillas_utilizadas = $pivot->manillas_utilizadas;
                $asociado->manillas_disponibles = $pivot->manillas_asignadas - $pivot->manillas_utilizadas;
                $asociado->sin_asignacion = false;
            } else {
                $asociado->manillas_asignadas = 0;
                $asociado->manillas_utilizadas = 0;
                $asociado->manillas_disponibles = 0;
                $asociado->sin_asignacion = true;
            }
        }

        return view('eventos.registro_invitado', compact('evento', 'asociados', 'evento_id', 'evento_nombre'));
    }




    public function registroManual(Request $request, Evento $evento)
    {
        //print_r($_POST);exit;
        $data = $request->validate([
            'nombre' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:20',
            'asociado_id' => 'required|exists:asociados,id',
            'codigo_id' => 'nullable|exists:codigos,id',
        ]);

        $registro = DB::table('asociado_evento')
            ->where('evento_id', $evento->id)
            ->where('asociado_id', $data['asociado_id'])
            ->first();

        if (!$registro) {
            return back()->with('error', 'El asociado no tiene manillas asignadas para este evento');
        }

        $disponibles = $registro->manillas_asignadas - $registro->manillas_utilizadas;

        if ($disponibles < 1) {
            return back()->with('error', 'No tiene manillas disponibles para registrar más invitados');
        }        

        //print_r($data);exit;
        $invitado = Invitado::create([
            'nombre' => $data['nombre'],
            'telefono' => $data['telefono'],
        ]);

        EventoInvitado::create([
            'evento_id' => $evento->id,
            'invitado_id' => $invitado->id,
            'registrado_por' => $data['asociado_id'],
            'codigo_id' => $data['codigo_id'],
            'hora_de_registro' => now(),
            'estado' => 'registrado',
        ]);

        DB::table('asociado_evento')
            ->where('evento_id', $evento->id)
            ->where('asociado_id', $data['asociado_id'])
            ->increment('manillas_utilizadas');

        return back()->with('success', 'Invitado registrado exitosamente');
    }





   public function resumenEstadistica(Evento $evento)
    {

        $resumen = [];

            $asignaciones = DB::table('asociado_evento')
                ->where('evento_id', $evento->id)
                ->join('asociados', 'asociado_evento.asociado_id', '=', 'asociados.id')
                ->select('asociados.id', 'asociados.telefono', 'asociados.nombre', 'manillas_asignadas', 'manillas_utilizadas')
                ->get();

            $resumen[] = [
                'evento' => $evento,
                'asignaciones' => $asignaciones,
                'total_disponibles' => $evento->total_manillas - $asignaciones->sum('manillas_asignadas'),
            ];
                            
        
        return view('eventos.resumen-estadistica', compact('resumen', 'evento'));
    }


    public function resumen(Evento $evento)
    {
        // Cargar los asociados con su pivot e invitados registrados por cada uno
        $evento->load(['asociados']);

        $invitadosPorAsociado = [];

        foreach ($evento->asociados as $asociado) {
            $invitados = EventoInvitado::with('invitado')
                ->where('evento_id', $evento->id)
                ->where('registrado_por', $asociado->id)
                ->get();

            $invitadosPorAsociado[$asociado->id] = $invitados;
        }

        return view('eventos.resumen', compact('evento', 'invitadosPorAsociado'));
    }




    // public function invitadosEvento(Evento $evento)
    // {
    //     $evento->load('creador', 'invitados.invitado');
    //     $codigo = Codigo::where('evento_id', $evento->id)
    //                         ->get();

    //     //$codigo = Codigo::all();                           

    //     $invitados = Invitado::all();
    //     return view('eventos.invitados_evento', compact('evento', 'invitados', 'codigo'));
    // }


    public function invitadosEvento(Evento $evento)
    {
        // Carga los invitados del evento junto con sus datos
        $evento->load([
            'creador',
            'invitados.invitado',
            'invitados.asociado' 
        ]);

        return view('eventos.invitados_evento', compact('evento'));
    }


    public function invitadosPorAsociado(Evento $evento, Asociado $asociado)
    {
        // Cargar el asociado con su pivot
        $asociadoConPivot = $evento->asociados()->where('asociado_id', $asociado->id)->first();

        // Validar que el asociado pertenezca al evento
        if (!$asociadoConPivot) {
            abort(404, 'El asociado no está registrado en este evento.');
        }

        // Obtener los invitados registrados por este asociado en este evento
        $invitadosEvento = EventoInvitado::with('invitado')
            ->where('evento_id', $evento->id)
            ->where('registrado_por', $asociado->id)
            ->get();

        return view('eventos.invitados_por_asociado', [
            'evento' => $evento,
            'asociado' => $asociadoConPivot,
            'pivot' => $asociadoConPivot->pivot,
            'invitadosEvento' => $invitadosEvento,
        ]);
    }





















    public function registroCodigo(Request $request, Evento $evento)
    {
        $data = $request->validate([
            'codigo' => 'required|string',
        ]);

        $invitado = Invitado::where('documento_id', $data['codigo'])->first();

        if (!$invitado) {
            return back()->with('error', 'Código no válido o invitado no registrado');
        }

        $eventoInvitado = EventoInvitado::where('evento_id', $evento->id)
            ->where('invitado_id', $invitado->id)
            ->first();

        if (!$eventoInvitado) {
            return back()->with('error', 'El invitado no está asociado a este evento');
        }

        $eventoInvitado->update([
            'hora_de_registro' => now(),
            'estado' => 'registrado',
        ]);

        return back()->with('success', 'Entrada registrada por código correctamente');
    }



}