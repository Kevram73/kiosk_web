<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevisVente extends Model
{
    public function boutique(){
        return Boutique::find($this->boutique_id);
    }

    public function user(){
        return User::find($this->user_id);
    }

    public function client(){
        return Client::find($this->client_id);
    }
}
