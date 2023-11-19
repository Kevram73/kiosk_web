<?php

namespace App\Http\Controllers\Api;

use App\DevisVente;
use App\DevisLignesVente;
use App\Historique;
use App\User;
use App\Http\Resources\DevisResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DevisController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display the list devis.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return DevisResource::collection(DevisVente::all()->take(10));
    }

    public function storeDevis(Request $request)
    {
        // return $this->sendResponse($request, "Devis effectué avec succès");
        $devisList = count(DevisVente::all());

        if($devisList > 0){
            $id=DevisVente::latest()->first()->id;
            $ed = $id + 1;
        } else {
            $ed=1;
        }

        $devis = new DevisVente();
        $devis->numero = "DEV".now()->format('Y')."-".$ed;
        $devis->date_devis = now();
        $devis->client_id = $request->client_id;
        $devis->user_id = $request->user_id;
        $devis->boutique_id = User::find($request->user_id)->boutique_id;
        $devis->save();

        $total = 0;
        $allReduction = 0;

        foreach($request->product_list as $datum) {
            $devisligne = new DevisLignesVente();
            $devisligne->modele_fournisseur_id = $datum['mfid'];
            $devisligne->prix= $datum['prix'];
            $devisligne->quantite= $datum['qte'];
            $devisligne->reduction= $datum['reduction'];
            $devisligne->prixtotal = $datum['prix']*$datum['qte'] - $datum['reduction'];
            $devisligne->devis_id=$devis->id;
            $devisligne->save();

            $total += $datum['prix']*$datum['qte'];
            $allReduction += $datum['reduction'];
        }

        $devis=DevisVente::findOrFail($devis->id);
        $devis->montant_reduction = $allReduction;

        if($request->input('tva_on') == true)
        {
            $montant_ht = $total-$allReduction;
            $montant_tva = ($montant_ht * 18)/100;
            $devis->with_tva = true;
            $devis->tva = 18;
            $devis->montant_ht = $montant_ht;
            $devis->montant_tva = $montant_tva;
            $devis->montant_reduction = $allReduction;
            $devis->totaux= $total;

        }else{
            $devis->with_tva = false;
            $devis->totaux = $total;
        }

        $devis->save();

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Devis";
        $historique->user_id =$request->user_id;
        $historique->save();

        return $this->sendResponse($devis, "Devis effectué avec succès");
    }

    public function filter(Request $request){
        $devis = DevisVente::whereBetween('created_at', [$request->beginDate, $request->endDate])->get();
        return $this->sendResponse($devis, "Devis retrieved successfully.");
    }


}
