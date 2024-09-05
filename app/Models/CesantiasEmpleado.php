<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CesantiasEmpleado extends Model
{
    use HasFactory;

    protected $primaryKey = 'IdCesantiasEmpleado';

    protected $fillable = [
        'IdCesantiasEmpleado',
        'Anio',
        'id_EmpleadoNomina',
        'salarioEmpleado',
        'diasLaborados',
        'Observaciones',
        'totalCesantias'   
    ];

    public function empleado()
    {
        return $this->belongsTo(infoEmpleadoPerNomina::class, 'id_EmpleadoNomina', 'id_EmpleadoNomina'); // Asegúrate de que el segundo parámetro 'id_EmpleadoNomina' sea la clave foránea y el tercer parámetro 'id' sea la clave primaria en infoEmpleadoPerNomina
    }

        public function interes()
    {
        return $this->hasOne(InteresesCesantias::class, 'IdCesantiasEmpleado', 'IdCesantiasEmpleado');
    }
    

}
