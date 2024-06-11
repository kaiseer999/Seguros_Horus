<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoEmpleadoPerNomina extends Model
{
    use HasFactory;

    protected $primaryKey='id_EmpleadoNomina';

    protected $fillable=[
        'id_EmpleadoNomina',
        'idEmpleadoAdmNom',
        'cedulaEmpleadoNom',
        'nombreEmpleadoNom',
        'direccionEmpleadoNom',
        'sexoEmpleadoNom',
        'idEstadoCivilNomina',
        'fechaNacEmpleadoNom',
        'emailEmpleadoNom',
        'telefonoEmpleadoNom'

    ];

    public function infoEmpleadoAdminNomina(){
        return $this->belongsTo('App\Models\infoEmpleadoAdminNomina', 'idEmpleadoAdmNom', 'idEmpleadoAdmNom');
    }

    
    public function EstadoCivilNomina(){
        return $this->belongsTo('App\Models\EstadoCivilNomina', 'idEstadoCivilNomina');
    }
    protected $casts = [
        'nombreEmpleadoNom' => 'string',
        'direccionEmpleadoNom' => 'string',
        'sexoEmpleadoNom' => 'string',
    ];
    
    public function setnombreEmpleadoNomAttribute($value)
    {
        $this->attributes['nombreEmpleadoNom'] = strtoupper($value);
    }

    public function setdireccionEmpleadoNomAttribute($value)
    {
        $this->attributes['direccionEmpleadoNom'] = strtoupper($value);
    }

    public function setsexoEmpleadoNomAttribute($value)
    {
        $this->attributes['sexoEmpleadoNom'] = strtoupper($value);
    }
    



}
