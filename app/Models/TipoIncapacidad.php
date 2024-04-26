<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIncapacidad extends Model
{
    use HasFactory;

    public function Incapacidade(){
        return $this->hasMany('App\Models\Incapacidade');
    }
}
