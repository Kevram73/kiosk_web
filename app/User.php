<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\modelHasRole;
use App\Role;
use App\Boutique;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function caisse()
    {
        return $this->hasOne('App\Caisse');
    }

    public function boutique()
    {
        return $this->belongsTo('App\Boutique');
    }

    public function role()
    {
        try {
            $roleId = \App\Models\ModelHasRole::where("model_type", "App\User")
                ->where("model_id", $this->id)->first()->role_id;

            return Role::whereId($roleId)->first();
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function recettes()
    {
        return $this->hasMany('App\Reccete', 'user_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
}
