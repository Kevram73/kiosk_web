<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livraisonvente extends Model
{
    protected $table="livraison_ventes";

    public function livraisonLigne(){
        return LivraisonVenteS::find($this->livraison_v_id);
    }

    public function prevente()
    {
        return $this->belongsTo(Prevente::class, 'prevente_id');
    }
}
