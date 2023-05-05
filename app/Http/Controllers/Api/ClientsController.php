<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;


class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
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
