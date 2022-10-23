<?php

namespace App\Http\Controllers;

use App\Amortissement;
use App\Historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmortissementsController extends Controller
{
    public function index()
    {
        $amor = Amortissement::orderBy('created_at', 'DESC')->get();
        return datatables()->of($amor)
            ->addColumn('action', function ($clt) {

                return '<a class="btn btn-success" onclick="editamor(' . $clt->id . ')"> <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" onclick="deleteamor(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true);
    }

    public function liste()
    {
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Amortissement";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('amortissement');
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
        $amor = new Amortissement();
        $amor->libelle = $request->input('libelle');
        $amor->taux = $request->input('taux');
        $amor->duree_vie = $request->input('vie');
        $amor->save();
        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Amortissement";
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
        $amor = Amortissement::findOrFail($id);
        $historique = new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Amortissement";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return $amor;
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
        $amor = Amortissement::findOrFail($request->input('idamor'));
        $amor->libelle = $request->input('libelle');
        $amor->taux = $request->input('taux');
        $amor->duree_vie = $request->input('vie');
        $amor->update();
        $historique = new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Clients";
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
        $amor = Amortissement::findOrFail($id);
        $amor->delete();
        $historique = new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Armortissement";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return [];
    }
}
