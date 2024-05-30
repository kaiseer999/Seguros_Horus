<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoEmpleadoPerNomina extends Model
{
    use HasFactory;

    protected $primaryKey='idEmpleadoAdmNom';

    protected $fillable=[
        'idEmpleadoAdmNom',
        'fechaIngresoEmpleadoNom',
        'idCargoNomima',
        'idEstadoNomina',
    ];
}
