<?php

namespace App\Http\Controllers\Api;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Modele;
use App\Prevente;
use App\Historique;
use App\vente;
use App\Facture;
use App\Http\Resources\SaleResource;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SalesController extends Controller
{
    /**
     * Display the list sales.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return SaleResource::collection(vente::all());
    }


    public function store_vente_simple(Request $request)
    {
        $id=vente::latest()->first()->id;
        if($id){
            $ed = $id + 1;
        } else {
            $ed=1;
        }

        $vente = new vente();
        $vente->numero="VENT".now()->format('Y')."-".$ed;

        $vente->user_id= Auth::user()->id;
        $vente->client_id= $request->client_id;
        $vente->journal_id= $request->journal_id;
        $vente->type_vente= 1;
        $vente->date_vente= now();
        $vente->boutique_id= Auth::user()->boutique->id;
        $vente->totaux = $request->prix*$request->quantite - $request->reduction;
        $vente->montant_reduction = $request->reduction;
        $vente->save();


        $total = 0;
        $allReduction = 0;

        $prevente = new Prevente();
        $prevente->prix = $request->prix;
        $prevente->reduction = $request->reduction;
        $prevente->prixtotal = $request->prix*$request->quantite - $request->reduction;
        $prevente->vente_id=$vente->id;
        $prevente->modele_fournisseur_id = $request->modele_fournisseur_id;
        $prevente->save();

        $vente=vente::findOrFail($vente->id);

        if($request->input('setTva') == 1)
        {
            $montant_ht = $request->prix*$request->quantite - $request->reduction;
            $montant_tva = ($montant_ht * $request->tva)/100;
            $vente->with_tva = true;
            $vente->tva = $request->tva;
            $vente->montant_ht = $montant_ht;
            $vente->montant_tva = $montant_tva;
            $vente->totaux= $montant_ht + $montant_tva;
        }else{
            $vente->with_tva = false;
            $vente->totaux = $request->prix*$request->quantite - $request->reduction;
        }

        $vente->save();

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Ventes";
        $historique->user_id =Auth::user()->id;
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

        return SaleResource::collection($vente);
    }

    public function store_vente_credit(Request $request)
    {
        $allcommande= explode( ',', $request->input('venTable') );
        $i=DB::table('journals')->max('id');
        $id=DB::table('ventes')->max('id');
        $ed=1+$id;
        DB::beginTransaction();
        $vente = new vente();
        $vente ->numero="VENT".now()->format('Y')."-".$ed;
        $vente ->date_vente= now();
        $vente ->client_id= $allcommande[1];
        $vente ->user_id= Auth::user()->id;
        $vente ->journal_id= $i;
        $vente ->type_vente= 2;
        $vente ->boutique_id= Auth::user()->boutique->id;
        $vente->save();
        $total = 0;
        $allReduction = 0;

        for ($i =0 ;$i<count($allcommande);$i+=5) {
            $prevente = new Prevente();
            $prevente ->modele_fournisseur_id=$allcommande[$i];
            $prevente ->prix =$allcommande[$i+2];
            $prevente ->quantite= $allcommande[$i+3];
            $prevente ->reduction= $allcommande[$i+4];
            $prevente ->prixtotal =$prevente ->prix *$prevente ->quantite - $prevente->reduction;
            $prevente ->vente_id=$vente->id;
            $prevente->save();
            $modele= Modele::findOrFail($allcommande[$i]);
            if($modele->quantite < $prevente ->quantite)
            {
                DB::rollback();
                return response()->json(["msg" => "Attention quantité stock inferieure à la quantité vente"], 500);
            }
            $modele->quantite=$modele->quantite -$prevente ->quantite;
            $modele->update();

            $total = $total + $prevente->prixtotal;
            $allReduction = $allReduction + $prevente->reduction;
        }

        $vente=vente::findOrFail($vente->id);
        $vente->montant_reduction = $allReduction;

        if($request->input('setTva') == "on")
        {
            $montant_ht = $total;
            $montant_tva = ($total * $request->input('tva'))/100;
            $vente->with_tva = true;
            $vente->tva = $request->input('tva');
            $vente->montant_ht = $montant_ht;
            $vente->montant_tva = $montant_tva;
            $vente->totaux= $montant_ht + $montant_tva;

             // Récupération de l'utilisateur à mettre à jour
             $client = Client::find($vente->client_id);

             // Mise à jour des informations de l'utilisateur
             $client->solde = $vente->totaux + $client->solde;

             // Sauvegarde des modifications
             $client->save();
        }else{
            $vente->with_tva = false;
            $vente->totaux = $total;
             // Récupération de l'utilisateur à mettre à jour
             $client = Client::find($vente->client_id);

             // Mise à jour des informations de l'utilisateur
             $client->solde = $vente->totaux + $client->solde;

             // Sauvegarde des modifications
             $client->save();
        }

        $vente->update();

        $modele2=DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->whereColumn('modeles.seuil','>=','modeles.quantite')
            ->get();
        $mod=count($modele2);
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Ventes";
        $historique->user_id =Auth::user()->id;
        $historique->save();

        $total = DB::table('ventes')
            ->join('preventes', function ($join) {
                $join->on('preventes.vente_id', '=', 'ventes.id');
            })
            ->where('ventes.id','=',$vente->id)
            ->SUM('preventes.prixtotal');
        $id=DB::table('factures')->max('id');
        $ed=1+$id;
        $facture=new Facture();
        $facture->prixapayer =$total;
        $facture->montant_reduction =$allReduction;
        $facture->vente_id =$vente->id;
        $facture ->numero="FACT".now()->format('Y')."-".$ed;
        $facture->save();
        DB::commit();
        // $clients=DB::table('clients')
        //     ->join('ventes', function ($join) {
        //         $join->on('ventes.client_id', '=', 'clients.id');
        //     })
        //     ->join('reglements', function ($join) {
        //         $join->on('reglements.vente_id', '=', 'ventes.id');
        //     })
        //     ->where ('ventes.boutique_id', '=',Auth::user()->boutique->id )
        //     ->where('reglements.montant_restant', '>', 0)
        //     ->select('clients.nom as nom','clients.id as id')
        //     ->groupBy('id', 'clients.nom')
        //     ->get();
        // $credit=array();
        // for ($i =0 ;$i<count($clients);$i++) {
        //     $total = DB::table('reglements')
        //         ->join('ventes', function ($join) {
        //             $join->on('reglements.vente_id', '=', 'ventes.id');
        //         })
        //         ->where('ventes.client_id', '=', $clients[$i]->id)
        //         ->SUM('reglements.montant_restant');
        //     $credit[$i] = $total;
        // }
        // $cre=count($clients);
        // // return view('vente',compact('modele2','mod','clients','credit','cre'));
        return $vente;
    }
    public function store_vente_nonlivre(Request $request)
    {
        $allcommande= explode( ',', $request->input('venTable') );
        $i=DB::table('journals')->max('id');
        $id=DB::table('ventes')->max('id');
        $ed=1+$id;
        $vente = new vente();
        $vente ->numero="VENT".now()->format('Y')."-".$ed;
        $vente ->date_vente= now();
        $vente ->client_id= $allcommande[1];
        $vente ->user_id= Auth::user()->id;
        $vente ->journal_id= $i;
        $vente ->type_vente= 3;
        $vente ->boutique_id= Auth::user()->boutique->id;
        $vente->save();
        $total = 0;
        $allReduction = 0;

        for ($i =0 ;$i<count($allcommande);$i+=5) {
            $prevente = new Prevente();
            $prevente ->modele_fournisseur_id=$allcommande[$i];
            $prevente ->prix =$allcommande[$i+2];
            $prevente ->quantite= $allcommande[$i+3];
            $prevente ->reduction= $allcommande[$i+4];
            $prevente ->prixtotal =$prevente ->prix *$prevente ->quantite - $prevente->reduction;
            $prevente ->vente_id=$vente->id;
            $prevente ->etat=true;
            $prevente->save();

            $total = $total + $prevente->prixtotal;
            $allReduction = $allReduction + $prevente->reduction;
        }

        $vente=vente::findOrFail($vente->id);
        $vente->montant_reduction = $allReduction;

        if($request->input('setTva') == "on")
        {
            $montant_ht = $total;
            $montant_tva = ($total * $request->input('tva'))/100;
            $vente->with_tva = true;
            $vente->tva = $request->input('tva');
            $vente->montant_ht = $montant_ht;
            $vente->montant_tva = $montant_tva;
            $vente->totaux= $montant_ht + $montant_tva;
        }else{
            $vente->with_tva = false;
            $vente->totaux = $total;
        }

        $vente->update();

        $modele2=DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->whereColumn('modeles.seuil','>=','modeles.quantite')
            ->get();
        $mod=count($modele2);
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Ventes";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $total = DB::table('ventes')
            ->join('preventes', function ($join) {
                $join->on('preventes.vente_id', '=', 'ventes.id');
            })
            ->where('ventes.id','=',$vente->id)
            ->SUM('preventes.prixtotal');
        $id=DB::table('factures')->max('id');
        $ed=1+$id;
        $facture=new Facture();
        $facture->prixapayer =$total;
        $facture->montant_reduction =$allReduction;
        $facture->vente_id =$vente->id;
        $facture ->numero="FACT".now()->format('Y')."-".$ed;
        $facture->save();
        return $vente;
    }

    public function store_vente_gros(Request $request)
    {
        $allcommande= explode( ',', $request->input('venTable') );
        $i=DB::table('journals')->max('id');
        $id=DB::table('ventes')->max('id');
        $ed=1+$id;
        DB::beginTransaction();
        $vente = new vente();
        $vente ->numero="VENT".now()->format('Y')."-".$ed;
        $vente ->date_vente= now();
        $vente ->client_id= $allcommande[1];
        $vente ->user_id= Auth::user()->id;
        $vente ->journal_id= $i;
        $vente ->type_vente= 4;
        $vente ->boutique_id= Auth::user()->boutique->id;
        $vente->save();
        $total = 0;
        $allReduction = 0;

        for ($i =0 ;$i<count($allcommande);$i+=5) {
            $prevente = new Prevente();
            $prevente ->modele_fournisseur_id=$allcommande[$i];
            $prevente ->prix =$allcommande[$i+2];
            $prevente ->quantite= $allcommande[$i+3];
            $prevente ->reduction= $allcommande[$i+4];
            $prevente ->prixtotal =$prevente ->prix *$prevente ->quantite - $prevente->reduction;
            $prevente ->vente_id=$vente->id;
            $prevente->save();
            $modele= Modele::findOrFail($allcommande[$i]);
            if($modele->quantite < $prevente ->quantite)
            {
                DB::rollback();
                return response()->json(["msg" => "Attention quantité stock inferieure à la quantité vente"], 500);
            }
            $modele->quantite=$modele->quantite -$prevente ->quantite;
            $modele->update();

            $total = $total + $prevente->prixtotal;
            $allReduction = $allReduction + $prevente->reduction;
        }
        $vente=vente::findOrFail($vente->id);
        $vente->montant_reduction = $allReduction;

        if($request->input('setTva') == "on")
        {
            $montant_ht = $total;
            $montant_tva = ($total * $request->input('tva'))/100;
            $vente->with_tva = true;
            $vente->tva = $request->input('tva');
            $vente->montant_ht = $montant_ht;
            $vente->montant_tva = $montant_tva;
            $vente->totaux= $montant_ht + $montant_tva;
        }else{
            $vente->with_tva = false;
            $vente->totaux = $total;
        }

        $vente->update();

        $modele2=DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->whereColumn('modeles.seuil','>=','modeles.quantite')
            ->get();
        $mod=count($modele2);
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Ventes";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $total = DB::table('ventes')
            ->join('preventes', function ($join) {
                $join->on('preventes.vente_id', '=', 'ventes.id');
            })
            ->where('ventes.id','=',$vente->id)
            ->SUM('preventes.prixtotal');
        $id=DB::table('factures')->max('id');
        $ed=1+$id;
        $facture=new Facture();
        $facture->prixapayer =$total;
        $facture->montant_reduction =$allReduction;
        $facture->vente_id =$vente->id;
        $facture ->numero="FACT".now()->format('Y')."-".$ed;
        $facture->save();
        $clients=DB::table('clients')
            ->join('ventes', function ($join) {
                $join->on('ventes.client_id', '=', 'clients.id');
            })
            ->join('reglements', function ($join) {
                $join->on('reglements.vente_id', '=', 'ventes.id');
            })
            ->where ('ventes.boutique_id', '=',Auth::user()->boutique->id )
            ->where('reglements.montant_restant', '>', 0)
            ->select('clients.nom as nom','clients.id as id')
            ->groupBy('id', 'clients.nom')
            ->get();
        $credit=array();
        for ($i =0 ;$i<count($clients);$i++) {
            $total = DB::table('reglements')
                ->join('ventes', function ($join) {
                    $join->on('reglements.vente_id', '=', 'ventes.id');
                })
                ->where('ventes.client_id', '=', $clients[$i]->id)
                ->SUM('reglements.montant_restant');
            $credit[$i] = $total;
        }
        $cre=count($clients);
        DB::commit();
        // return view('vente',compact('modele2','mod','clients','credit','cre'));
        return $vente;
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
