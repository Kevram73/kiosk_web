<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollecteResource extends JsonResource
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
            "collector" => $this->gerant(),
            "gerant" => $this->collecteur(),
            "shop" => $this->shop(),
            "amount" => $this->montant,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
