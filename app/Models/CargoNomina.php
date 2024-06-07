<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoNomina extends Model
{
    use HasFactory;

    protected $primaryKey='idCargoNomina';

    protected $fillable=[
        'idCargoNomina',
        'nombreCargo'
    ];

    public function InfoEmpleadoAdminNomina(){
        return $this->hasMany('App\Models\InfoEmpleadoAdminNomina', 'idCargoNomina');
    }

    protected $casts = [
        'nombreCargo' => 'string',
    ];

    public function setnombreCargoNomAttribute($value)
    {
        $this->attributes['nombreCargo'] = strtoupper($value);
    }
    

}
