<?php

namespace App\Http\Controllers\Api;

use App\Modele;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;


class ProductController extends BaseController
{
    public function index(){
        $products = Modele::all();

        return response()->json([
            'status' => 'success',
            'data' => $products
        ], 201);
    }
}
