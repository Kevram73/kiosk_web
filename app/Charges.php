<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charges extends Model
{
    public function boutique(){
        return $this->belongsTo('App\Boutique');
    }
}
