<?php

namespace App\Http\Controllers\Api;

use App\DevisVente;
use App\DevisLignesVente;
use App\Historique;
use App\Http\Resources\DevisResource;
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
        return DevisResource::collection(DevisVente::all());
    }

    public function storeDevis()
    {
        $id=DevisVente::latest()->first()->id;
        if($id){
            $ed = $id + 1;
        } else {
            $ed=1;
        }
        $devis = new DevisVente();
        $devis->numero = "DEV".now()->format('Y')."-".$ed;
        $devis->date_devis = now();
        $devis->client_id = $request->client;
        $devis->user_id = Auth::user()->id;
        $devis->boutique_id = Auth::user()->boutique->id;
        $devis->save();
        $total = 0;
        $allReduction = 0;

        for ($i =0 ;$i<count($allcommande);$i+=5) {
            $devisligne = new DevisLignesVente();
            $devisligne->modele_fournisseur_id=$allcommande[$i];
            $devisligne->prix=$allcommande[$i+2];
            $devisligne->quantite= $allcommande[$i+3];
            $devisligne->reduction= $allcommande[$i+4];
            $devisligne->prixtotal = $allcommande[$i+3]*$allcommande[$i+2] - $allcommande[$i+4];
            $devisligne->devis_id=$devis->id;
            $devisligne->save();

            $total = $total + $devisligne->prixtotal;
            $allReduction = $allReduction + $devisligne->reduction;
        }
        DB::commit();

        $devis=DevisVente::findOrFail($devis->id);
        $devis->montant_reduction = $allReduction;

        if($request->input('setTva') == "on")
        {
            $montant_ht = $total;
            $montant_tva = ($total * $request->input('tva'))/100;
            $devis->with_tva = true;
            $devis->tva = $request->input('tva');
            $devis->montant_ht = $montant_ht;
            $devis->montant_tva = $montant_tva;
            $devis->totaux= $montant_ht + $montant_tva;
        }else{
            $devis->with_tva = false;
            $devis->totaux = $total;
        }

        $devis->update();

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Devis";
        $historique->user_id =Auth::user()->id;
        $historique->save();

        return $devis;
    }



}
