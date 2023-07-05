<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Boutique;
use App\Collecter;
use App\CollectorShop;
use Illuminate\Http\Request;
use App\Http\Resources\CollectorResource;

class BoutiqueController extends BaseController
{
    public function __construct(){
        $this->middleware('auth:sanctum');
    }


    public function index(Request $request){
        $boutiques = Boutique::all();
        return $this->sendResponse($boutiques, "Boutiques retrieved successfully.");
    }

    public function get_users(Request $request, int $id){
        $shop = Boutique::findOrFail($id);
        return $this->sendResponse($shop->users(), "users's shop retrieved successfully.");
    }

    public function get_shops(Request $request){
        $user = $request->user();
        $user_id = $user->id;
        $shops = CollectorShop::where("collector_id", $user_id)->get();
        $shopList = [];
        foreach ($shops as $shop){
            $shopList[] = $shop->shop();
        }
        return response()->json(['shops' => $shopList]);
    }

    public function make_transaction(Request $request){
        $collecte = new Collecter();
        $collecte->user_id_collecteur = $request->user_id_collecteur;
        $collecte->boutique_id = $request->boutique_id;
        $collecte->user_id_gerant = $request->user_id_gerant;
        $collecte->montant = $request->montant;
        $collecte->etat  = true;
        $collecte->save();
        $user = User::find($request->user_id_collecteur);
        $user->solde += $request->montant;
        $user->save();

        return $this->sendResponse($collecte, "Votre collecte a été bien effectuée");
    }

    public function list_transaction(Request $request){
        $collectes = Collecter::where("user_id_collecteur", $request->user_id)->get();
        return $this->sendResponse($collectes, "Collectes retrieved successfully.");
    }

    public function assign_collector_shop(Request $request){
        $collector_shop = new CollectorShop();
        $collector_shop->collector_id = $request->collector_id;
        $collector_shop->shop_id = $request->shop_id;
        $collector_shop->status = true;
        $collector_shop->date = now();
        $collector_shop->save();

        return response()->json(['collector_shop' => $collector_shop]);
    }
}
