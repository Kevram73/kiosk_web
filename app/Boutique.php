<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boutique extends Model
{
    protected $fillable = [
        'nom','telephone','adresse'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function commande(){
        return $this->belongsTo('App\Commande');
    }

    public function recettes(){
        return $this->hasMany('App\Reccete', 'boutique_id');
    }

    public function settings()
    {
        return $this->belongsToMany('App\Setting', 'boutique_settings', 'boutique_id', 'setting_id')
                    ->withPivot(["is_active", "key", "value"])
                    ->withTimestamps();
    }

    public function users(){
        return User::where('boutique_id', $this->id)->get();
    }
}
