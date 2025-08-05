<?php
namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Asociado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    public function create(Evento $evento)
    {
        //$eventos = Evento::all();
        $asociados = Asociado::all();
        return view('asignaciones.create', compact('evento', 'asociados'));
    }

    public function store(Request $request)
    {
        //print_r($_POST);exit;
        $request->validate([
            'evento_id' => 'required|exists:evento,id',
            'asociado_id' => 'required|exists:asociados,id',
            'manillas_asignadas' => 'required|integer|min:1',
        ]);

        $evento = Evento::findOrFail($request->evento_id);

        // Total asignado actual
        $totalAsignado = DB::table('asociado_evento')
            ->where('evento_id', $evento->id)
            ->sum('manillas_asignadas');

        $disponibles = $evento->total_manillas - $totalAsignado;

        if ($request->manillas_asignadas > $disponibles) {
            return back()->with('error', 'No hay suficientes manillas disponibles para este evento');
        }

        DB::table('asociado_evento')->updateOrInsert(
            [
                'evento_id' => $request->evento_id,
                'asociado_id' => $request->asociado_id,
            ],
            [
                'manillas_asignadas' => $request->manillas_asignadas,
                'manillas_utilizadas' => 0,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return back()->with('success', 'Manillas asignadas correctamente');
    }
}
