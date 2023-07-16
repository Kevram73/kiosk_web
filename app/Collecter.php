<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collecter extends Model
{
    protected $table = 'collecters';

    protected $fillable = [
        'date',
        'boutique_id',
        'user_id_collecteur',
        'etat',
        'user_id_gerant',
        'montant'
    ];

    public function gerant(){
        $user = User::find($this->user_id_gerant);
        return $user->nom + " " + $user->prenom;
    }

    public function collecteur(){
        $user = User::find($this->user_id_collecteur);
        return $user->nom + " " + $user->prenom;
    }

    public function shop(){
        return Boutique::find($this->boutique_id)->nom;
    }
}
