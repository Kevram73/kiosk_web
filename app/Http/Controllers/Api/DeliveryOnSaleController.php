<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Historique;
use App\vente;
use App\Livraisonvente;
use App\LivraisonV;
use App\Modele;
use App\Prevente;
use App\LivraisonVenteS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\LivraisonVenteResource;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\SaleResource;
use App\Http\Resources\SaleCResource;

class DeliveryOnSaleController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $livraisons = LivraisonVenteS::orderBy('created_at', 'desc')->get()->take(10);
        return $this->sendResponse($livraisons, "Deliveries retrieved successfully.");
        // return LivraisonVenteResource::collection($livraisons);
    }


    public function ventes_non_livrees(){

        $boutiqueId = auth()->user()->boutique_id;

        $ventes = vente::where('type_vente', 3)
            ->where('boutique_id', $boutiqueId)
            ->get();
        $preventeIds = [];
        foreach ($ventes as $vente) {
            $preventes = Prevente::where("vente_id", $vente->id)->get();
            foreach($preventes as $prevent){
                array_push($preventeIds, $prevent->id);
            }
        }
        $notInAndGoodIn = [];
        $livraisons = Livraisonvente::all();
        for($i=0; $i<count($preventeIds); $i++){
            foreach($livraisons as $livraison){
                if($livraison->prevente_id=$preventeIds[$i]){
                    if($livraison->quantite_restante == 0)
                        array_push($notInAndGoodIn, $preventeIds[$i]);
                } else {
                    array_push($notInAndGoodIn, $preventeIds[$i]);
                }
            }
        }
        $uniqueArray = array_values(array_unique($notInAndGoodIn));
        $ventesResult = [];
        for($i=0; $i<count($uniqueArray); $i++){
            $prevente = Prevente::find($uniqueArray[$i]);
            $vente = vente::find($prevente->vente_id);
            array_push($ventesResult, $vente);
        }

        $results = array_values(array_unique($ventesResult));
        return SaleCResource::collection($results);

    }

    public function filter(Request $request){
        $livraisons = LivraisonVenteS::whereBetween('created_at', [$request->beginDate, $request->endDate])->get();
        return $this->sendResponse($livraisons, "Deliveries retrieved successfully.");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $id=DB::table('livraison_v_s')->max('id');
        $ed=1+$id;
        $livraison = new LivraisonV();
        $livraison ->numero="LIV-VENT".now()->format('Y')."-".$ed;
        $livraison ->date_livraison= now();
        $livraison ->boutique_id= auth()->user()->boutique->id;
        $livraison->save();

        $alllivraison= explode( ',', $request->input('livTable') );
        for ($i =0 ;$i<count($alllivraison);$i+=2) {
            $commande_modele = DB::table('preventes')->find($alllivraison[$i]);
            $quantite_livre= DB::table('livraison_ventes')
                    ->where('prevente_id', $alllivraison[$i])
                    ->sum('quantite_livre');

            $livraisonvente = new Livraisonvente();
            $livraisonvente->livraison_v_id=$livraison ->id;
            $livraisonvente->prevente_id=$alllivraison[$i];
            $livraisonvente->quantite_livre =$alllivraison[$i];
            $livraisonvente->quantite_restante =$commande_modele->quantite - $quantite_livre - $alllivraison[$i];
            $livraisonvente->save();

            $modele= Modele::findOrFail($commande_modele->modele_fournisseur_id);
            $modele->quantite=$modele->quantite- $livraisonvente ->quantite_livre;
            $modele->update();

            if ($livraisonvente->quantite_restante==0){
                DB::table('preventes')
                    ->where('id',$alllivraison[$i])
                    ->update(['etat' => false]);
            }
        }

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Livraisons";
        $historique->user_id =auth()->user()->id;
        $historique->save();

        DB::commit();

        return response()->json([
            'status' => 'success',
            'livraison' => $livraisonvente,
            'line' => $livraison
        ], 201);
    }


}
