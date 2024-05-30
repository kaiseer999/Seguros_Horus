<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagoNomina extends Model
{
    use HasFactory;

    protected $primaryKey = 'idTipoPagoNomina';

    protected $fillable=[
        'idTipoPagoNomina',
        'nombreTipoPago'
    ];

}
