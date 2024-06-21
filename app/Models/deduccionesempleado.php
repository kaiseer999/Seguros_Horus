<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deduccionesempleado extends Model
{
    use HasFactory;

    protected $primaryKey = 'idDeduccion_EmpNom';

    protected $fillable=[
        'idDeduccion_EmpNom',
        'id_EmpleadoNomina',
        'idTipoDeduccionesNomina',
        'MontoDeduccionNom'
    ];

    public function infoEmpleadoPerNomina(){
        return $this->belongsTo('App\Models\infoEmpleadoPerNomina', 'id_EmpleadoNomina');
    }
    

    public function TipoDeduccionesNomina(){
        return $this->belongsTo('App\Models\TipoDeduccionesNomina', 'idTipoDeduccionesNomina');
    }




}
