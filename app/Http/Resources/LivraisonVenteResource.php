<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LivraisonVenteResource extends JsonResource
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
            "numero" => $this->numero,
            "date_livraison" => $this->date_livraison,
            "boutique_id" => $this->boutique_id,
            "parent" => $this->livraison(),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
