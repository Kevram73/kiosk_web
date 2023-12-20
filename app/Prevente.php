<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prevente extends Model
{
    public function vente()
    {
        return $this->belongsTo(vente::class, 'vente_id');
    }

    public function livraisonVentes()
    {
        return $this->hasMany(Livraisonvente::class, 'prevente_id');
    }

    public function modelefournisseur(){
        if(Modele::find($this->modele_fournisseur_id)){
            return Modele::find($this->modele_fournisseur_id)->libelle;
        }
        return "";
    }

    public function product(){
        $modele = Modele::find($this->modele_fournisseur_id);
        if($modele == null){
            return "";
        }
        $produit_id = $modele->produit_id;

        if(Produit::find($produit_id)){
            $productName = Produit::find($produit_id)->nom;
            return $productName;
        }

        return "";

    }
}
