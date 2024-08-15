<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormasPago extends Model
{
    use HasFactory;

    protected $primaryKey = 'idFormaPago';

    protected $fillable=[
        'nombreFormaPago'
    ];


    public function PagosFactura()
    {
        return $this->hasMany(PagosFactura::class, 'idFormaPago', 'idFormaPago');
    }
}
