<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalDepense extends Model
{
    protected $guarded  = [
        'id'
    ];

    public function boutique(){
        return $this->belongsTo('App\Boutique');
    }
}
