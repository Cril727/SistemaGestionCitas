<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class consultorios extends Model
{
    protected $table = 'consultorios';
    protected $fillable = ['nombre', 'ubicacion', 'piso'];
    protected $casts = ['piso' => 'integer'];
}
