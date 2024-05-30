<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosNomina extends Model
{
    use HasFactory;

    protected $primaryKey = 'idEstadoNomina';

    protected $fillable=[
        'idEstadoNomina',
        'nombreEstadoNomina'
    ];

}
