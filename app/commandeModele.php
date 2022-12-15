<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commandeModele extends Model
{
    public  function commande(){

        return $this->belongsTo('App\Commande');
    }
    public  function modeleFournisseur(){
        return $this->belongsTo('App\modeleFournisseur');
    }
}
