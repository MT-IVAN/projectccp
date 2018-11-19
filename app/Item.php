<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function prueba(){
    	return $this->belongsTo(Prueba::class);
    }

    public function resultados(){
    	return $this->hasMany(Resultado::class);
    }
}
