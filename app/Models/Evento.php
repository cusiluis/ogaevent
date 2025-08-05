<?php
// app/Models/Evento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
    protected $table = 'evento';
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'hora_inicio',
        'hora_fin',
        'ubicacion',
        'total_manillas',
        'created_by'
    ];

    protected $casts = [
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
    ];

    public $timestamps = false;

    public function creador(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'created_by');
    }

    public function invitados(): HasMany
    {
        return $this->hasMany(EventoInvitado::class, 'evento_id');
    }

    public function asociados() {
        return $this->belongsToMany(Asociado::class)->withPivot('manillas_asignadas', 'manillas_utilizadas')->withTimestamps();
    }

    public function manillasDisponibles()
    {
        $totalAsignadas = $this->asociados()->sum('asociado_evento.manillas_asignadas');
        return $this->total_manillas - $totalAsignadas;
    }

    public function manillasUtilizadas()
    {
        return $this->asociados()->sum('asociado_evento.manillas_utilizadas');
    }

    public function porcentajeManillasUtilizadas()
    {
        $utilizadas = $this->manillasUtilizadas();
        return $this->total_manillas > 0 ? round(($utilizadas / $this->total_manillas) * 100, 2) : 0;
    }

}