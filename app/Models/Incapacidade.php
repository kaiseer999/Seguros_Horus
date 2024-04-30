<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incapacidade extends Model
{
    use HasFactory;

    


    public function empleado(){
        return $this->belongsTo('App\Models\Empleado', 'numeroEmpleado');
    }

    public function empleadors(){
        return $this->belongsTo('App\Models\Empleador');
    }

    public function tipoIncapacidad(){
        return $this->belongsTo('App\Models\TipoIncapacidad', 'idTipoInc');
    }
    
    public function estado(){
        return $this->belongsTo('App\Models\Estado', 'idEstadoInc');
    }
    

    
    //Esto me pone los valores introducidos al crear a mayusculas
    protected $casts = [
        'EPS_ARL' => 'string',
        'numeroRadicado' => 'string',
        'RazonSocialInc' => 'string',
        'Observaciones'=>'string'

    ];

    public function setRazonSocialIncAttribute($value)
    {
        $this->attributes['RazonSocialInc'] = strtoupper($value);
    }
  
    public function setEPS_ARLAttribute($value)
    {
        $this->attributes['EPS_ARL'] = mb_strtoupper($value);
    }
    

        public function setObservacionesAttribute($value)
    {
        $this->attributes['Observaciones'] = mb_strtoupper($value);
    }

   
    public function setnumeroRadicadoAttribute($value)
    {
        $this->attributes['numeroRadicado'] = strtoupper($value);
    }
   
}
