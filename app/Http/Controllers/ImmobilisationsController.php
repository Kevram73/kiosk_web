<?php

namespace App\Http\Controllers;

use App\Amortissement;
use App\Categorie;
use App\Historique;
use App\Immobilisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImmobilisationsController extends Controller
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

    public function index()
    {
        $immo = DB::table('immobilisations')
            ->join('amortissements', function ($join) {
                $join->on('immobilisations.amortissement_id', '=', 'amortissements.id');
            })
            ->select ('immobilisations.*','amortissements.libelle as amor','amortissements.taux as taux','amortissements.duree_vie as vie')
            ->get();
        return datatables()->of($immo)
            ->addColumn('action', function ($clt) {

                return '<a class="btn btn-info " onclick="showimmo(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>
                <a class="btn btn-success" onclick="editimmo(' . $clt->id . ')"> <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" onclick="deleteimmo(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true);
    }

    public function liste()
    {
        $amortissement=Amortissement::all();
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Immobilisation";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('immobilisation',compact('amortissement'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $immo = new Immobilisation();
        $immo->libelle = $request->input('libelle');
        $immo->montant = $request->input('montant');
        $immo->date = $request->input('dateacqui');
        $immo->amortissement_id = $request->input('type');
        $immo->user_id = Auth::user()->id;
        $immo->save();
        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Immobilisation";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return $request->input();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $immo = Immobilisation::findOrFail($id);
        $historique = new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Immobilisation";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return $immo;
    }

    public function detail($id)
    {
        $immo = DB::table('immobilisations')
            ->join('amortissements', function ($join) {
                $join->on('immobilisations.amortissement_id', '=', 'amortissements.id');
            })
            ->select ('immobilisations.*','amortissements.libelle as amor','amortissements.taux as taux','amortissements.duree_vie as vie')
            ->where('immobilisations.id','=',$id)
            ->get();
        $a=strtotime($immo[0]->date);
        $jr=3600*24;
        $b=($immo[0]->vie*360);
        $d=$jr*$b;
        $c=$a+$d;
        $expire=date("Y-m-d",$c);
        return ["immo"=>$immo,"expire"=>$expire];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $immo = Immobilisation::findOrFail($request->input('idimmo'));
        $immo->libelle = $request->input('libelle');
        $immo->montant = $request->input('montant');
        $immo->date = $request->input('dateacqui');
        $immo->amortissement_id = $request->input('type');
        $immo->user_id = Auth::user()->id;
        $immo->update();
        $historique = new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Immobilisation";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $immo = Immobilisation::findOrFail($id);
        $immo->delete();
        $historique = new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Immobilisation";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return [];
    }
}
