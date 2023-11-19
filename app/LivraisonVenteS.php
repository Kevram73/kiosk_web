<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LivraisonVenteS extends Model
{
    protected $table="livraison_v_s";

    public function livraison(){
        return Livraisonvente::where("livraison_v_id", $this->id)->get();
    }
}
