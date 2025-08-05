<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class CodigoAsociado extends Model
{
    protected $table = 'codigo_asociado';

    protected $fillable = [
        'codigo_id', 'asociado_id', 'fecha_asignacion'
    ];

    public function codigo()
    {
        return $this->belongsTo(Codigo::class);
    }

    public function asociado()
    {
        return $this->belongsTo(Asociado::class);
    }
}
