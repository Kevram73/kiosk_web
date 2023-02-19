<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    //

    public function agences (): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        //return $this->belongsTo('App\AgenceBanque');
        return $this->hasMany('App\AgenceBanque','agence_banques.id','id') ;
    }


}
