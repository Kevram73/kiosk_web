<?php

namespace App\Http\Controllers\Api;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Modele;
use App\Prevente;
use App\Historique;
use App\User;
use App\Client;
use App\vente;
use App\Facture;
use App\Http\Resources\SaleResource;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController as BaseController;


class SalesController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display the list sales.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return SaleResource::collection(vente::all());
    }

    public function filter(Request $request){
        $sales = SaleResource::collection(vente::whereBetween("created_at", [$request->beginDate, $request->endDate])->get()->take(10));
        return $this->sendResponse($sales, "Sales retrieved successfully");
    }


    public function store_vente_simple(Request $request)
    {
        if(vente::latest()->first() != null){
            $id=vente::latest()->first()->id;
            $ed = $id + 1;
        } else {
            $ed=1;
        }

        $vente = new vente();
        $vente->numero="VENT".now()->format('Y')."-".$ed;

        $vente->user_id= User::find($request->user_id)->id;
        $vente->client_id= $request->client_id;
        $vente->journal_id= $request->journal_id;
        $vente->type_vente= 1;
        $vente->date_vente= now();
        $vente->boutique_id= User::find($request->user_id)->boutique->id;
        $vente->totaux = $request->prix*$request->quantite - $request->reduction;
        $vente->montant_reduction = $request->reduction;
        $vente->save();


        $total = 0;
        $allReduction = 0;
        foreach($request->product_list as $datum){
            $prevente = new Prevente();
            $prevente->prix = $datum['prix'];
            $prevente->quantite = $datum['qte'];
            $prevente->reduction = $datum['reduction'];
            $prevente->prixtotal = $datum['prix']*$datum['qte'] - $datum['reduction'];
            $prevente->vente_id=$vente->id;
            $prevente->modele_fournisseur_id = $datum['mfid'];
            $prevente->save();
            $total += $datum['prix']*$datum['qte'];
            $allReduction += $datum['reduction'];
        }

        $vente=vente::findOrFail($vente->id);

        if($request->input('tva_on') == true)
        {
            $montant_ht = $total-$allReduction;
            $montant_tva = ($montant_ht * 18)/100;
            $vente->with_tva = true;
            $vente->tva = 18;
            $vente->montant_ht = $montant_ht;
            $vente->montant_tva = $montant_tva;
            $vente->montant_reduction = $allReduction;
            $vente->totaux= $total;
        }else{
            $vente->with_tva = false;
            $vente->totaux = $total;
            $vente->montant_reduction = $allReduction;
        }

        $vente->save();

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Ventes";
        $historique->user_id =$request->user_id;
        $historique->save();


        $facture_id = Facture::latest()->first()->id;
        if($facture_id){
            $fac = $facture_id + 1;
        } else {
            $fac = 1;
        }
        $ed=1+$id;
        $facture=new Facture();
        $facture->prixapayer =$total;
        $facture->montant_reduction = $request->reduction;
        $facture->vente_id = $vente->id;
        $facture ->numero="FACT".now()->format('Y')."-".$fac;
        $facture->save();

        return $this->sendResponse($vente, "Vente effectué avec succès");
    }

    public function store_vente_credit(Request $request)
    {
        // $this->sendResponse($vente, "Vente effectué avec succès");
        if(vente::latest()->first() != null){
            $id=vente::latest()->first()->id;
            $ed = $id + 1;
        } else {
            $ed=1;
        }

        $vente = new vente();
        $vente->numero="VENT".now()->format('Y')."-".$ed;

        $vente->user_id= User::find($request->user_id)->id;
        $vente->client_id= $request->client_id;
        $vente->journal_id= $request->journal_id;
        $vente->type_vente= 2;
        $vente->date_vente= now();
        $vente->boutique_id= User::find($request->user_id)->boutique->id;
        $vente->totaux = $request->prix*$request->quantite - $request->reduction;
        $vente->montant_reduction = $request->reduction;
        $vente->save();


        $total = 0;
        $allReduction = 0;

        foreach($request->product_list as $datum){
            $prevente = new Prevente();
            $prevente->prix = $datum['prix'];
            $prevente->quantite = $datum['qte'];
            $prevente->reduction = $datum['reduction'];
            $prevente->prixtotal = $datum['prix']*$datum['qte'] - $datum['reduction'];
            $prevente->vente_id=$vente->id;
            $prevente->modele_fournisseur_id = $datum['mfid'];
            $prevente->save();
            $total += $datum['prix']*$datum['qte'];
            $allReduction += $datum['reduction'];
        }
        if($request->client_id != 0){
            $client = Client::find($request->client_id);
            $client->solde += $total;
            $client->save();
        }

        $vente=vente::findOrFail($vente->id);

        if($request->input('tva_on') == true)
        {
            $montant_ht = $total-$allReduction;
            $montant_tva = ($montant_ht * 18)/100;
            $vente->with_tva = true;
            $vente->tva = 18;
            $vente->montant_ht = $montant_ht;
            $vente->montant_tva = $montant_tva;
            $vente->montant_reduction = $allReduction;
            $vente->totaux= $total;
        }else{
            $vente->with_tva = false;
            $vente->totaux = $total;
            $vente->montant_reduction = $allReduction;
        }

        $vente->save();

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Ventes";
        $historique->user_id =$request->user_id;
        $historique->save();


        $facture_id = Facture::latest()->first()->id;
        if($facture_id){
            $fac = $facture_id + 1;
        } else {
            $fac = 1;
        }
        $ed=1+$id;
        $facture=new Facture();
        $facture->prixapayer =$total;
        $facture->montant_reduction = $request->reduction;
        $facture->vente_id = $vente->id;
        $facture ->numero="FACT".now()->format('Y')."-".$fac;
        $facture->save();

        return $this->sendResponse($vente, "Vente effectué avec succès");
    }
    public function store_vente_nonlivre(Request $request)
    {
        // $this->sendResponse($vente, "Vente effectué avec succès");
        if(vente::latest()->first() != null){
            $id=vente::latest()->first()->id;
            $ed = $id + 1;
        } else {
            $ed=1;
        }

        $vente = new vente();
        $vente->numero="VENT".now()->format('Y')."-".$ed;

        $vente->user_id= User::find($request->user_id)->id;
        $vente->client_id= $request->client_id;
        $vente->journal_id= $request->journal_id;
        $vente->type_vente= 3;
        $vente->date_vente= now();
        $vente->boutique_id= User::find($request->user_id)->boutique->id;
        $vente->totaux = $request->prix*$request->quantite - $request->reduction;
        $vente->montant_reduction = $request->reduction;
        $vente->save();


        $total = 0;
        $allReduction = 0;
        foreach($request->product_list as $datum){
            $prevente = new Prevente();
            $prevente->prix = $datum['prix'];
            $prevente->quantite = $datum['qte'];
            $prevente->reduction = $datum['reduction'];
            $prevente->prixtotal = $datum['prix']*$datum['qte'] - $datum['reduction'];
            $prevente->vente_id=$vente->id;
            $prevente->modele_fournisseur_id = $datum['mfid'];
            $prevente->save();
            $total += $datum['prix']*$datum['qte'];
            $allReduction += $datum['reduction'];
        }

        $vente=vente::findOrFail($vente->id);

        if($request->input('tva_on') == true)
        {
            $montant_ht = $total-$allReduction;
            $montant_tva = ($montant_ht * 18)/100;
            $vente->with_tva = true;
            $vente->tva = 18;
            $vente->montant_ht = $montant_ht;
            $vente->montant_tva = $montant_tva;
            $vente->montant_reduction = $allReduction;
            $vente->totaux= $total;
        }else{
            $vente->with_tva = false;
            $vente->totaux = $total;
            $vente->montant_reduction = $allReduction;
        }

        $vente->save();

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Ventes";
        $historique->user_id =$request->user_id;
        $historique->save();


        $facture_id = Facture::latest()->first()->id;
        if($facture_id){
            $fac = $facture_id + 1;
        } else {
            $fac = 1;
        }
        $ed=1+$id;
        $facture=new Facture();
        $facture->prixapayer =$total;
        $facture->montant_reduction = $request->reduction;
        $facture->vente_id = $vente->id;
        $facture ->numero="FACT".now()->format('Y')."-".$fac;
        $facture->save();

        return $this->sendResponse($vente, "Vente effectué avec succès");

    }

    public function store_vente_gros(Request $request)
    {
        // $this->sendResponse($vente, "Vente effectué avec succès");
        if(vente::latest()->first() != null){
            $id=vente::latest()->first()->id;
            $ed = $id + 1;
        } else {
            $ed=1;
        }

        $vente = new vente();
        $vente->numero="VENT".now()->format('Y')."-".$ed;

        $vente->user_id= User::find($request->user_id)->id;
        $vente->client_id= $request->client_id;
        $vente->journal_id= $request->journal_id;
        $vente->type_vente= 4;
        $vente->date_vente= now();
        $vente->boutique_id= User::find($request->user_id)->boutique->id;
        $vente->totaux = $request->prix*$request->quantite - $request->reduction;
        $vente->montant_reduction = $request->reduction;
        $vente->save();


        $total = 0;
        $allReduction = 0;
        foreach($request->product_list as $datum){
            $prevente = new Prevente();
            $prevente->prix = $datum['prix'];
            $prevente->quantite = $datum['qte'];
            $prevente->reduction = $datum['reduction'];
            $prevente->prixtotal = $datum['prix']*$datum['qte'] - $datum['reduction'];
            $prevente->vente_id=$vente->id;
            $prevente->modele_fournisseur_id = $datum['mfid'];
            $prevente->save();
            $total += $datum['prix']*$datum['qte'];
            $allReduction += $datum['reduction'];
        }

        $vente=vente::findOrFail($vente->id);

        if($request->input('tva_on') == true)
        {
            $montant_ht = $total-$allReduction;
            $montant_tva = ($montant_ht * 18)/100;
            $vente->with_tva = true;
            $vente->tva = 18;
            $vente->montant_ht = $montant_ht;
            $vente->montant_tva = $montant_tva;
            $vente->montant_reduction = $allReduction;
            $vente->totaux= $total;
        }else{
            $vente->with_tva = false;
            $vente->totaux = $total;
            $vente->montant_reduction = $allReduction;
        }

        $vente->save();

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Ventes";
        $historique->user_id =$request->user_id;
        $historique->save();


        $facture_id = Facture::latest()->first()->id;
        if($facture_id){
            $fac = $facture_id + 1;
        } else {
            $fac = 1;
        }
        $ed=1+$id;
        $facture=new Facture();
        $facture->prixapayer =$total;
        $facture->montant_reduction = $request->reduction;
        $facture->vente_id = $vente->id;
        $facture ->numero="FACT".now()->format('Y')."-".$fac;
        $facture->save();

        return $this->sendResponse($vente, "Vente effectué avec succès");
    }


    public function create(Request $request)
    {

        $data = $request->input('sale');
        $user_id=$data['user_id'] ;
        $boutique_id = ['boutique_id'];
        $client_id=$data['client_id'] ;
        $type_vente=$data['type_vente'];
        $with_tva=$data['with_tva'];
        $tva_value=$data['tva_value'];
        $montant_ht = $data['montant_ht'];
        $montant_tva = $data['montant_tva'];
        $montant_reduction = $data['montant_reduction'];
        $product_product_list = $data['products'] ;


        // get the higher value of the journals.
        $_journal_max=DB::table('journals')->max('id');
        $_vente_max=DB::table('ventes')->max('id');
        $_e_vente_max = $_vente_max + 1;
        DB::beginTransaction();
        // prepopluate vente table and save its;
        $_vente=new vente();
        $_vente->numero="VENT".now()->format('Y')."-".$_e_vente_max ;
        $_vente->date_vente = now();
        $_vente->user_id=$user_id;
        $_vente->client_id=$client_id;
        $_vente->journal_id=$_journal_max;
        $_vente->type_vente=$type_vente;
        $_vente->boutique_id=$boutique_id;
        $_vente->save();
        // continue.
        $_total = 0 ;
        $_allReductions = 0;

        // populate prevente table.
        foreach ($product_product_list as $item)
        {
        $prevente = new Prevente();
        $prevente->modele_fournisseur_id =$item.model_id ;
        $prevente->prix =$item.prix ;
        $prevente->quantite =$item.qty ;
        $prevente->reduction =$item.reduction ;
        $prevente->prixtotal=$item.total_cost;
        $prevente->vente_id=$_vente->id();
        $prevente->save();

        // check if their is a models like that in store.
        $check_model_in_store = Modele::findOrFail($item.model_id) ;
        if($check_model_in_store != null)
        {
          if($check_model_in_store->quantite < $prevente->quantite)
          {
              DB::rollBack();
              return response()->json([
                  'message'=> 'Attention quantité de stock inferieur',

              ]) ;
          }
        }
        // if there is item in store process to the substraction.
        $check_model_in_store->quantite = $check_model_in_store - $prevente->quantite ;
        $check_model_in_store->update() ;

        $_total = $_total + $prevente->prixtotal;
        $_allReductions = $_allReductions + $prevente->reduction;
        }
        // commit to the db
        DB::commit();
        // add tva
        $vente_new = vente::findOrFail($_vente->id) ;
        if($with_tva == true)
        {
            $montant_ht = $_total ;
            $montant_tva = ($_total * $tva_value) / 100 ;
            $vente_new->with_tva= true ;
            $vente_new->montant_tva = $montant_tva ;
            $vente_new->totaux = $montant_ht + $montant_tva ;

        }else {
            // TODO : COMPLETE//
            $vente_new->with_tva = false ;
            $vente_new->totaux = $_total ;
        }

        $vente_new->update() ;

        return response()->json($user_id);

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




    /**  Return the list of all products and their models.
     * @param $Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list_products()
    {
        $product_list = Db::table('produits')->get();

        return response()->json($product_list->toArray());
    }

    /**
     * Return the list of all article categories.
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function list_products_category()
    {
        $category_list = Categorie::all() ;
        return response()->json($category_list->toArray()) ;
    }

    public function list_products_models()
    {
       // $model = Db::table('modeles')->get();
        $model = Modele::all();
        return response()->json($model->toArray()) ;
    }

    /**
     *  Create a sale with corresponding data
     * @param $Request
     * @return void
     */
    public function create_sale(Request $request)
    {  $product_with_qte = [] ;
        $sale_data = [] ;
    }

    /**
     *  Return the list of sales.
     * @param $Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list_sales_with_products(){
        //$sale_details = DB::table('ventes')->find($id);
        $sales = DB::table('ventes')->join('preventes',function ($join){
            // get all ventes maching preventes.
           $join->on('preventes.vente_id','=','ventes.id');
        })->join('modeles', function ($join) {
                $join->on('modeles.id', '=', 'preventes.modele_fournisseur_id');
            })->join('produits', function ($join) {
                $join->on('produits.id', '=', 'modeles.produit_id');
            })
            //->where('ventes.id','=',$id)
            ->select('ventes.numero as numero',

                'ventes.id as id',
                'ventes.date_vente as date',
                'ventes.facture as facture',
                'modeles.libelle as modele',
                'produits.nom as produit',
                'preventes.quantite as quantite',
                'preventes.prix as prix',
                'preventes.prixtotal as prixtotal',
                'ventes.created_at as create',
                'ventes.updated_at as update',
                'ventes.type_vente as type_vente'
            )

            //->groupBy('ventes.id','ventes.numero')
            ->get();







        return response()->json($sales->toArray()) ;
    }

    public function list_all_product(Request $request,$vente_id){


    }




}
