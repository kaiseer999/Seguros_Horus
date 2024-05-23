<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public function Incapacidade(){
        return $this->hasMany('App\Models\Incapacidade');
    }

    public function Cruce(){
        return $this->hasMany('App\Models\Cruce');
    }


    protected $primaryKey = 'numeroEmpleado';

    protected $fillable=[
        'numeroEmpleado',
        'tipoDocumentoempleado',
        'idEmpleado',
        'nombreEmpleado',
        'apellidoEmpleado',

    ];


    protected $casts = [
        'nombreEmpleado' => 'string',
        'apellidoEmpleado' => 'string',
    ];

  
    public function setNombreEmpleadoAttribute($value)
    {
        $this->attributes['nombreEmpleado'] = strtoupper($value);
    }

   
    public function setApellidoEmpleadoAttribute($value)
    {
        $this->attributes['apellidoEmpleado'] = strtoupper($value);
    }

   




    
}
