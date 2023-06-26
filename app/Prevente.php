<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prevente extends Model
{
    public function modelefournisseur(){
        if(Modele::find($this->modele_fournisseur_id)){
            return Modele::find($this->modele_fournisseur_id)->libelle;
        }
        return "";
    }

    public function product(){
        $produit_id = Modele::find($this->modele_fournisseur_id)->produit_id;
        $productName = Produit::find($produit_id)->nom;
        return $productName;
    }
}
