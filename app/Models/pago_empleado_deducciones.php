<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pago_empleado_deducciones extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pago_deduccion_empleado';

    protected $fillable = [
        'id_pago_deduccion_empleado',
        'id_PagoEmpleado',
        'idDeduccion_EmpNom'
    ];

    public function deduccionesempleado(){
        return $this->belongsTo('App\Models\deduccionesempleado', 'idDeduccion_EmpNom');
    }

    public function Pago_Empleado(){
        return $this->belongsTo('App\Models\Pago_Empleado', 'id_PagoEmpleado');
    }





}
