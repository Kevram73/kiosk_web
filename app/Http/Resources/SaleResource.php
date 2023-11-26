<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            "client_id"=> $this->client_id,
            "user_id" => $this->user_id,
            "journal_id" => $this->journal_id,
            "type_vente" => $this->type_vente,
            "date_vente" => $this->date_vente,
            "boutique_id" => $this->id,
            "with_tva"=> $this->with_tva,
            "tva" => $this->tva,
            "montant_tva" => $this->montant_tva,
            "montant_ht" => $this->montant_ht,
            "montant_reduction" => $this->montant_reduction,
            "totaux" => $this->totaux,
            "facture" => $this->facture,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "prevente" => PreventeResource::collection($this->preventes()),
            "client" => $this->client(),
            "boutique" => $this->boutique(),
            "user" => $this->user(),
        ];
    }
}
