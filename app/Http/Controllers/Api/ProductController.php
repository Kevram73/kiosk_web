<?php

namespace App\Http\Controllers\Api;

use App\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;


class ProductController extends BaseController
{
    public function index(){
        $products = Produit::all();

        return response()->json([
            'status' => 'success',
            'data' => $products
        ], 201);
    }
}
