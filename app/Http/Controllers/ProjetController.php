<?php

namespace App\Http\Controllers;

use App\Boutique;
use App\Projet;
use App\ProjetModel;
use App\Produit;
use App\Categorie;
use App\Modele;
use App\Historique;
use App\File;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charge = Projet::with('boutique')->where('boutique_id', '=',Auth::user()->boutique->id )->orderBy('projets.created_at', 'DESC')->get();
        return datatables()->of($charge)
            ->addColumn('action', function ($clt) {

                return
                        '<a class="btn btn-info" href="/projet-models-' . $clt->id . '"> <i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-success" onclick="editcharge(' . $clt->id . ')"> <i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger" onclick="deletecharge(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a>';
            })
            ->make(true);
    }

    public function index_model($id)
    {
        $charge = ProjetModel::
        with('modele')
        ->with('user')
        ->where('projet_models.projet_id', '=', $id )
        ->orderBy('projet_models.created_at', 'DESC')
        ->get();
        return datatables()->of($charge)
        ->addColumn('action', function ($clt) {
            return  '<a class="btn btn-danger" onclick="deletepro(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a>';
        })
        ->make(true);
    }

    public function liste()
    {
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Projet";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('projets/index');
    }

    public function list_projet_models($id){
        $projet = projet::findorfail($id);
        $total = ProjetModel::where('projet_models.projet_id', '=', $id )
        ->sum('prixtotal');
        
        $historique = new Historique();
        $historique->actions = "List";
        $historique->cible = "Projet model";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        return view('projets/index_model', compact('projet', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function create_projet_modele($id)
    {
        $projet = Projet::findorfail($id);
        $categorie=Categorie::all();
        $produits=Produit::all();
        $modeles=Modele::all();

        $modele2=DB::table('modeles')
            ->where('modeles.seuil','>=','modeles.quantite')
            ->get();
        $mod=count($modele2);

        $historique = new Historique();
        $historique->actions = "Créer";
        $historique->cible = "Projet Model";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('projets/add_model_projet', compact('projet', 'categorie', 'produits', 'modeles','modele2','mod'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $charge = new Projet();
        $charge->name = $request->name;
        $charge->debut = date('Y-m-d', strtotime($request->debut));
        $charge->fin = date('Y-m-d', strtotime($request->fin));
        $charge->boutique_id =Auth::user()->boutique->id;

        $charge->save();

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Projet";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        DB::commit();

        return $charge;
    }

    public function store_projet_modeles(Request $request, $id){
        
        DB::beginTransaction();
        $vente = Projet::findorfail($id);
        $allcommande= explode( ',', $request->input('venTable') );
        $total = 0;

        for ($i =0 ;$i<count($allcommande);$i+=3) {
            $prevente = new ProjetModel();
            $prevente ->modele_id = $allcommande[$i];
            $prevente ->prix = $allcommande[$i+1];
            $prevente -> quantite = $allcommande[$i+2];
            $prevente ->prixtotal = $allcommande[$i+2]*$allcommande[$i+1] ;
            $prevente ->projet_id = $vente->id;
            $prevente ->user_id = Auth::user()->id;
            $prevente->save();
            $modele_id =DB::table('modeles')
                ->join('projet_models', function ($join) {
                    $join->on('projet_models.modele_id', '=', 'modeles.id');
                })
                ->where('projet_models.id','=',$prevente->id)
                ->select('modeles.id as id')
                ->get();
            $modele= Modele::findOrFail($modele_id[0]->id);
            if($modele->quantite < $prevente->quantite)
            {
                DB::rollback();
                return response()->json(["msg" => "Attention quantité stock inferieure à la quantité vente"], 500);
            }
            $modele->quantite=$modele->quantite -$prevente ->quantite;
            $modele->update();

            $total = $total + $prevente->prixtotal;
        }
        DB::commit();

        
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Projet Model";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        // return view('vente',compact('modele2','mod','clients','credit','cre'));
        return $vente;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historique = new Historique();
        $historique->actions = "Detail";
        $historique->cible = "Projet";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        $charge = Projet::findOrFail($id);
        return $charge;
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
        $charge= Projet::findOrFail($request->input('idcharge'));
        $charge->name = $request->name;
        $charge->debut = date('Y-m-d', strtotime($request->debut));
        $charge->fin = date('Y-m-d', strtotime($request->fin));

        $charge->update();

        $historique=new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Projet";
        $historique->user_id =Auth::user()->id;
        $historique->save();

        return $charge;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $charge = Projet::findOrFail($id);
        $charge->delete();

        $historique = new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Projet";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        
        return $charge;
    }
}
