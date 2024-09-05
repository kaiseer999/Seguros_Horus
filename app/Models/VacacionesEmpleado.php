<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacacionesEmpleado extends Model
{
    use HasFactory;

    protected $table = 'vacaciones_empleados';
    protected $primaryKey = 'idVacacionesEmpleados';

    protected $fillable = [
        'id_EmpleadoNomina',
        'fecha_inicio',
        'fecha_salida',
        'dias_vacaciones',
        'dias_trabajados',
        'dias_descanso',
        'pago_vacaciones',
        'Observacion'
        
    ];

    public function empleado()
{
    return $this->belongsTo(infoEmpleadoPerNomina::class, 'id_EmpleadoNomina');
}



}
