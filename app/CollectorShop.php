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
}
