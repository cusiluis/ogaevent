<?php
// app/Models/EventoInvitado.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventoInvitado extends Model
{
    protected $table = 'evento_invitados';
    
    protected $fillable = [
        'evento_id',
        'invitado_id',
        'registrado_por',
        'codigo_id',
        'hora_de_registro',
        'hora_de_salida',
        'estado'
    ];

    protected $casts = [
        'hora_de_registro' => 'datetime',
        'hora_de_salida' => 'datetime',
    ];

    public $timestamps = false;

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    public function invitado(): BelongsTo
    {
        return $this->belongsTo(Invitado::class, 'invitado_id');
    }

    public function registradoPor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'registrado_por');
    }
    public function asociado(): BelongsTo
    {
        return $this->belongsTo(Asociado::class, 'registrado_por');
    }

}