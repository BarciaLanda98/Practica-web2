<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\estudiante;

class paralelo extends Model
{
    //
    protected $fillable=['nombre'];

    public function estudiante(){
        return $this->hasMany(estudiante::class);
    }
}
