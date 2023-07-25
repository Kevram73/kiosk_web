<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    protected $fillable = [
        "nature",
        "montant",
        "statut",
        "compte_id",
        "user_id",
        "date",
        "description"
    ];

    
}
