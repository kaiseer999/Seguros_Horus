<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacacionesEmpleado extends Model
{
    use HasFactory;
    protected $primaryKey = 'idVacacioneEmpleados';

    protected $fillable = [
        'id_EmpleadoNomina',
        'fecha_inicio',
        'fecha_salida',
        'dias_vacaciones',
        'dias_trabajados',
        'pago_vacaciones'
    ];
}
