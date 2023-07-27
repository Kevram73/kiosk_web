<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Versement;
use App\Http\Controllers\Api\BaseController as BaseController;


class VersementController extends BaseController
{

    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request){
        $versements = Versement::where('user_id', $request->user()->id)->get();
        return $this->sendResponse($versements, "Versements retrieved successfully.");
    }

    public function dataWithFilter(Request $request){
        $versements = Versement::where('user_id', $request->user()->id)->whereBetween('created_at', [$request->startDate, $request->endDate])
                       ->orderBy('created_at', 'desc')
                       ->get();
        return $this->sendResponse($versements, "Versements retrieved successfully.");
    }

    public function lastTen(Request $request){
        $versements = Versement::where('user_id', $request->user()->id)->orderBy('id', 'desc')->take(10)->get();
        return $this->sendResponse($versements, "Last request retrieve successul.");
    }

    public function store(Request $request){
        $versement = new Versement();
        $versement->nature = $request->nature;
        $versement->montant = $request->montant;
        $versement->user_id = $request->user()->id;
        $versement->date = now();
        $versement->save();

        return $this->sendResponse($versement, "Votre versement a été bien effectuée", 201);
    }
}

