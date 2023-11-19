<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nom" => $this->nom,
            "telephone" => $this->telephone,
            "adresse" => $this->adresse,
            "users" => $this->users(),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
