<?php

namespace App\Http\Controllers\Api;

use App\Modele;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ModeleController extends BaseController
{
    public function __construct(){
        return $this->middleware("auth:sanctum");
    }

    public function index(){
        $modeles = Modele::where('boutique_id', Auth::user()->boutique_id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $modeles
        ], 201);
    }
}
