<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeduccionesNomina extends Model
{
    use HasFactory;

    protected $primaryKey='idTipoDeduccionesNomina';

    protected $fillable=[
        'idTipoDeduccionesNomina',
        'nombreTipoDeduccion'
    ];


    public function deduccionesempleado(){
        return $this->hasMany('App\Models\deduccionesempleado', 'idTipoDeduccionesNomina');
    }
    

    
    

}
