<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagosFactura extends Model
{
    use HasFactory;

    protected $fillable= [
        'idFactura',
        'idFormaPago',
        'valorPagado'
    ];

    public function facturas()
    {
        return $this->belongsTo(Factura::class, 'idFactura', 'idFactura');
    } 

    public function formaPago()
    {
        return $this->belongsTo(FormasPago::class, 'idFormaPago', 'idFormaPago');
    }
}
