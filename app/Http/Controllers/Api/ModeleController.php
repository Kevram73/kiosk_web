<?php

namespace App\Http\Controllers\Api;

use App\Modele;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;


class ModeleController extends BaseController
{
    public function index(){
        $modeles = Modele::all();

        return response()->json([
            'status' => 'success',
            'data' => $modeles
        ], 201);
    }
}
