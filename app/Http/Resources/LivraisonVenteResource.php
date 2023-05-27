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
            "quantite_livre" => $this->quantite_livre,
            "quantite_restante" => $this->quantite_restante,
            "prevente_id" => $this->prevente_id,
            "livraison_v_id" => $this->livraison_v_id,
            "prevente" => $this->prevente(),
            "livraisonLigne" => $this->client(),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
