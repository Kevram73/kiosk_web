<?php

namespace App\Http\Controllers\Api;

use App\Historique;
use App\Http\Controllers\Controller;
use App\LivraisonV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    $livraison = DB::table('livraison_ventes')
        ->join('livraison_v_s',function ($join){
        $join->on('livraison_ventes.livraison_v_id','=','livraison_v_s.id');
    })->join('preventes',function ($join){
        $join->on('preventes.id','=','livraison_ventes.prevente_id') ;
        })
        ->join('modeles',function ($join){
            $join->on('preventes.modele_fournisseur_id','=','modeles.id');
        })
        ->join('produits',function ($join){
            $join->on('produits.id','=','modeles.produit_id') ;
        })
        ->get() ;

    $preventes =DB::table('preventes')
        ->join('modeles',function ($join){
            $join->on('preventes.modele_fournisseur_id','=','modeles.id');
        })
        ->join('produits',function ($join){
            $join->on('produits.id','=','modeles.produit_id') ;
        })
        ->join('livraison_ventes',function ($join){
            $join->on('livraison_ventes.prevente_id','=','preventes.id') ;
        })
        ->get();

    //$prevente = DB::table('preventes')->join('modeles',function ($join){
     //   $join->on('preventes.modele_fournisseur_id','=','modeles.id');
    //})->get();
    //$historique = new Historique() ;
    //$historique->actions = 'Liste';
    //$historique->cible = "Livraison";
    //$historique->user_id =$user_id;
    //$historique->save();

    return response()->json([
        'livraisons'=> $preventes
    ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$vente_id = $request->input('vente_id') ;
        //$product_id = $request->input('product_id');
        //$model_id = $request->input('modele_product');
        //$qte_delyvered = $request->input('qte_delivered') ;

        /**
         * $prevente = DB::table('preventes',function ($join){
        $join->on('mode')
        });
         */
        $user_id = $request->input('user_id') ;
        $vente_id =$request->input('vente_id');

        // Create a nd save historique for the livraison.
        $historique = new Historique();
        $historique->action = "Creer";
        $historique->cible = "Livraisons";
        $historique->user_id = $user_id;
        $historique->save();


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
