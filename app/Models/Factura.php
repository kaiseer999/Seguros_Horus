<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $primaryKey = 'idFactura';

    protected $fillable =[
        'id_cliente',
        'fecha_pago',
        'fecha_Vencimiento',
        'valorOriginal',
        'valorFinal',
    ];

    public function clientes_facturas()
    {
        return $this->belongsTo(ClienteFactura::class, 'id_cliente', 'id_cliente');
    }

    public function DetalleFactura()
    {
        return $this->hasMany(DetalleFactura::class, 'idFactura', 'idFactura');
    }

    public function PagosFactura()
    {
        return $this->hasMany(PagosFactura::class, 'idFactura', 'idFactura');
    }

    public function vencimientos()
    {
        return $this->hasMany(vencimientosPolizas::class, 'idFactura', 'idFactura');
    }

}
