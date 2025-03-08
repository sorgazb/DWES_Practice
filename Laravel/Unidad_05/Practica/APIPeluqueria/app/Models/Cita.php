<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    //
    public function detalleCita(){
        return $this->hasMany(DetalleCita::class);
    }
}
