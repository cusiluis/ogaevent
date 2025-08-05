<?php
namespace App\Http\Controllers;

use App\Models\Codigo;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CodigoController extends Controller
{
    public function index()
    {
        $codigos = Codigo::with('evento')->get();
        return view('codigos.index', compact('codigos'));
    }

    public function create()
    {
        $eventos = Evento::all();
        return view('codigos.create', compact('eventos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:codigos',
            'tipo' => 'required|in:qr,barra',
            'evento_id' => 'required|exists:evento,id',
            'fecha_generacion' => 'required|date',
        ]);

        Codigo::create($request->all());

        return redirect()->route('codigos.index')->with('success', 'Código creado correctamente.');
    }
}
