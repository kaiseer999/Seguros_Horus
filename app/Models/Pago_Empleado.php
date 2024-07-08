<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago_Empleado extends Model
{
    use HasFactory;

    protected $primaryKey= 'id_PagoEmpleado';

    protected $table = 'pago_empleados'; // Nombre correcto de la tabla


    protected $fillable = [
        'id_PagoEmpleado',
        'DiasLaborados',
        'SueldoBruto',
        'fechaDePagoNom',
        'id_EmpleadoNomina',
        'idTipoPagoNomina',
        'AuxiliodeTransporte',
        'HorasExtras',
        'SueldoNeto'
    ];

    public function infoEmpleadoAdminNomina(){
        return $this->belongsTo('App\Models\infoEmpleadoPerNomina', 'id_EmpleadoNomina', 'id_EmpleadoNomina');

    }
    public function TipoPagoNomina(){
        return $this->belongsTo('App\Models\TipoPagoNomina', 'idTipoPagoNomina');
    }

    public function deduccionesempleado(){
        return $this->belongsToMany('App\Models\deduccionesempleado', 'pago_empleado_deducciones', 'id_PagoEmpleado', 'idDeduccion_EmpNom');
    }

    

}
