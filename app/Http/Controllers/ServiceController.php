<?php

namespace App\Http\Controllers;

use App\Produit;
use App\Categorie;
use App\Modele;
use App\Historique;
use App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    function index(){
        $historique=new Historique();
        $historique->actions = "Liste";
        $historique->cible = "Modeles";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $categorie=Categorie::all();
        return view('service_index',compact('categorie'));
    }

    public function index_prestation()
    {
        $categorie=Categorie::all();
        $produits=Produit::all();
        $modeles=Modele::all();

        $modele2=DB::table('modeles')
            ->where('modeles.seuil','>=','modeles.quantite')
            ->get();
        $mod=count($modele2);

        return view('services/index',compact('categorie', 'produits', 'modeles','modele2','mod'));
    }

    function allservice()
    {
        $data=Service::with('boutique')->where ('boutique_id', '=',Auth::user()->boutique->id )->get();
        return datatables()->of($data)
            ->addColumn('action', function ($clt){

                return ' <a class="btn btn-info " onclick="showmodele('.$clt->id.')" ><i class="fa  fa-info"></i></a>
                                    <a class="btn btn-success" onclick="editmodele('.$clt->id.')"> <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" onclick="deletemodele('.$clt->id.')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true) ;
    }

    public function store(Request $request)
    {
        $id=DB::table('services')->max('id');
        $ed=1+$id;
        $modele = new Service();
        $modele->libelle = $request->input('libelle');
        $modele->prix = $request->input('prix');
        $modele->numero ="SERV".now()->format('Y')."-".$ed;
        $modele->boutique_id = Auth::user()->boutique->id;
        $modele->save();
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Services";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return $request->input();
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
        $historique->cible = "Services";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $modele= Service::findOrFail($id);
        return $modele;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $modele = Service::findOrFail($request->input('idservice'));
        $modele->libelle = $request->input('libelle');
        $modele->prix = $request->input('prix');
        $modele->update();
        $historique=new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Services";
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
        $modele= Service::findOrFail($id);
        $modele ->delete();
        $historique=new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Services";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return [];
    }
}
