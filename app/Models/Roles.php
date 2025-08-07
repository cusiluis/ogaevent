<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Roles extends Model {
    protected $table = 'roles';  // opcional
    protected $fillable = ['nombre', 'slug'];

    public function permisos() {
        return $this->belongsToMany(
            Permiso::class,
            'permiso_rol',    // tabla pivote
            'rol_id',         // FK de esta tabla en pivote
            'permiso_id'      // FK del modelo relacionado en pivote
        );
    }

    public function usuarios() {
        return $this->belongsToMany(
            Usuario::class,
            'rol_usuario',    // tabla pivote
            'rol_id',         // FK de esta tabla en pivote
            'usuario_id'      // FK del modelo relacionado en pivote
        );
    }
}
