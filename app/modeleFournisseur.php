<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modeleFournisseur extends Model
{
    public  function fournisseur(){

    return $this->belongsTo('App\Fournisseur');
}
    public  function modele(){

        return $this->belongsTo('App\Modele');
    }
    public  function produit(){

        return $this->belongsTo('App\Produit');
    }
    public  function commande(){

        return $this->belongsTo('App\Commande');
    }
    public function  commandeModele(){
        return $this->hasMany('App\commandeModele');
    }
}
