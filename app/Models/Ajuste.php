<?php
// app/Models/Ajuste.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    protected $table = 'ajustes';
    
    protected $fillable = [
        'key',
        'value',
        'descripcion',
        'updated_by'
    ];

    public static function getValue($key, $default = null)
    {
        $ajuste = self::where('key', $key)->first();
        return $ajuste ? $ajuste->value : $default;
    }

    public static function setValue($key, $value, $descripcion = null, $updatedBy = null)
    {
        return self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'descripcion' => $descripcion,
                'updated_by' => $updatedBy
            ]
        );
    }
}