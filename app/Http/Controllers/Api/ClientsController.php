<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClientsController extends Controller
{


    public function list()
    {
        $clients = Db::table('clients')->get();
        return response()->json($clients->toArray());
    }
}
