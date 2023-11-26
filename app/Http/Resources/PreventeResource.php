<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PreventeResource extends JsonResource
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
            "quantite" => $this->quantite,
            "prix" => $this->prix,
            "reduction" => $this->reduction,
            "prixtotal" => $this->prixtotal,
            "modele_fournisseur_id" => $this->modele_fournisseur_id,
            "modele_produit" => $this->modelefournisseur(),
            // "produit" => $this->product(),
            "vente_id" => $this->vente_id,
            "etat" => $this->etat,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
