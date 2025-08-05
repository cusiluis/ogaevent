<?php
namespace App\Http\Controllers;

use App\Models\Asociado;
use App\Models\Codigo;
use App\Models\CodigoAsociado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AsociadoController extends Controller
{
    public function index()
    {
        $asociados = Asociado::latest()->paginate(10);
        return view('asociados.index', compact('asociados'));
    }

    public function create()
    {
        return view('asociados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:asociados,email',
            'telefono' => 'nullable|string|max:20',
            'cargo' => 'nullable|string|max:100',
            'regional' => 'nullable|string|max:100',
        ]);

        Asociado::create($request->all());

        return redirect()->route('asociados.index')->with('success', 'Asociado creado correctamente.');
    }

    public function show(Asociado $asociado)
    {
        // Cargar todos los códigos asignados a este asociado
        $codigo = CodigoAsociado::with('codigo') // relación opcional para obtener detalles del código
                        ->where('asociado_id', $asociado->id)
                        ->get();
        return view('asociados.show', compact('asociado', 'codigo'));
    }

    public function edit(Asociado $asociado)
    {
        return view('asociados.edit', compact('asociado'));
    }

    public function update(Request $request, Asociado $asociado)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:asociados,email,' . $asociado->id,
            'telefono' => 'nullable|string|max:20',
            'cargo' => 'nullable|string|max:100',
            'regional' => 'nullable|string|max:100',
        ]);

        $asociado->update($request->all());

        return redirect()->route('asociados.index')->with('success', 'Asociado actualizado correctamente.');
    }

    public function destroy(Asociado $asociado)
    {
        $asociado->delete();

        return redirect()->route('asociados.index')->with('success', 'Asociado eliminado correctamente.');
    }


    public function buscarAsociadoPorCodigo($codigo, Request $request)
    {
        $eventoId = $request->query('evento_id');

        $codigoObj = Codigo::where('codigo', $codigo)
            ->where('evento_id', $eventoId)
            ->first();

        if (!$codigoObj) {
            return response()->json(['status' => 'codigo_no_encontrado'], 404);
        }

        $asignacion = CodigoAsociado::with('asociado')
            ->where('codigo_id', $codigoObj->id)
            ->first();

        if (!$asignacion) {
            return response()->json(['status' => 'codigo_sin_asignar'], 404);
        }

        return response()->json([
            'status' => 'ok',
            'data' => [
                'asociado_id' => $asignacion->asociado->id,
                'nombre' => $asignacion->asociado->nombre,
                'email' => $asignacion->asociado->email,
                'telefono' => $asignacion->asociado->telefono,
                'regional' => $asignacion->asociado->regional,
                'cargo' => $asignacion->asociado->cargo,
                'codigo_id' => $codigoObj->id,
            ]
        ]);
    }


}