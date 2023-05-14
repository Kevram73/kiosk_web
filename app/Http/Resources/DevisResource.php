<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DevisResource extends JsonResource
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
            "user_id" => $this->user_id,
            "client_id" => $this->client_id,
            "date_devis" => $this->date_devis,
            "filename" => $this->filename,
            "boutique_id" => $this->boutique_id,
            "with_tva" => $this->with_tva,
            "tva" => $this->tva,
            "montant_tva" => $this->montant_tva,
            "montant_ht" => $this->montant_ht,
            "montant_reduction" => $this->montant_reduction,
            "totaux" => $this->totaux,
            "boutique" => $this->boutique(),
            "user" => $this->user(),
            "client" => $this->client(),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
