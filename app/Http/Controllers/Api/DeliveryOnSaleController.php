<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Historique;
use App\Livraisonvente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\LivraisonVenteResource;


class DeliveryOnSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // prevente livraisons.
    public function index(Request $request)
    {
        $livraisons = Livraisonvente::all();
        return LivraisonVenteResource::collection(livraison::all());
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
        $livraison = new LivraisonV();
        $livraison ->numero="LIV-VENT".now()->format('Y')."-".$ed;
        $livraison ->date_livraison= now();
        $livraison ->boutique_id= User::find($request->user_id)->boutique->id;
        $livraison->save();
    }


}
