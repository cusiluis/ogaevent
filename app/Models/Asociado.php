<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Asociado extends Authenticatable
{
    protected $table = 'asociados';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'cargo',
        'regional',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function isAdmin()
    {
        return $this->rol === 'admin';
    }


    public function codigos()
    {
        return $this->hasMany(CodigoAsociado::class);
    }

    public function eventos() {
        return $this->belongsToMany(Evento::class)->withPivot('manillas_asignadas', 'manillas_utilizadas')->withTimestamps();
    }

    public function invitados() {
        return $this->hasMany(Invitado::class);
    }

}