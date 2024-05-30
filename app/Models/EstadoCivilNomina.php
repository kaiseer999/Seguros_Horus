<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCivilNomina extends Model
{
    use HasFactory;

    protected $primaryKey = 'idEstadoCivilNomina';

    protected $fillable=[
        'idEstadoCivilNomina',
        'nombreEstadoCivil'
    ];


}
