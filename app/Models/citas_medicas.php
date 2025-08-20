<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class citas_medicas extends Model
{
    //
    protected $table = 'citas_medicas';
    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'fecha_hora',
        'estado',
        'novedad'
    ];

}
