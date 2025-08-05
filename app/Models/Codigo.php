<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Codigo extends Model
{
    protected $fillable = [
        'codigo', 'tipo', 'evento_id', 'fecha_generacion', 'asignado'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function asociados()
    {
        return $this->belongsToMany(Asociado::class, 'codigo_asociado')
                    ->withTimestamps()
                    ->withPivot('fecha_asignacion');
    }
}
