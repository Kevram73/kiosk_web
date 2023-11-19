<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReglementResource extends JsonResource
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
            "montant_donne" => $this->montant_donne,
            "montany_restant" => $this->montant_restant,
            "total" => $this->total,
            "client_id" => $this->client_id,
            "date_reglement" => $this->date_reglement,
            "client" => $this->client(),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
