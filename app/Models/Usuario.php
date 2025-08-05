<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    
    protected $fillable = [
        'nombre',
        'email',
        'password_hash',
        'rol'
    ];

    protected $hidden = [
        'password_hash',
    ];

    public $timestamps = false;

    // Necesario para Laravel Auth
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Métodos para roles
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    public function isEmployee()
    {
        return $this->rol === 'employee';
    }

    public function hasRole($role)
    {
        return $this->rol === $role;
    }

    public function eventosCreados(): HasMany
    {
        return $this->hasMany(Evento::class, 'created_by');
    }

    public function registros(): HasMany
    {
        return $this->hasMany(EventoInvitado::class, 'registrado_por');
    }
}