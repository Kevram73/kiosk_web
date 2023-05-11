<?php

namespace App\Http\Controllers\Api;

use App\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;



class CategoryController extends BaseController
{
    public function index(){
        $categories = Categorie::all();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ], 201);
    }
}
