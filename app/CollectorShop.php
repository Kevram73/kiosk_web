<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectorShop extends Model
{
    protected $fillable = [
        'collector_id',
        'shop_id',
        'status',
        'date'
    ];

    public function users()
    {
        return User::where('boutique_id', $this->shop_id)->get();
    }

    public function shop(){
        return Boutique::find($this->shop_id);
    }
}
