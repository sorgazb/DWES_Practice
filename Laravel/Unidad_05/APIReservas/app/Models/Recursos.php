<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recursos extends Model
{
    //
    function reservas(){
        return $this->hasMany(Reservas::class)->get();
    }
}
