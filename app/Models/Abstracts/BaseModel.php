<?php

namespace App\Models\Abstracts;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * Class BaseModel
 * @package App\Models\Abstracts
 *
 * Autocomplete the Builder methods
 * @mixin Eloquent
 * @mixin Builder
 * @mixin \Illuminate\Database\Query\Builder
 *
 */
abstract  class BaseModel extends Model
{

}
