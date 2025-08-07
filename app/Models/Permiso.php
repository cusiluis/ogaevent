<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Permiso extends Model {
    protected $table = 'permisos';  // opcional si sigues convenciones
    protected $fillable = ['nombre', 'slug'];

    public function roles() {
        return $this->belongsToMany(
            Roles::class,
            'permiso_rol',    // tabla pivote
            'permiso_id',     // FK de esta tabla en pivote
            'rol_id'          // FK del modelo relacionado en pivote
        );
    }
}