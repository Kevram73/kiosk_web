<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReglementAchat extends Model
{
    protected $guarded  = [
        'id'
    ];

    public function boutique(){
        return $this->belongsTo('App\Boutique');
    }
}
