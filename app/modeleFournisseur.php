<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modeleFournisseur extends Model
{
    public  function fournisseur(){

    return $this->belongsTo('App\Fournisseur');
}
    public function modele(){
        $modele = Modele::find($this->modele_id);
        $libelle = $modele->libelle;
        $produit = Produit::find($modele->produit_id)->nom;
        return "Modele: $libelle, produit: $produit";
    }

    public function produit(){
    }
    public  function commande(){

        return $this->belongsTo('App\Commande');
    }
    public function  commandeModele(){
        return $this->hasMany('App\commandeModele');
    }
}
