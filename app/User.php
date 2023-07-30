<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Role;
use App\Boutique;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'solde'
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
