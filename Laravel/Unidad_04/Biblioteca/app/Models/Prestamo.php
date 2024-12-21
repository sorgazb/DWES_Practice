<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    //Relacion 1:1 entre Prestamo y Libro
    // Ya que un Prestamo solo va a tener un Libro
    function libro(){
        return $this->belongsTo(Libro::class);
    }
}
