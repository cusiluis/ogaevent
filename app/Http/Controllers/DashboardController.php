<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Invitado;
use App\Models\EventoInvitado;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalEventos = Evento::count();
        $totalInvitados = Invitado::count();
        $eventosProximos = Evento::where('hora_inicio', '>', now())
                                ->orderBy('hora_inicio')
                                ->limit(5)
                                ->get();
        
        $registrosRecientes = EventoInvitado::with(['evento', 'invitado'])
                                          ->whereNotNull('hora_de_registro')
                                          ->orderBy('hora_de_registro', 'desc')
                                          ->limit(5)
                                          ->get();

        return view('dashboard', compact('totalEventos', 'totalInvitados', 'eventosProximos', 'registrosRecientes'));
    }
}