<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];
    
}
