<?php

use Illuminate\Http\Request;
use App\Models\Codigo;
use App\Models\CodigoAsociado;
use App\Models\Asociado;

Route::get('/buscar-asociado-por-codigo/{codigo}', function ($codigo, Request $request) {
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
            'nombre' => $asignacion->asociado->nombre,
            'email' => $asignacion->asociado->email,
            'telefono' => $asignacion->asociado->telefono,
            'regional' => $asignacion->asociado->regional,
            'cargo' => $asignacion->asociado->cargo,
        ]
    ]);
});
