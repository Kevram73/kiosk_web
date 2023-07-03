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
}
