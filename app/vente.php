<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vente extends Model
{
    public function preventes(){
        $preventes = Prevente::where("vente_id", $this->id)->get();
        return $preventes;
    }
    public function caisse(){
        // $caisse = CaisseBoutique::where('boutique_id', $this->boutique_id)->get()->first();
        // return $caisse;
    }

    public function client(){
        $client = Client::find($this->client_id);
        return $client;
    }
    public function boutique(){
        $boutique = Boutique::find($this->boutique_id);
        return $boutique;
    }

    public function user(){
        $user = User::find($this->user_id);
        return $user;
    }
}
