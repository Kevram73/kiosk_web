<?php

namespace App\Http\Controllers;
use App\Historique;
use App\Boutique;
use App\Modele;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoutiquesController extends Controller
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
        $boutique=Boutique::all();

        return datatables()->of($boutique)
            ->addColumn('action', function ($clt){

                return ' <a class="btn btn-info " onclick="showboutique('.$clt->id.')" ><i class="fa  fa-info"></i></a>
                            <a class="btn btn-warning " onclick="showvaleur('.$clt->id.')" ><i class="fa fa-money"></i></a>
                                    <a class="btn btn-primary" href="/settings-'.$clt->id.'"> <i class="fa fa-cog"></i></a>
                                    <a class="btn btn-success" onclick="editboutique('.$clt->id.')"> <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" onclick="deleteboutique('.$clt->id.')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true) ;
    }

    public function settingIndex($id)
    {
        $boutique = Boutique::find($id);
        $settings = Setting::all();

        return view('setting/index', compact('boutique', 'settings'));
    }

    public function settingStore(Request $request)
    {
        // dd($request->all());
        $boutique = Boutique::find($request->boutique_id);

        $options = [];
        foreach ($request->settings as $key => $value) {
            $options[$key] = ['is_active' => $value];
        }

        $boutique->settings()->sync($options);

        return redirect('/settings-'.$boutique->id)->with('success', 'Paramètres enregister !!!');;
    }

    public function liste()
    {
        $boutique=Boutique::all();
        $historique=new Historique();
        $historique->actions = "liste";
        $historique->cible = "Boutique";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return view('boutique',compact('boutique'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $boutique = new Boutique();
        $boutique->nom = $request->input('nom');
        $boutique->adresse = $request->input('adresse');
        $boutique->telephone = $request->input('telephone');
        $boutique->contact = $request->input('telephone');
        $boutique->save();
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Boutique";
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
        $historique->cible = "Boutique";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $boutique= Boutique::findOrFail($id);
        return $boutique;
    }

    public function showValeur($id)
    {
        $result = Modele::where('modeles.boutique_id', '=', $id)
        ->selectRaw('SUM(modeles.quantite * modeles.prix_achat) as prix_total')
        ->get();
        $boutique['nom'] = Boutique::findOrFail($id)->nom;
        $boutique['prix'] = '0.0 Franc CFA';
        if (!empty($result)){
            $boutique['prix'] = number_format($result[0]->prix_total, 0, '.', '.').' Franc CFA';
        }
        return $boutique;
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
        $historique->cible = "Boutique";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $boutique= Boutique::findOrFail($request->input('idboutique'));
        $boutique->nom = $request->input('nom');
        $boutique->adresse = $request->input('adresse');
        $boutique->telephone = $request->input('telephone');
        $boutique->update();
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
        $historique->cible = "Boutique";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        $boutique= Boutique::findOrFail($id);
        $boutique ->delete();
        return [];
    }
}
