<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    public function  modeleFournisseur(){
         return $this->hasMany('App\modeleFournisseur');
    }

    public function recettes(){
        return $this->hasMany('App\Reccete', 'fournisseur_id');
    }

}
