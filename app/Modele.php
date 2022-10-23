<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    public function produit(){
        return $this->belongsTo('App\Produit');
    }
    public  function modeleFournisseur(){
        return $this->hasMany('App\modeleFournisseur');
    }
    public function boutique(){
        return $this->belongsTo('App\Boutique');
    }

}
