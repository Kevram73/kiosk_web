<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfert extends Model
{
    public function magasin_transfert()
    {
        return $this->belongsTo('App\Boutique','magasin_transfert_id');
    }
    public function magasin_reception()
    {
        return $this->belongsTo('App\Boutique','magasin_reception_id');
    }
}
