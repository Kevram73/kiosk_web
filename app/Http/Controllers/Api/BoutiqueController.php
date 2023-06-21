<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Boutique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BoutiqueController extends BaseController
{
    public function __construct(){
        $this->middleware('auth:sanctum');
    }


    public function index(Request $request){
        $boutiques = Boutique::all();
        return $this->sendResponse($boutiques, "Boutiques retrieved successfully.");
    }
}
