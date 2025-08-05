<?php
// routes/web.php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InvitadoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AsociadoController;
use App\Http\Controllers\CodigoController;
use App\Http\Controllers\CodigoAsociadoController;
use App\Http\Controllers\AsignacionController;

use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
});

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas de eventos
    Route::resource('eventos', EventoController::class);
    Route::post('eventos/{evento}/invitados', [EventoController::class, 'agregarInvitado'])->name('eventos.agregar-invitado');
    Route::get('eventos/{evento}/invitados', [EventoController::class, 'invitadosEvento'])->name('eventos.invitados-evento');
    Route::get('eventos/{evento}/invitados/{invitado}/registro', [EventoController::class, 'registrarEntrada'])->name('eventos.registrar-entrada');
    Route::get('eventos/{evento}/invitados/{invitado}/salida', [EventoController::class, 'registrarSalida'])->name('eventos.registrar-salida');
    

    Route::get('eventos/{evento}/registro-invitado', [EventoController::class, 'registroInvitadoForm'])->name('eventos.registroInvitadoForm');
    Route::post('eventos/{evento}/registro-manual', [EventoController::class, 'registroManual'])->name('eventos.registroManual');
    Route::post('eventos/{evento}/registro-codigo', [EventoController::class, 'registroCodigo'])->name('eventos.registroCodigo');

    // routes/web.php
    Route::get('eventos/{evento}/asociados/{asociado}/invitados', [EventoController::class, 'invitadosPorAsociado'])->name('eventos.invitados.asociado');





    // Rutas de invitados
    Route::resource('invitados', InvitadoController::class);



    // Rutas CRUD principales
    Route::resource('asociados', AsociadoController::class);

    Route::get('/buscar-asociado-por-codigo/{codigo}', [AsociadoController::class, 'buscarAsociadoPorCodigo']);



    // Asignación de manillas a asociados por evento
    Route::get('eventos/asignaciones/{evento}/create', [AsignacionController::class, 'create'])->name('asignaciones.create');
    Route::post('/asignaciones', [AsignacionController::class, 'store'])->name('asignaciones.store');

    Route::get('eventos/{evento}/resumen', [EventoController::class, 'resumen'])->name('eventos.resumen');
    Route::get('eventos/{evento}/resumen-estadistica', [EventoController::class, 'resumenEstadistica'])->name('eventos.resumen-estadistica');




    // Codigos y asignacion de codigo
    Route::resource('codigos', CodigoController::class)->only(['index', 'create', 'store']);

    Route::get('codigo-asociado/create', [CodigoAsociadoController::class, 'create'])->name('codigo-asociado.create');
    Route::post('codigo-asociado', [CodigoAsociadoController::class, 'store'])->name('codigo-asociado.store');

    Route::get('buscar-asociados', function(Request $request) {
        $query = $request->input('term');
        $resultados = Asociado::where('nombre', 'LIKE', '%' . $query . '%')
                        ->limit(10)
                        ->get(['id', 'nombre']);

        return response()->json($resultados);
    });
    
    // Rutas solo para administradores
    Route::middleware('role:admin')->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        Route::get('usuarios/{usuario}', [UsuarioController::class, 'show'])->name('usuarios.show');

    });
});