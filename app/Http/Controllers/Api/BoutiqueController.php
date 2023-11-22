<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Boutique;
use App\Collecter;
use App\Historique;
use App\User;
use App\CollectorShop;
use Illuminate\Http\Request;
use App\Http\Resources\CollectorResource;
use App\Http\Resources\CollecteResource;
use Illuminate\Support\Facades\Auth;

class BoutiqueController extends BaseController
{
    public function __construct(){
        $this->middleware('auth:sanctum');
    }


    public function index(Request $request){
        $boutiques = Boutique::all();
        return $this->sendResponse($boutiques, "Boutiques retrieved successfully.");
    }

    public function store(Request $request){
        $boutique = new Boutique();
        $boutique->nom = $request->name;
        $boutique->adresse = $request->address;
        $boutique->telephone = $request->phone;
        $boutique->contact = $request->email;
        $boutique->save();
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Boutique";
        $historique->user_id =Auth::user()->id;
        $historique->save();

        return $this->sendResponse($boutique, "Boutique created successfully.", 201);
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
        // return response()->json(['shops' => $shopList]);
        return CollectorResource::collection($shopList);
    }

    public function make_transaction(Request $request){
        $collecte = new Collecter();
        $collecte->user_id_collecteur = $request->user_id_collecteur;
        $collecte->boutique_id = $request->boutique_id;
        $collecte->user_id_gerant = $request->user_id_gerant;
        $collecte->montant = $request->montant;
        $collecte->etat = true;
        $collecte->save();
        $user = User::find($request->user_id_collecteur);
        $user->solde += $request->montant;
        $user->save();

        return $this->sendResponse($collecte, "Votre collecte a été bien effectuée", 201);
    }

    public function list_transaction(Request $request){
        $collectes = Collecter::where("user_id_gerant", Auth::user()->id)->get();
        return $this->sendResponse(CollecteResource::collection($collectes), "Collectes retrieved successfully.");
    }

    public function list_transaction_manager(Request $request){
        $collectes = Collecter::where("user_id_collecteur", Auth::user()->id)->get();
        return $this->sendResponse(CollecteResource::collection($collectes), "Collectes retrieved successfully.");
    }

    public function list_transaction_manager_filter(Request $request){
        $collectes = Collecter::where("user_id_collecteur", Auth::user()->id)->whereBetween('created_at', [$request->beginDate, $request->endDate])->get();
        return $this->sendResponse(CollecteResource::collection($collectes), "Collectes retrieved successfully.");
    }

    public function lastTen(Request $request){
        $collectes = Collecter::where("user_id_collecteur", Auth::user()->id)->orderBy('id', 'desc')->take(10)->get();
        return $this->sendResponse(CollecteResource::collection($collectes), "Collectes retrieved successfully.");
    }

    public function dataWithFilter(Request $request){
        $collectes = Collecter::where("user_id_collecteur", Auth::user()->id)
                        ->whereBetween('created_at', [$request->startDate, $request->endDate])
                        ->where("boutique_id", $request->shopId)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return $this->sendResponse(CollecteResource::collection($collectes), "Collectes retrieved successfully.");
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

    public function solde(Request $request){
        return response()->json(['solde' => $request->user()->solde]);
    }
}
