<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Reglement;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ReglementController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(){


        $reglements=Reglement::all();

        return $this->sendResponse($reglements, "Reglements retournés avec succès");
    }

    public function debiteurs()
    {
        $clients = Reglement::join('clients', function ($join) {
            $join->on('reglements.client_id', '=', 'clients.id');
        })
        ->join('ventes', function ($join) {
            $join->on('reglements.vente_id', '=', 'ventes.id');
        })
        ->where('ventes.boutique_id', '=',Auth::user()->boutique->id)
        ->selectRaw('clients.id, ventes.id as venteId, ventes.numero, clients.nom, clients.contact, ventes.totaux, SUM(reglements.montant_donne) as donner')
        ->groupBy('clients.id', 'clients.nom', 'clients.contact', 'ventes.numero', 'ventes.id', 'ventes.totaux')
        ->havingRaw('(totaux - donner) > 0.0')
        ->get();

        return $this->sendResponse($clients, "Clients qui nous doivent retournés avec succès");
    }

    public function store(Request $request){
        $reglement = new Reglement();
        $client = Client::find($request->client_id);
        $reglement->client_id = $request->client_id;
        $reglement->vente_id = 0;
        $reglement->montant_donne = $request->montant_donne;
        $reglement->montant_restant = $client->solde - $request->montant_donne;
        $reglement->total = $client->solde;
        $reglement->date_reglement = now();
        $reglement->save();
        $client->solde = $client->solde - $request->montant_donne;
        $client->save();

        return $this->sendResponse($reglement, "Reglement effectué avec succès");
    }

}
