<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prevente extends Model
{
    public function modelefournisseur(){
        return modeleFournisseur::find($this->modele_fournisseur_id);
    }
}

