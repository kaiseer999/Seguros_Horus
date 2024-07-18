<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoFactura extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombreProducto',
        'precioProducto'
    ];

    protected $casts=[
        'nombreProducto'=>'string'
    ];

    public function setnombreProductoAttribute($value){
        $this->attributes['nombreProducto'] = strtoupper($value);
    }




}
