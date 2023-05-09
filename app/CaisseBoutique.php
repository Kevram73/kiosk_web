<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaisseBoutique extends Model
{
    protected $fillable = [
        "boutique_id",
        "solde_total",
        "active"
    ];
}
