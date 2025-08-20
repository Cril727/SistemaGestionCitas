<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    // Define the table associated with the model
    protected $table = 'pacientes';

    // Define the fillable attributes
    protected $fillable = [
        'documento',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'genero'
    ];

}
