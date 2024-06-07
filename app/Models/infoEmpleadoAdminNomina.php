<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoEmpleadoAdminNomina extends Model
{
    use HasFactory;

    protected $primaryKey='idEmpleadoAdmNom';

    protected $fillable=[
        'idEmpleadoAdmNom',
        'fechaIngresoEmpleadoNom',
        'idCargoNomima',
        'idEstadoNomina',
    ];

    public function InfoEmpleadoPerNomina(){
        return $this->hasMany('App\Models\InfoEmpleadoPerNomina', 'id_EmpleadoNomina');
    }

    public function CargoNomina(){
        return $this->belongsTo('App\Models\CargoNomina', 'idCargoNomina');
    }

    public function EstadoNomina(){
        return $this->belongsTo('App\Models\EstadosNomina', 'idEstadoNomina');
    }
}
