<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;


    protected $fillable = [
        'idFactura',
        'codigoProducto',
        'precioPagarProducto',
        'cantidadProducto',
        'Observaciones',
        'totalFactura'
    ];

    public function codigoProducto()
    {
        return $this->belongsTo(ProductoFactura::class, 'codigoProducto', 'codigoProducto');
    }

    public function idFactura()
    {
        return $this->belongsTo(Factura::class, 'idFactura', 'idFactura');
    }


}

