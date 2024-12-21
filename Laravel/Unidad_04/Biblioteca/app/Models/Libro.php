<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //Relacion 1:N entre Libro y Prestamo
    // Un libro puede estar en varios Prestamos
    function librosPrestamos(){
        return $this->hasMany(Prestamo::class)->get();
    }
}
