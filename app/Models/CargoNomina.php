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
}
