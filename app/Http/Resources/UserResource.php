<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "sexe" => $this->sexe,
            "email" => $this->email,
            "contact" => $this->contact,
            "api_token" => $this->api_token,
            "flag_etat" => $this->flag_etat,
            "boutique_id" => $this->boutique_id,
            "solde" => $this->solde,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "role" => $this->role
        ];
    }
}
