<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Historique;
use App\Inventaires;
use App\Unite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;


class CategoriesController extends Controller
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
        $categorie=Categorie::all();
        return datatables()->of($categorie)
            ->addColumn('action', function ($clt){

                return ' <a class="btn btn-info " onclick="showcategorie('.$clt->id.')" ><i class="fa  fa-info"></i></a>
                                    <a class="btn btn-success" onclick="editcategorie('.$clt->id.')"> <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" onclick="deletecategorie('.$clt->id.')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true) ;
    }

    public function liste()
    {
        $categorie=Categorie::all();
        $historique=new Historique();
        $historique->actions = "liste";
        $historique->cible = "Categories";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return view('categorie',compact('categorie'));

    }
    public function categorie()
    {
        $categorie=Categorie::all();
        return $categorie;

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newinventaire');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categorie = new Categorie();
        $categorie->nom = $request->input('nom');
        $categorie->description = $request->input('description') != null ? $request->input('description') : "...";
        $categorie->save();
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Inventaire";
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
        $historique->actions = "detail";
        $historique->cible = "Categories";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $categorie= Categorie::findOrFail($id);
        return $categorie;
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
        $historique=new Historique();
        $historique->actions = "modifier";
        $historique->cible = "Categories";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $categorie= Categorie::findOrFail($request->input('idcategorie'));
        $categorie->nom = $request->input('nom');
        $categorie->description = $request->input('description');
        $categorie->update();
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
        $historique=new Historique();
        $historique->actions = "supprimer";
        $historique->cible = "les categories";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $categorie= Categorie::findOrFail($id);
        $categorie ->delete();
        return [];
    }
}
