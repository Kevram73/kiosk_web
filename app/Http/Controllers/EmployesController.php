<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployesController extends Controller
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
        $employe=Employe::all();
        return datatables()->of($employe)
            ->addColumn('action', function ($clt){

                return ' <a class="btn btn-info " onclick="showemploye('.$clt->id.')" ><i class="fa  fa-info"></i></a>
                                    <a class="btn btn-success" onclick="editemploye('.$clt->id.')"> <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" onclick="deleteemploye('.$clt->id.')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true) ;
    }

    public function liste()
    {
        $historique=new Historique();
        $historique->actions = "Liste";
        $historique->cible = "Employés";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $Roles =\Spatie\Permission\Models\Role::all();
        return view('employe',compact('Roles'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employe = new Employe;
        $employe->nom = $request->input('nom');
        $employe->prenom = $request->input('prenoms');
        $employe->sexe = $request->input('sexe');
        $employe->email = $request->input('email');
        $employe->contact = $request->input('contact');
        $employe->save();
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Employés";
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
        $employe= Employe::findOrFail($id);
        $historique=new Historique();
        $historique->actions = "Detail";
        $historique->cible = "Employés";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return $employe;
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
        $employe= Employe::findOrFail($request->input('idemploye'));
        $employe->nom = $request->input('nom');
        $employe->prenom = $request->input('prenoms');
        $employe->sexe = $request->input('sexe');
        $employe->email = $request->input('email');
        $employe->contact = $request->input('contact');
        $employe->update();
        $historique=new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Employés";
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
        $employe= Employe::findOrFail($id);
        $employe ->delete();
        $historique=new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Employés";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return [];
    }
}
