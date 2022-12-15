<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Historique;
use App\Produit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class ProduitsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produit=Produit::with('categorie');
        return datatables()->of($produit)
            ->addColumn('action', function ($clt){

                return ' <a class="btn btn-info " onclick="showproduit('.$clt->id.')" ><i class="fa  fa-info"></i></a>
                                    <a class="btn btn-success" onclick="editproduit('.$clt->id.')"> <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" onclick="deleteproduit('.$clt->id.')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true) ;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=DB::table('produits')->max('id');
        $ed=1+$id;
        $date=now();
        $produit =Produit::findOrNew($request->input('nom'));
        $produit->nom = $request->input('noms');
        $produit->categorie_id = $request->input('categories');
        $produit->numero ="PROD".$date->format('Y')."-".$ed;
        $produit->save();
        $historique=new Historique();
        $historique->actions = "Liste";
        $historique->cible = "Produits";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return $request ->input();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historique=new Historique();
        $historique->actions = "Detail";
        $historique->cible = "Produits";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $produit= Produit::with('categorie')->findOrFail($id);
        return $produit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $produit=Produit::findOrFail($request->input('idproduit'));
        $produit->nom = $request->input('noms');
        $produit->categorie_id = $request->input('categories');
        $produit->update();
        $historique=new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Produits";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produit= Produit::findOrFail($id);
        $produit ->delete();
        $historique=new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Produits";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return [];
    }
}
