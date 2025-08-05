<?php
namespace App\Http\Controllers;

use App\Models\Codigo;
use App\Models\Asociado;
use App\Models\CodigoAsociado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CodigoAsociadoController extends Controller
{
    public function create()
    {
        $asociados = Asociado::all();
        $codigos = Codigo::where('asignado', false)->get();
        return view('codigo_asociado.create', compact('asociados', 'codigos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_id' => 'required|exists:codigos,id',
            'asociado_id' => 'required|exists:asociados,id',
        ]);

        CodigoAsociado::create($request->all());

        Codigo::find($request->codigo_id)->update(['asignado' => true]);

        return redirect()->route('codigos.index')->with('success', 'Código asignado al asociado.');
    }
}
