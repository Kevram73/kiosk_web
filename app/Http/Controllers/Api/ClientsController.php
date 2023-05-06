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
}
