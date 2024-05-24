<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cruce extends Model
{
    use HasFactory;

    protected $primaryKey = 'idCruce';

    public function incapacidade(){
        return $this->belongsTo('App\Models\Incapacidade', 'idIncapacidades');
    }
    

    protected $fillable=[
        'idCruce',
        'idIncapacidades',
        'valorIncapacidad',
        'valorCruce',
        'saldoCruce',
        'PagoEPS',
        'PagoCruce',
        'Observaciones'

    ];

    public function empleado(){
        return $this->belongsTo('App\Models\Empleado', 'numeroEmpleado');
    }

    public function empleadors(){
        return $this->belongsTo('App\Models\Empleador', 'numeroEmpleador');
    }

}
