<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prevente extends Model
{
    public function  modelefournisseur(){
        return $this->hasMany('App\modeleFournisseur');
    }
}

