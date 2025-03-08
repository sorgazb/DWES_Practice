<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCita extends Model
{
    //
    public function cita(){
        return $this->belongsTo(Cita::class);
    }

    public function servicio(){
        return $this->belongsTo(Servicio::class);
    }
}
