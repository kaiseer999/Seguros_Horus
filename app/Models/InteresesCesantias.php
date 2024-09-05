<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteresesCesantias extends Model
{
    use HasFactory;


    protected $primaryKey = 'idInteresesCesantias';

    protected $table = 'interesescesantias_empleados';

    protected $fillable = [
        'id_EmpleadoNomina',
        'idCesantiasEmpleado',  // Este nombre debe coincidir con el nombre de la columna en la tabla
        'valorInteresesCesantias'
    ];

    public function cesantias()
{
    return $this->belongsTo(CesantiasEmpleado::class, 'IdCesantiasEmpleado', 'IdCesantiasEmpleado');
}


}
