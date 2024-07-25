<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoFactura extends Model
{
    use HasFactory;

    protected $primaryKey = 'codigoProducto';

    protected $fillable=[
        'idCategoriaProducto',
        'nombreProducto',
        'precioProducto',
        'descripcionProducto'
    ];



    protected $casts=[
        'nombreProducto'=>'string'
    ];

    public function setnombreProductoAttribute($value){
        $this->attributes['nombreProducto'] = strtoupper($value);
    }

    public function categoriaProducto()
    {
        return $this->belongsTo(CategoriaProducto::class, 'idCategoriaProducto', 'idCategoriaProducto');
    }



}
