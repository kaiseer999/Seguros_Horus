<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoEmpleadoAdminNomina extends Model
{
    use HasFactory;

    protected $primaryKey='id_EmpleadoNomina';

    protected $fillable=[
        'id_EmpleadoNomina',
        'id_EmpleadoAdmNom',
        'cedulaEmpleadoNom',
        'nombreEmpleadoNom',
        'direccionEmpleadoNom',
        'sexoEmpleadoNom',
        'idEstadoCivilNomina',
        'fechaNacEmpleadoNom',
        'emailEmpleadoNom',
        'telefonoEmpleadoNom'

    ];
}
