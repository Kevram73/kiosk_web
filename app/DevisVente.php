<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevisVente extends Model
{
    public function boutique(){
        return $this->belongsTo('App\Boutique');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
