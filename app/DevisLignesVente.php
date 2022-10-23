<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevisLignesVente extends Model
{
    public function  modelefournisseur(){
        return $this->hasMany('App\modeleFournisseur');
    }
}

