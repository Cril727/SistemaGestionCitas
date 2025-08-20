<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctores extends Model
{
    //
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'genero',
        'estado',
        'especialidad_id'
    ];
}
