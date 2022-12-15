<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provision extends Model
{
    public  function fournisseur(){

        return $this->belongsTo('App\Fournisseur');
    }
    public  function produit(){

        return $this->belongsTo('App\Produit');
    }
    public  function produitProvision(){

        return $this->belongsTo('App\produitProvision');
    }


}
