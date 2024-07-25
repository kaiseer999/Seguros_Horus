<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesorComercial extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAsesorComercial';

    protected $fillable = [
        'nombreAsesor',
        'apellidoAsesor',
        'telefonoAsesor',
        'emailAsesor',
        'estadoAsesor',
    ];

    public function clienteFacturas()
    {
        return $this->hasMany(ClienteFactura::class, 'idAsesorComercial');
    }

    protected $casts = [
        'nombreAsesor' => 'string',
        'apellidoAsesor' => 'string',
    ];

    public function setNombreAsesorAttribute($value)
    {
        $this->attributes['nombreAsesor'] = strtoupper($value);
    }

    public function setApellidoAsesorAttribute($value)
    {
        $this->attributes['apellidoAsesor'] = strtoupper($value);
    }

}
