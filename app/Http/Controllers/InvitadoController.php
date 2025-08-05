<?php

namespace App\Http\Controllers;

use App\Models\Invitado;
use Illuminate\Http\Request;

class InvitadoController extends Controller
{
    public function index()
    {
        $invitados = Invitado::orderBy('nombre')->paginate(10);
        return view('invitados.index', compact('invitados'));
    }

    public function create()
    {
        return view('invitados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'email' => 'nullable|email|max:100',
            'telefono' => 'nullable|string|max:20',
            'documento_id' => 'nullable|string|max:50',
        ]);

        Invitado::create($request->all());

        return redirect()->route('invitados.index')->with('success', 'Invitado creado exitosamente');
    }

    public function show(Invitado $invitado)
    {
        $invitado->load('eventos.evento');
        return view('invitados.show', compact('invitado'));
    }

    public function edit(Invitado $invitado)
    {
        return view('invitados.edit', compact('invitado'));
    }

    public function update(Request $request, Invitado $invitado)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'email' => 'nullable|email|max:100',
            'telefono' => 'nullable|string|max:20',
            'documento_id' => 'nullable|string|max:50',
        ]);

        $invitado->update($request->all());

        return redirect()->route('invitados.index')->with('success', 'Invitado actualizado exitosamente');
    }

    public function destroy(Invitado $invitado)
    {
        $invitado->delete();
        return redirect()->route('invitados.index')->with('success', 'Invitado eliminado exitosamente');
    }
}