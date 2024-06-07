<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estados_EmpleadoNomina extends Model
{
    use HasFactory;

    protected $primaryKey = 'idEstadoEmpleadoNomina';

    protected $fillable=[
        'idEstadoEmpleadoNomina',
        'nombreEstadoEmpleado'
    ];

    public function InfoEmpleadoAdminNomina(){
        return $this->hasMany('App\Models\InfoEmpleadoAdminNomina', 'idCargoNomina');
    }
}
