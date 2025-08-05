<?php
// app/Models/Invitado.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invitado extends Model
{
    protected $table = 'invitados';
    
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'documento_id'
    ];

    public $timestamps = false;

    public function eventos(): HasMany
    {
        return $this->hasMany(EventoInvitado::class, 'invitado_id');
    }

    public function asociado() {
        return $this->belongsTo(Asociado::class);
    }

}