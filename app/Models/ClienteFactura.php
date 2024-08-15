<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteFactura extends Model
{
    use HasFactory;

    protected $table = 'clientes_facturas';

    protected $fillable = [
        'idAsesorComercial',
        'tipoDocumento',
        'numeroIdentificacion',
        'nombreCompleto',
        'direccionCliente',
        'fechaNacimientoCliente',
        'telefono',
        'email',
    ];

    public function asesorComercial()
    {
        return $this->belongsTo(AsesorComercial::class, 'idAsesorComercial');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'id_cliente', 'id_cliente');
    }

    protected $casts = [
        'nombreCompleto' => 'string',
        'direccionCompleto' => 'string',
    ];

    public function setNombreCompletoAttribute($value)
    {
        $this->attributes['nombreCompleto'] = strtoupper($value);
    }

    public function setDireccionCompletoAttribute($value)
    {
        $this->attributes['direccionCompleto'] = strtoupper($value);
    }

}
