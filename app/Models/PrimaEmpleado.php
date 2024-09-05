<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaEmpleado extends Model
{
    use HasFactory;


    protected $fillable = [
        'AnoPago',
        'id_EmpleadoNomina', 
        'periodoPago',
        'diasLaborados',
        'AuxTransporte',
        'TotalPagoPrima'
    ];

    public function empleado()
    {
        return $this->belongsTo(infoEmpleadoPerNomina::class, 'id_EmpleadoNomina', 'id_EmpleadoNomina');
    } 
    
}
