<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Inventaire_modeles;
use App\Modele;
use Illuminate\Support\Facades\DB;
use App\Historique;
use App\Inventaires;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class InventairesController extends Controller
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
        $inventaire = DB::table('inventaires')
            ->where(['inventaires.etat' => 1])
            ->join('users', function ($join) {
                $join->on('inventaires.user_id', '=', 'users.id');
            })
            ->select('inventaires.*', 'users.id as user_id', 'users.nom', 'users.prenom')
            ->get();
        return datatables()->of($inventaire)
            ->addColumn('action', function ($clt){
                return ' <a class="btn btn-info " onclick="showinventaire('.$clt->id.')" ><i class="fa  fa-info"></i></a>
                <a class="btn btn-success" href="/detailinventaireprint-'. $clt->id .'" ><i class="fa fa-print"></i></a>';
            })
            ->make(true) ;
    }
    public function indexPending()
    {
        $inventaire = DB::table('inventaires')
        ->where(['inventaires.etat' => 0])
        ->join('users', function ($join) {
            $join->on('inventaires.user_id', '=', 'users.id');
        })
        ->select('inventaires.*', 'users.id as user_id', 'users.nom', 'users.prenom')
        ->get();
        return datatables()->of($inventaire)
            ->addColumn('action', function ($clt){
                return ' <a class="btn btn-success " href="/new2inventaire-'.$clt->id.'" ><i class="fa fa-check"></i></a>
                <a class="btn btn-info" href="/inventaires/pending/'. $clt->pdf_pending .'" ><i class="fa fa-print"></i></a>
                <a class="btn btn-danger " onclick="deleteinventaire('.$clt->id.')" ><i class="fa fa-trash-o"></i></a>
                ';
            })
            ->make(true) ;
    }
    public function liste()
    {
        $inventaire=Inventaires::all();
        $historique=new Historique();
        $historique->actions = "liste";
        $historique->cible = "Inventaire";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return view('inventaire',compact('inventaire'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=DB::table('inventaires')->max('id');
        if ($id==null){
            $inventaire=new Inventaires();
            $inventaire->numero ="INVENT".now()->format('Y')."-1";
            $inventaire->user_id =Auth::user()->id;
            $inventaire->save();
            return view('newinventaire');
        }
        else{
            $ed=1+$id;
            $inventaire=new Inventaires();
            $inventaire->numero ="INVENT".now()->format('Y')."-".$ed;
            $inventaire->user_id =Auth::user()->id;
            $inventaire->save();
            return view('newinventaire');
        }
    }

    public function create2invt($id)
    {
        $data = Inventaires::find($id);
        if(is_null($data))
            return back();
        else
        {
            return view('new2inventaire', compact('data'));
        }
    }

    public function create2(Request $request)
    {
        $id=DB::table('inventaires')->max('id');
        if ($id==null){
            $inventaire=new Inventaires();
            $inventaire->numero ="INVENT".now()->format('Y')."-1";
            $inventaire->user_id =Auth::user()->id;
        }
        else{
            $ed=1+$id;
            $inventaire=new Inventaires();
            $inventaire->numero ="INVENT".now()->format('Y')."-".$ed;
            $inventaire->user_id =Auth::user()->id;
        }
        $inventaire->date_inventaire = now();
        $inventaire->date_inventaire_prevu = $request->input('date_prev');
        $modele = $request->input('choix');
        $cate = $request->input('categorie');
        $inventaire->categorie_id = $modele == "categorie" ? $cate != null ? $cate : 0 : 0;
        $inventaire->save();


        $user = User::find($inventaire->user_id);

        $modeles = $inventaire->categorie_id == 0 ? DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->select('modeles.id as id',
                'modeles.libelle as modele',
                'modeles.quantite as quantite',
                'produits.nom as produit',
                'categories.nom as categorie'
            )
            ->get()
            :
            DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->where('categories.id','=',$inventaire->categorie_id)
            ->select('modeles.id as id',
                'modeles.libelle as modele',
                'modeles.quantite as quantite',
                'produits.nom as produit',
                'categories.nom as categorie'
            )
            ->get();
        // Gene PDF

            $name = "inventaire_".date('Y-m-d_H-i-s', strtotime(now())).".pdf";
            $pdf = null;
            try{
                $pdf = PDF::loadView('prints/inventairepending',compact('inventaire','modeles', 'user'))
                        ->setPaper('a4')
                        ->save(public_path("inventaires/pending/".$name));
                DB::table('inventaires')->where('id',$inventaire->id)->update(['pdf_pending' => $name]);
            }catch(Exception $e)
            {}
            return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modele = DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->select('modeles.id as id',
                'modeles.libelle as modele',
                'modeles.quantite as quantite',
                'produits.nom as produit',
                'categories.nom as categorie'
            )
            ->where('modeles.id','=',$id)
            ->get();

            //dd($modele);

        return $modele;
    }
    public function show2($id)
    {
        $inventaire = DB::table('inventaires')
            ->join('inventaire_modeles', function ($join) {
                $join->on('inventaire_modeles.inventaire_id', '=', 'inventaires.id');
            })
            ->join('modeles', function ($join) {
                $join->on('inventaire_modeles.modele_id', '=', 'modeles.id');
            })
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->join('users', function ($join) {
                $join->on('inventaires.user_id', '=', 'users.id');
            })
            ->select('modeles.id as id',
                'modeles.libelle as modele',
                'inventaire_modeles.quantite as quantite',
                'inventaire_modeles.quantite_reelle as quantiteR',
                'inventaire_modeles.justify as justify',
                'produits.nom as produit',
                'inventaires.numero as numero',
                'inventaires.date_inventaire as date',
                'inventaires.id as inventaire_id',
                'inventaires.pdf_pending as pdf',
                'inventaires.observation as observation',
                'users.nom as utilisateur',
                'users.prenom as prenom',
                'categories.nom as categorie'
            )
            ->where('inventaires.id','=',$id)
            ->get();
            //dd($inventaire);
        return view('detailinventaire',compact('inventaire'));
    }

    public function show3($id)
    {
        $inventaire = DB::table('inventaires')
            ->join('inventaire_modeles', function ($join) {
                $join->on('inventaire_modeles.inventaire_id', '=', 'inventaires.id');
            })
            ->join('modeles', function ($join) {
                $join->on('inventaire_modeles.modele_id', '=', 'modeles.id');
            })
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->join('users', function ($join) {
                $join->on('inventaires.user_id', '=', 'users.id');
            })
            ->select('modeles.id as id',
                'modeles.libelle as modele',
                'inventaire_modeles.quantite as quantite',
                'inventaire_modeles.quantite_reelle as quantiteR',
                'inventaire_modeles.justify as justify',
                'produits.nom as produit',
                'inventaires.numero as numero',
                'inventaires.date_inventaire as date',
                'inventaires.date_inventaire_valider as dateF',
                'inventaires.observation as observation',
                'users.nom as utilisateur',
                'users.prenom as prenom',
                'categories.nom as categorie'
            )
            ->where('inventaires.id','=',$id)
            ->get();

            $name = "inventaire_".date('Y-m-d_H-i-s', strtotime( $inventaire && $inventaire[0] ? $inventaire[0]->date : now())).".pdf";
            $pdf = null;
            try{
                $pdf = PDF::loadView('prints/inventairevalider',compact('inventaire'))
                        ->setPaper('a4');
            }catch(Exception $e)
            {}

            if($pdf == null) return view('detailinventaire',compact('inventaire'));
            return $pdf->download();
    }

    public function update(Request $request)
    {
        $id=DB::table('inventaires')->max('id');
        $modele =Modele::findOrFail($request->input('id'));
        $inventaire=new Inventaire_modeles();
        $inventaire->modele_id =$modele->id;
        $inventaire->quantite =$modele->quantite;
        $inventaire->quantite_reelle =$request->input('quantiteR');
        $inventaire->inventaire_id =$id;
        $inventaire->save();
        $modele->quantite= $request->input('quantiteR');
        $modele->update();
        return [];
    }

    public function update2(Request $request, $_id)
    {
        $id=Inventaires::find($_id)->id;
        $modele =Modele::findOrFail($request->input('id'));
        $inventaire=new Inventaire_modeles();
        $inventaire->modele_id =$modele->id;
        $inventaire->quantite =$modele->quantite;
        $inventaire->quantite_reelle =$request->input('quantiteR');
        $inventaire->justify =$request->input('justify');
        $inventaire->inventaire_id =$id;
        $inventaire->save();
        $modele->quantite= $request->input('quantiteR');
        $modele->update();
        return [];
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


   public function fermer()
    {
        $id=DB::table('inventaires')->max('id');
        $inventaire =Inventaires::findOrFail($id);
        $inventaire->etat=true;
        $inventaire->update();

    }

    public function fermerbydata(Request $request, $id)
    {
        $inventaire =Inventaires::findOrFail($id);
        $inventaire->etat= 1;
        $inventaire->observation= $request->input('obs');
        $inventaire->date_inventaire_valider = now();
        $inventaire->user_valide_id = Auth::user()->id;
        $inventaire->update();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Inventaires::find($id);
        if(is_null($data))
            return response()->json(['error' => 'Resource introuvable'], 404);
        else
        {
            $data->delete();
            return $data;
        }
    }

    public function categorie()
    {
        $categorie=Categorie::all();
        return$categorie;
    }
    public function toutinventaire()
    {
        $modele = DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->select('modeles.id as id',
                'modeles.libelle as modele',
                'modeles.quantite as quantite',
                'produits.nom as produit',
                'categories.nom as categorie'
            )
            ->get();
        return datatables()->of($modele)
            ->addColumn('action', function ($clt){
                return '
<a class="modal-with-form btn btn-success" onclick="editinventaire('.$clt->id.')"> <i class="fa fa-pencil"></i></a>';
            })
            ->make(true) ;
    }
    public function inventairecategorie($id)
    {
        $modele = DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->where('categories.id','=',$id)
            ->select('modeles.id as id',
                'modeles.libelle as modele',
                'modeles.quantite as quantite',
                'produits.nom as produit',
                'categories.nom as categorie'
            )
            ->get();
        return datatables()->of($modele)
            ->addColumn('action', function ($clt){
                return '
<a class="modal-with-form btn btn-success" onclick="editinventaire('.$clt->id.')"> <i class="fa fa-pencil"></i></a>';
            })
            ->make(true) ;
    }
}
