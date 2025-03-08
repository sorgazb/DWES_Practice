<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    //
    function recurso(){
        return $this->belongsTo(Recursos::class);
    }
}
