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
        'idCargoNomina',
        'idEstadoEmpleadoNomina',
        'SalarioEmpleadoNom'
    ];

    public function infoEmpleadoPerNomina(){
        return $this->hasMany('App\Models\infoEmpleadoPerNomina', 'idEmpleadoAdmNom', 'idEmpleadoAdmNom');
    }

    public function CargoNomina(){
        return $this->belongsTo('App\Models\CargoNomina', 'idCargoNomina');
    }

    public function estados_EmpleadoNomina(){
        return $this->belongsTo('App\Models\estados_EmpleadoNomina', 'idEstadoEmpleadoNomina');
    }
    
}
