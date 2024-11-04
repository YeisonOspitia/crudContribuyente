<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribuyente extends Model
{
    protected $fillable = [
        'tipo_documento',
        'documento',
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'celular',
        'email',
        'usuario',
        'nombre_completo'
    ];
}
