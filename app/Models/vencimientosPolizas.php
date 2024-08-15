<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class vencimientosPolizas extends Model
{
    use HasFactory;

    protected $primaryKey = 'idVencimiento';

    // Relación con Factura
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'idFactura', 'idFactura');
    }

    // Relación con DetalleFactura (esta relación podría necesitar ajustes según la estructura de tu base de datos)
    public function detalleFactura()
    {
        return $this->belongsTo(DetalleFactura::class, 'idDetalleFactura', 'codigoProducto');
    }

    // Método para verificar si una factura está próxima a vencer
    public function verificarVencimiento()
    {
        $fechaVencimiento = $this->factura->fecha_vencimiento;
        return Carbon\Carbon::now()->addMonths(3)->greaterThanOrEqualTo($fechaVencimiento);
    }

    protected $fillable = [
        'idFactura',
        'Avisos',
        'Estado'
    ];
}
