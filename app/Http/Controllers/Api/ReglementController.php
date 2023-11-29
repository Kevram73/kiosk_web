<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Reglement;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ReglementResource;



class ReglementController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(){
        $reglements = ReglementResource::collection(Reglement::orderBy('created_at', 'desc')->get()->take(10));
        return $this->sendResponse($reglements, "Reglements retournés avec succès");
    }

    public function filter(Request $request){
        $reglements = ReglementResource::collection(Reglement::whereBetween("created_at", [$request->beginDate, $request->endDate])->get()->take(10));
        return $this->sendResponse($reglements, "Reglements retrieved successfully.");
    }

    public function debiteurs()
    {
        $clients = Client::where("solde",'!=', 0)->get();

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
