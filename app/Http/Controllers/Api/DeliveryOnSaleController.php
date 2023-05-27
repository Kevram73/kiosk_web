<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Historique;
use App\vente;
use App\Livraisonvente;
use App\Prevente;
use App\LivraisonVenteS;
use Illuminate\Http\Request;
use App\Http\Resources\LivraisonVenteResource;
use App\Http\Resources\SaleResource;

class DeliveryOnSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $livraisons = LivraisonVenteS::all();
        return LivraisonVenteResource::collection($livraisons);
    }

    public function ventes_non_livrees(){
        $ventes = vente::where('type_vente', 3)->get();
        return SaleResource::collection($ventes);
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
