<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\paralelo;

class estudiante extends Model
{
    //activar function para poder agregar registros desde este modelo
    protected $fillable=['nombre','cedula','correo','paralelo_id'];

    //activar la funcion que me permita relacioanr con las otras tablas
    public function paralelo(){
        return $this->belongsTo(paralelo::class);
    }
}
