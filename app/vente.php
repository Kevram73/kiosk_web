<?php

namespace App;
use App\Http\Resources\PreventeResource;
use Illuminate\Database\Eloquent\Model;

class vente extends Model
{
    public function preventes(){
        $preventes = Prevente::where("vente_id", $this->id)->get();
        return $preventes;
    }

    public function caisse(){
        // $caisse = CaisseBoutique::where('boutique_id', $this->boutique_id)->get()->first();
        // return $caisse;
    }

    public function client(){
        $client = Client::find($this->client_id);
        return $client;
    }
    public function boutique(){
        $boutique = Boutique::find($this->boutique_id);
        return $boutique;
    }

    public function user(){
        $user = User::find($this->user_id);
        return $user;
    }

    public function incompletedPrevente(){
        $preventeIds= [];
        $preventes = Prevente::where("vente_id", $this->id)->get();
        foreach($preventes as $prevent){
            array_push($preventeIds, $prevent->id);
        }

        $notInAndGoodIn = [];
        $livraisons = Livraisonvente::all();
        for($i=0; $i<count($preventeIds); $i++){
            $isPresent = false;

            foreach ($livraisons as $livraison) {
                if ($livraison->prevente_id == $preventeIds[$i]) {
                    $isPresent = true;
                    if ($livraison->quantite_restante > 0) {
                        array_push($notInAndGoodIn, $preventeIds[$i]);
                    }
                    break;
                }
            }
            if (!$isPresent) {
                array_push($notInAndGoodIn, $preventeIds[$i]);
            }
        }
        $uniqueArray = array_values(array_unique($notInAndGoodIn));
        $preventesResult = [];
        for($i=0; $i<count($uniqueArray); $i++){
            $prevente = Prevente::find($uniqueArray[$i]);
            array_push($preventesResult, $prevente);
        }
        $results = array_values(array_unique($preventesResult));
        return PreventeResource::collection($results);
    }
}
