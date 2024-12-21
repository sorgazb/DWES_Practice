<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCita extends Model
{
    //
    function cita(){
        return $this->belongsTo(Cita::class);
    }

    function servicio(){
        return $this->belongsTo(Servicio::class);
    }
}
