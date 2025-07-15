<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $fillable = [
        'cliente',
        'vendedor',
        'producto',
        'precio',
        'fecha_venta',
        'pagado',
        'fecha_pago',
    
    ];
}
