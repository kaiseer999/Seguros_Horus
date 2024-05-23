<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleador extends Model
{
    use HasFactory;

    protected $primaryKey = 'numeroEmpleador';


    public function Incapacidade(){
        return $this->hasMany('App\Models\Incapacidade');
    }


    

    protected $fillable=[
        'numeroEmpleador',
        'nombreEmpleador',
    ];
}
