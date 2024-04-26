<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incapacidade extends Model
{
    use HasFactory;

    public function tipo_incapacidads(){
        return $this->belongsTo('App\Models\TipoIncapacidad');
    }

    public function empleado(){
        return $this->belongsTo('App\Models\Empleado');
    }

    public function empleadors(){
        return $this->belongsTo('App\Models\Empleador');
    }

    public function estados(){
        return $this->belongsTo('App\Models\Estado');
    }

   
}
