<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoriaProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombreCategoria',
        'descripcion'
    ];

    public function productoFactura()
    {
        return $this->hasMany(ProductoFactura::class, 'idCategoriaProducto', 'idCategoriaProducto');
    }
}
