<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Historique;
use App\vente;
use App\Livraisonvente;
use App\Prevente;
use App\LivraisonVenteS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\LivraisonVenteResource;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\SaleResource;

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
            $preventes = Prevente::where("vente_id", $vente_id)->get();
            foreach($preventes as $prevent){
                $preventeIds[] = $prevent->id;
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
        
        return $notInAndGoodIn;
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
        $lineLiv = new LivraisonVenteS();
        $lineLiv->numero = $request->numero;
        $lineLiv->date_livraison = now();
        $lineLiv->boutique_id = $request->boutique_id;
        $lineLiv->created_at = now();
        $lineLiv->updated_at = now();
        $lineLiv->save();

        $livraison = new Livraisonvente();
        $livraison->quantite_livre += $request->qte;
        $prevente = Prevente::find($request->prevente_id);
        $prevente->quantite -= $request->qte;
        $prevente->save();
        $livraison->quantite_restante = $prevente->quantite - $livraison->quantite_livre;
        $livraison->prevente_id = $request->prevente_id;
        $livraison->livraison_v_id = $lineLiv->id;
        $livraison->created_at = now();
        $livraison->updated_at = now();
        $livraison->save();

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Livraisons";
        $historique->user_id = $request->user_id;
        $historique->save();

        return response()->json([
            'status' => 'success',
            'livraison' => $livraison,
            'line' => $lineLiv
        ], 201);
    }


}
