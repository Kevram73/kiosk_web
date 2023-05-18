<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Client;


class ClientsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json([
            'status' => 'success',
            'clients' => $clients,
        ], 200);
    }

    public function show($id)
    {
        $client = Client::find($id);
        return response()->json([
            'status' => 'success',
            'client' => $client,
        ]);
    }

    public function store(Request $request){
        $client = new Client();
        $client->nom = $request->nom;
        $client->telephone = $request->telephone;
        $client->email = $request->email;
        $client->adresse = $request->adresse;
        $client->solde = $request->solde;
        $client->boutique_id = $request->boutique_id;
        $client->save();

        $historique = new historique();
        $historique->actions = "Creer";
        $historique->cible = "Clients";
        $historique->user_id = $request->user_id;
        $historique->save();

        return response()->json([
            'status' => 'success',
            'data' => $client,
        ], 201);
    }
}
