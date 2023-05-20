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
        $this->middleware('auth');
    }

    public function index(){
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

        $reglements=Reglement::join('clients', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            ->join('ventes', function ($join) {
                $join->on('reglements.vente_id', '=', 'ventes.id');
            })
            ->where('ventes.boutique_id', '=',Auth::user()->boutique->id)
            ->selectRaw('clients.id, ventes.id as venteId,reglements.created_at, ventes.numero, clients.nom, clients.contact, ventes.totaux, SUM(reglements.montant_donne) as donner')

            ->groupBy('clients.id', 'clients.nom','reglements.created_at', 'clients.contact', 'ventes.numero', 'ventes.id', 'ventes.totaux')
            ->orderBy('reglements.created_at', 'desc')
            ->get();

        return $this->sendResponse($reglements, "Reglements retournés avec succès");
    }

    public function debiteurs()
    {
        $clients = Client::where('boutique_id', '=', Auth::user()->boutique->id)->get();
        $debitors = [];

        foreach ($clients as $client) {
            $latestReglement = Reglement::where('client_id', $client->id)
                ->join('clients', 'reglements.client_id', '=', 'clients.id')
                ->join('ventes', 'reglements.vente_id', '=', 'ventes.id')
                ->select('clients.nom', 'clients.contact', 'clients.adresse', 'reglements.montant_restant', 'reglements.created_at')
                ->latest()
                ->first();

            if ($latestReglement && $latestReglement->montant_restant > 0) {
                $debitors[] = $latestReglement;
            }
        }

        return $this->sendResponse($debitors, "Débiteurs");
    }

}
