<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIncapacidad extends Model
{
    use HasFactory;

    protected $primaryKey = 'idTipoInc';

    protected $fillable=[
        'idTipoInc',
        'NombreTipoInc'

    ];


    public function Incapacidade(){
        return $this->hasMany('App\Models\Incapacidade', 'idTipoInc');
    }
    
}
