<?php

namespace App\Http\Controllers;

use App\CompteBancaire;
use App\SoldDepot;
use App\Versement;
use App\DepenseFile;
use App\JournalDepense;
use App\Historique;
use App\File;
use Illuminate\Support\Facades\Storage;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CaisseController extends Controller
{
    public function liste()
    {
        
        $caisse=DB::table('caisses')
            ->get();
            $boutique=DB::table('boutiques')
            ->get();
           /*  $commandes = Commande::with('boutique')->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->join('fournisseurs', function ($join) {
                $join->on('commandes.fournisseur_id', '=', 'fournisseurs.id');
            })->selectRaw('fournisseurs.id, fournisseurs.nom, SUM(commandes.totaux) as total')
            ->groupBy('fournisseurs.id', 'fournisseurs.nom')
            ->get(); */
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Caisse Achat";
        $historique->user_id = Auth::user()->id;
        $historique->save();
    return view('caisse.liste',compact('caisse','boutique'));
    }

   
    public function versements()
    {    $versement=3;
        
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Depense";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        return view('versement.listeVersement');
    }

    public function store_depense(Request $request)
    {
        DB::beginTransaction();

        $record = Versement::findorfail($request->depense_id);

        $name = File::newFile($request->file, "justify");
        if($name){
            if (request()->hasFile('file')) {
                $file = request()->file('file');
                $record->justificatif_versement = $file->store('path/to/storage');
            }
        
            $record->save();
        }
        $record->statut = 1;
        $record->update();

        $modele = CompteBancaire::find($record->compte_id);
        $modele->solder = $modele->solder + $record->montant;
        $modele->save();
        DB::commit();

        return redirect()->back()->with('success', 'Fichier Enregistrer');

    }

    public function destroy_file($id)
    {
        $charge = Versement::findOrFail($id);
        if (!$charge) {
            abort(404);
        }
    
        if ($charge->justificatif_versement) {
            Storage::delete($charge->justificatif_versement);
            $charge->justificatif_versement = null;
            $charge->save();
        }

        $historique = new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Dépense Fichier";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        return redirect()->back();
    }

    public function create_depense_file($id)
    {
        $depense = Versement::findorfail($id);
        $historique = new Historique();
        $historique->actions = "Créer";
        $historique->cible = "Dépense file";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('versement/add_depense_file', compact('depense'));
    }

    public function index()
    {
        $charge = Versement::orderBy('versements.created_at', 'DESC')->get();
        return datatables()->of($charge)
            ->addColumn('action', function ($clt) {

                return
                        '
                        <a class="btn btn-success" onclick="editcharge(' . $clt->id . ')"> <i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger" onclick="deletecharge(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a>';
            })
            ->make(true);
    }

    public function indexVALIDATION()
    {
       /*  $charge = DB::table('versements')
                    ->join('comptes', function ($join) {
                    $join->on('versements.compte_id', '=', 'comptes.id');
            })
            ->select('versements.*','compte.numero as numero')
            ->orderBy('versements.created_at', 'DESC')
            ->get(); */
            $charge = Versement::where('statut',0)->orderBy('versements.created_at', 'DESC')->get();
            return datatables()->of($charge)
            ->addColumn('action', function ($clt) {

                return
                        '<a class="btn btn-info" href="/depenseversem-files-' . $clt->id . '"> <i class="fa fa-file"></i></a>';
            })
            ->make(true);

            
    }

    public function create_depot()
    {
        //dd('rtttyt');
        $comptes = DB::table('banques')
        ->join('agence_banques','agence_banques.banque_id','=','banques.id')
        ->join('compte_bancaires','compte_bancaires.agence_id','=','agence_banques.id')
        ->select('compte_bancaires.id as id','compte_bancaires.numero as numero','agence_banques.nom as agence','banques.nom as banques')
        ->get();
        $historique = new Historique();
        $historique->actions = "Créer";
        $historique->cible = "versement";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('versement/add_depot',compact('comptes'));
    }

    public function store_depot(Request $request)
    {
        DB::beginTransaction();
        $charge = new Versement();
        $charge->montant = $request->montant;
        $charge->date = date('Y-m-d', strtotime($request->date));
        $charge->nature = $request->nature;
        $charge->compte_id =$request->compte_id;
        $charge->description = $request->description;
      /*   if (request()->hasFile('file')) {
            $file = request()->file('file');
            $filename = $file->store('path/to/storage');
            $charge->justificatif_versement = $filename;
        } */

        $charge->user_id = Auth::user()->id;

        $charge->save();

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Versement";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        DB::commit();

        return redirect("/allversements")->with('success', 'Versement effectuer avec success');
    }
    
}
