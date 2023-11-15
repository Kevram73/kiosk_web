<?php

namespace App\Http\Controllers;

use App\Caisse;
use App\CompteBancaire;
use App\Billing;
use App\BillingCaisse;
use App\CaisseBoutique;
use App\SoldDepot;
use App\Versement;
use App\User;

use App\Depense;

use Carbon\Carbon;
use App\vente;
use App\DepenseFile;
use App\JournalDepense;
use App\Historique;
use App\File;

use App\Client;
use Illuminate\Support\Facades\Storage;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CaisseController extends Controller
{
    public function liste()
    {
        $globalbybousimple=   DB::table('caisse_boutiques')
        ->sum('solde_total');
        $montantverse=   DB::table('versements')
        ->where('statut',1)
        ->sum('montant');
        $montantaverse=  intval($globalbybousimple-$montantverse);
          $collecteur =DB::table('collecters')
            ->join('users', function ($join) {
                $join->on('collecters.user_id_collecteur', '=', 'users.id');
            })
            ->select('users.*')
            ->get();
       $caissere=DB::table('caisses')
        ->join('users','users.id','caisses.user_id')
        ->join('boutiques','boutiques.id','caisses.boutique_id')
        ->select('caisses.*','boutiques.nom as boutique','users.nom as user')
        ->get();
         $caisse = Caisse::select('date', DB::raw('SUM(solde) as solde'), DB::raw('SUM(montantcollecte) as total_montantcollecte'),
         DB::raw('SUM(soldeMagasin) as soldeMagasin'),DB::raw('SUM(remise) as remise'),DB::raw('SUM(ventenette) as ventenette')
         ,DB::raw('SUM(totalVente) as totalVente'),DB::raw('SUM(totalDepense) as totalDepense'),DB::raw('SUM(recouvrementInte) as recouvrementInte')
         ,DB::raw('SUM(venteCredit) as venteCredit'),DB::raw('SUM(ventenonlivre) as ventenonlivre'),DB::raw('SUM(recetteTotal) as recetteTotal'))
        ->groupBy('date')
        ->get();
        //dd($caisse[0]->total_montantcollecte);
         $versements = Versement::select('versements.date' , DB::raw('SUM(montant) as verse'))
                               
                                ->where('versements.statut',1)
                                ->groupBy('versements.date')
                                ->get();

        $collectesvents = Caisse::select('caisses.date' , DB::raw('SUM(montantcollecte) as total_montantcollecte'))
                               
                                ->groupBy('caisses.date')
                                ->get();
        //dd($versements);
            $boutique=DB::table('boutiques')
            ->get();
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Caisse Achat";
        $historique->user_id = Auth::user()->id;
        $historique->save();     

       return view('caisse.liste',compact('caisse','globalbybousimple','montantverse','montantaverse','collectesvents','collecteur','versements','caissere','boutique'));
    }
    public function listeglobal()
    {
        $records = DB::table('caisses')->where('boutique_id',Auth::user()->boutique->id)->get();

            if (count($records) > 0) {
                $caisse = DB::table('boutiques')
                ->join('caisses', function ($join) {
                    $join->on('caisses.boutique_id', '=', 'boutiques.id');
                })
                ->where('caisses.boutique_id',Auth::user()->boutique->id)
                ->select('caisses.*','boutiques.*')
                ->orderBy('caisses.date','desc')
                ->get();
                $global=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })
                ->join('reglements', function ($join) {
                    $join->on('reglements.vente_id', '=', 'ventes.id');
                })
                ->join('depenses', function ($join) {
                    $join->on('depenses.boutique_id', '=', 'boutiques.id');
                })

                ->selectRaw('sum(ventes.totaux) as totalVente ,sum(ventes.totaux - ventes.montant_reduction ) as VenteNette, sum(ventes.montant_reduction) as totalReduction,
                sum(reglements.montant_donne) as totalReglement ,depenses.date_dep, sum(depenses.montant) as totalDepense , boutiques.nom as boutique')

                ->groupBy('depenses.date_dep','boutiques.id','boutiques.nom')
                ->orderBy('depenses.date_dep', 'desc','boutiques.id', 'desc')
                ->get();
            } else {
                return view('caisse.listeglobal');
                  }


        //dd($global);


        return view('caisse.listeglobal',compact('global','caisse'));
    }
    public function versements()

    {  
         $date = Carbon::now()->format('Y-m-d');  
         $globalbybousimple=   DB::table('caisse_boutiques')
                 ->where('created_at',$date)
                ->sum('solde_total');
                $montantverse=   DB::table('versements')
                ->where('created_at',$date)
                ->where('statut',1)
                ->sum('montant');
                $montantaverse=  intval($globalbybousimple-$montantverse);
                  $collecteur =DB::table('collecters')
        ->join('users', function ($join) {
            $join->on('collecters.user_id_collecteur', '=', 'users.id');
        })
        ->select('users.*')
        ->get();
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Depense";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        return view('versement.listeVersement',compact('globalbybousimple','montantverse','montantaverse','collecteur'));
    }
    public function listemontantcollecte()
    {
         $charge =DB::table('caisses')
        ->join('boutiques', function ($join) {
            $join->on('caisses.boutique_id', '=', 'boutiques.id');
        })
        ->join('users', function ($join) {
            $join->on('caisses.user_id', '=', 'users.id');
        })
        ->select('caisses.*','boutiques.nom as boutique','users.nom as boutiquier')
        ->orderBy('caisses.date', 'DESC')->get();
         //dd($charge);
        return datatables()->of($charge)

            ->make(true);
    }
 public function store_depense(Request $request)
    {

        $record = Versement::findorfail($request->depense_id);

       // $name = File::newFile($request->file, "storage/fichiers");
       // if($name){
            if (request()->hasFile('file')) {
                $file = request()->file('file');

                $record->justificatif_versement = $file->store('storage/fichiers');
                
                $file->store('public/storage/fichiers/');
            }

            $record->save();
                                   // dd($file);

       // }
        $record->statut = 1;
        $record->update();

        $modele = CompteBancaire::find($record->compte_id);
        $modele->solder = $modele->solder + $record->montant;
        $modele->save();
       // DB::commit();

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
                        <a class="btn btn-info" href="/UPDATEVERSEMENT-' . $clt->id . '"> <i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger" onclick="deletecharge(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a>
                        <a class="btn btn-info" href="/justificatifversement-' . $clt->id . '"> <i class="fa fa-file"></i></a>

                        ';
            })
            ->make(true);
    }

    public function justificatifversement($id)
    {
        $depense = Versement::findorfail($id);

        return view('versement.imagejustificatif',compact('depense'));
    }



    public function UPDATEVERSEMENT($id)
    {
        $comptes = DB::table('banques')
        //->join('agence_banques','agence_banques.banque_id','=','banques.id')
        ->join('compte_bancaires','compte_bancaires.banque_id','=','banques.id')
        ->select('compte_bancaires.id as id','compte_bancaires.numero as numero','banques.nom as banques')
        ->get();
        $solde =   DB::table('caisse_boutiques')
        ->sum('solde_total');
        $versements = Versement::findorfail($id);
        return view('versement.editdepot',compact('versements','solde','comptes'));
    }

    public function editversement(Request $request, $id)
    {
        $nature = $request->input('nature');
        $montant = $request->input('montant');
        $description = $request->input('description');

        $date = date('Y-m-d', strtotime($request->date));
        $statut=0;
        $compte_id = $request->input('compte_id');

         DB::table('versements')
                        ->where('id', $id)
                        ->update([
                            'nature' => $nature,
                            'montant' =>  $montant,
                            'description' =>  $description,
                            'date' =>  $date,

                            'statut' =>  $statut,

                            'compte_id' =>  $compte_id,
                        ]);
                        return redirect('allversements')->with('success','Versement modifié');
    }
    public function indexVALIDATION()
    {


       $charge =DB::table('versements')
            ->join('compte_bancaires', function ($join) {
                $join->on('versements.compte_id', '=', 'compte_bancaires.id');
            })
            ->join('users', function ($join) {
                $join->on('versements.user_id', '=', 'users.id');
            })
            ->where('statut',0)

          ->select('versements.id','versements.date as date','compte_bancaires.numero as compte','versements.montant','users.nom as utilisateur',
            'versements.nature as nature','versements.description as description','versements.statut as statut')
            ->get();
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
        //->join('agence_banques','agence_banques.banque_id','=','banques.id')
        ->join('compte_bancaires','compte_bancaires.banque_id','=','banques.id')
        ->select('compte_bancaires.id as id','compte_bancaires.numero as numero','banques.nom as banques')
        ->get();
        $globalbybousimple=   DB::table('caisse_boutiques')
        ->sum('solde_total');
        $montantverse=   DB::table('versements')
        ->where('statut',1)
        ->sum('montant');
        $solde=  intval($globalbybousimple-$montantverse);
             /*  $solde =   DB::table('caisse_boutiques')
              ->sum('solde_total'); */

        $historique = new Historique();
        $historique->actions = "Créer";
        $historique->cible = "versement";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('versement/add_depot',compact('comptes','solde'));
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
       /*  $client = CompteBancaire::find($charge->compte_id);
            // Mise à jour des informations de l'utilisateur
            $client->solder = $client->solder + $charge->montant;
            // Sauvegarde des modifications
            $client->save(); */

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Versement";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        DB::commit();

        return redirect("/allversements")->with('success', 'Versement effectuer avec success');
    }

    public function valeurBilling($id)
    {
        $fournisseur = DB::table('billings')
            ->where ('id', '=', $id)
            ->select (
                'id as id',
                'value as prix',
                'type as modele')
            ->get();
        return $fournisseur;
    }
    public function addBullingshow()
    {

        $billings = Billing::all();
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Ajouter les billings";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('caisse.addbullingshow',compact('billings'));
    }
 public function storeCaisseCollect(Request $request)
    {
        //dd($request->input('soldeMagasin'));
        DB::beginTransaction();

        $reglement=new Caisse();
        $reglement->solde = $request->input('solde');
        $reglement->date = date('Y-m-d', strtotime($request->date));
        $reglement->totalVente = $request->input('totalVente');
        $reglement->remise = $request->input('remise');
        $reglement->ventenette = $request->input('ventenette');
        $reglement->venteCredit = $request->input('venteCredit');
        $reglement->recouvrementInte = $request->input('recouvrementInte');
        $reglement->ventenonlivre = $request->input('ventenonlivre');
        $reglement->totalDepense = $request->input('totalDepense');
        $reglement->montantcollecte = $request->input('montantcollecte');
        $reglement->recetteTotal = $request->input('recetteTotal');
        $reglement->soldeMagasin = $request->input('soldeMagasin');
        $reglement->boutique_id = Auth::user()->boutique->id;
        $reglement->user_id = Auth::user()->id;


        $reglement->save();
        DB::commit();
        //return [];
        return redirect('/listeglobal')->with('success', 'Caisse effectuer avec success');


    }



   public function store(Request $request)
    {
        try{
        //dd($request);
        $allcommande= explode( ',', $request->input('venTable') );
        //dd($allcommande);

        //$i=DB::table('billing_caisses')->max('id');
        $id=DB::table('caisses')->max('id');
        DB::beginTransaction();
        $livraison = new CaisseBoutique();
        $livraison ->boutique_id = Auth::user()->boutique->id;
        $livraison->save();
        $total = 0;
        for ($i =0 ;$i<count($allcommande);$i+=4) {
              $prevente = new BillingCaisse();
            $prevente ->user_id= Auth::user()->id;
            $prevente ->billing_id=$allcommande[$i+1];
            $prevente ->prix=$allcommande[$i];
            $prevente ->nombre= $allcommande[$i+3];
            $prevente ->total = $allcommande[$i+3]*$allcommande[$i];
            $prevente ->boutique_id= Auth::user()->boutique->id;
            $prevente ->caisse_id= $id;

            $prevente->save();
         /*    $total = $total + $prevente->total;

            $modele= Caisse::findOrFail($allcommande[$i]);
            if($modele->solde > $total)
            {
                DB::rollback();
                return response()->json(["msg" => "Attention billing supérieur  au solde de caisse"], 500);
            }

            $total = $total + $prevente->prixtotal;*/
            $commande= CaisseBoutique::findOrFail($livraison->id);
            $commande->solde_total=$commande->solde_total+  $prevente -> total;
            $commande->update();
        }
        //error_log($allcommande);
        DB::commit();
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "billings";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return $prevente;
            } catch (\Exception $e) {
                DB::rollback();
                return $e;
            }
    }



    public function showdetailcaisse()
    {
        $date = Carbon::now()->format('Y-m-d');
        $existe = DB::table('caisses')
                        ->where('date', '=', $date)
                        ->where ('boutique_id', '=',Auth::user()->boutique->id )
                        ->exists();
                        //dd($existe);
                        $boutiques= DB::table('boutiques')
                            ->where ('id', '=',Auth::user()->boutique->id )
                            ->get();
            // si aucune ligne n'existe, insérer une nouvelle ligne avec la date d'aujourd'hui et un montant de zéro
            if(!$existe) {
                $globalbybousimple=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })

                ->where('ventes.boutique_id',Auth::user()->boutique->id)
                //->where('ventes.date_vente',now())
                ->whereDate('ventes.date_vente', '=', $date)
                //->where(Carbon::createFromFormat('Y-m-d', $datevente),$date)
                ->where('ventes.type_vente',1)
                ->sum('ventes.totaux');

                //dd($globalbybousimple);

            /*     $globalbyboucredit=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })

                ->where('boutiques.id',Auth::user()->boutique->id)
                //->where('ventes.date_vente',now())
                ->whereDate('ventes.date_vente', '=', $date)

                ->where('ventes.type_vente',2)
                ->sum('ventes.totaux') ;
                */
               // $montant=DB::table('billing_caisses')->max('total');
                $montant=DB::table('billing_caisses')
                ->latest('created_at')
                ->pluck('total')
                ->first();
                $total = DB::table('billing_caisses')
                    ->whereDate('created_at', $date)
                    ->where('boutique_id',Auth::user()->boutique->id ) // Remplacer today() par la date souhaitée
                    ->sum('total');
                $totalmontant = DB::table('caisse_boutiques')
                ->where('boutique_id',Auth::user()->boutique->id )
                ->latest('id')
                ->pluck('solde_total')
                ->first();

                //dd($totalmontant);
                $globalbyboucredit = Client::join('reglements', 'reglements.client_id', '=', 'clients.id')
                        ->where ('clients.boutique_id', '=',Auth::user()->boutique->id )
                        ->where('reglements.type',1)
                        ->whereDate('reglements.created_at', '=', $date)
                        ->sum('reglements.montant_restant');
                $globalbybounonlivret=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })
                ->where('boutiques.id',Auth::user()->boutique->id)
               // ->where('ventes.date_vente',now())
               ->whereDate('ventes.date_vente', '=', $date)
                ->where('ventes.type_vente',3)
                ->sum('ventes.totaux') ;
                $globalbybouventeglobal=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })
                ->where('boutiques.id',Auth::user()->boutique->id)
                //->where('ventes.date_vente',now())
                 ->where('ventes.type_vente',1)
                //->where('ventes.type_vente',4)
                ->whereDate('ventes.date_vente', '=', $date)
                  ->where('ventes.with_avoir',0)
                ->sum('ventes.totaux') ;
                $globalbybouremiseglobal=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })
                ->where('boutiques.id',Auth::user()->boutique->id)
                //->where('ventes.date_vente',now())
                
                ->whereDate('ventes.date_vente', '=', $date)

                ->sum('ventes.montant_reduction');
                $venteNette = $globalbybouventeglobal;
                  $globalbyboutiqAvoir =  DB::table('clients')                
                ->where('boutique_id',Auth::user()->boutique->id)
                ->whereDate('updated_at', '=', $date)
                ->where('with_avoir',1)
                ->sum('avoir');
                $recouvrementInterieur = DB::table('clients')
                ->join('reglements', 'reglements.client_id', '=', 'clients.id')
                        ->where ('clients.boutique_id', '=',Auth::user()->boutique->id )
                        //->where('reglements.date_reglement',now())
                        ->whereDate('reglements.created_at', '=', $date)

                    ->sum('reglements.montant_donne');
                    //dd($recouvrementInterieur);
                    $TOTALdepense = Depense::where('boutique_id', Auth::user()->boutique->id)
                    //->where('depenses.date_dep',now())
                    ->whereDate('depenses.date_dep', '=', $date)

                    ->sum('montant');
                     $dernieresolde=DB::table('caisses')->where('boutique_id',Auth::user()->boutique->id )->max('soldeMagasin');

                     if($dernieresolde == null)
                    {
                      $dernieresolde = 0;
                    }else{
                        $dernieresolde = DB::table('caisses')
                            ->where('boutique_id',Auth::user()->boutique->id )
                            ->latest('id')
                            ->pluck('soldeMagasin')
                            ->first();

                    }



                 $recetteTotale = $venteNette - $TOTALdepense +$recouvrementInterieur +$globalbybounonlivret;
                 $soldemagasin =$recetteTotale - $totalmontant +$dernieresolde;
                //dd($globalbyboucredit);
            } else{
        // récupérer la dernière date enregistrée dans la table
                    $derniereDate = DB::table('caisses')
                        ->max('date');
                       // $montant=DB::table('billing_caisses')->max('total');
                       $montant=DB::table('billing_caisses')
                       ->latest('created_at')
                       ->pluck('total')
                       ->first();
                       $total = DB::table('billing_caisses')
                       ->whereDate('created_at', $date)
                       ->where('boutique_id',Auth::user()->boutique->id ) // Remplacer today() par la date souhaitée
                       ->sum('total');

                       $totalmontant = DB::table('caisse_boutiques')
                       ->where('boutique_id',Auth::user()->boutique->id )
                       ->latest('created_at')
                       ->pluck('solde_total')
                       ->first();
                    //dd($soldemagasin);
            $date_carbon = Carbon::createFromFormat('Y-m-d', $derniereDate); // Conversion de la chaîne en objet Carbon
            $date_carbon->addDay();

            //$date=$date_carbon->addDay();
        // calculer la somme des montants enregistrés dans la table pour la période allant du lendemain de la dernière date enregistrée jusqu'à la date actuelle
                       $globalbybousimple=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })

                ->where('boutiques.id',Auth::user()->boutique->id)

                ->whereDate('ventes.date_vente', '>=', $date_carbon->addDay())
                //->where('ventes.date_vente', '<', now())
                ->whereDate('ventes.date_vente', '<', $date)

                ->where('ventes.type_vente',1)
                ->sum('ventes.totaux');

                $globalbyboucredit = Vente::join('reglements', 'reglements.vente_id', '=', 'ventes.id')
                ->where ('ventes.boutique_id', '=',Auth::user()->boutique->id )
                //->where('reglements.date_reglement',now())
                ->whereDate('reglements.created_at', '>=', $date_carbon->addDay())
                ->where('reglements.type',1)
                ->whereDate('reglements.created_at', '<', $date)
                ->sum('reglements.montant_restant');

                $globalbybounonlivret=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })

                ->where('boutiques.id',Auth::user()->boutique->id)

                ->whereDate('ventes.date_vente', '>=', $date_carbon->addDay())
                //->where('ventes.date_vente', '<', now())
                ->whereDate('ventes.date_vente', '<', $date)

                ->where('ventes.type_vente',3)
                ->sum('ventes.totaux') ;
                $globalbybouventeglobal=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })
                ->where('boutiques.id',Auth::user()->boutique->id)

                ->whereDate('ventes.date_vente', '>=', $date_carbon->addDay())
                //->where('ventes.date_vente', '<', now())
                 ->where('ventes.type_vente',1)
                ->where('ventes.type_vente',4)
                  ->where('ventes.with_avoir',0)
                ->whereDate('ventes.date_vente', '<', $date)

                ->sum('ventes.totaux') ;
                $globalbybouremiseglobal=   DB::table('boutiques')
                ->join('ventes', function ($join) {
                    $join->on('ventes.boutique_id', '=', 'boutiques.id');
                })
                ->where('boutiques.id',Auth::user()->boutique->id)

                ->whereDate('ventes.date_vente', '>=', $date_carbon->addDay())
                //->where('ventes.date_vente', '<', now())
                ->whereDate('ventes.date_vente', '<', $date)

                ->sum('ventes.montant_reduction');
                $globalbyboutiqAvoir =  DB::table('clients')                
                ->where('boutique_id',Auth::user()->boutique->id)
              
                ->whereDate('updated_at', '>=', $date_carbon->addDay())
                ->whereDate('updated_at', '<', $date)
                ->where('with_avoir',1)
                ->sum('avoir');
              
                $venteNette = $globalbybouventeglobal;
                $recouvrementInterieur = Vente::join('reglements', 'reglements.vente_id', '=', 'ventes.id')
                        ->where ('ventes.boutique_id', '=',Auth::user()->boutique->id )
                       // ->where('reglements.date_reglement',now())
                        ->whereDate('reglements.created_at', '=', $date)

                        ->whereDate('reglements.created_at', '>=', $date_carbon->addDay())
                        //->where('reglements.date_reglement', '<', now())
                        ->whereDate('reglements.date_reglement', '<', $date)

                    ->sum('reglements.montant_donne');
                    $TOTALdepense = Depense::where('boutique_id', Auth::user()->boutique->id)

                    ->whereDate('depenses.date_dep', '>=', $date_carbon->addDay())
                    //->where('depenses.date_dep', '<', now())
                    ->whereDate('depenses.date_dep', '<', $date)
                    ->sum('montant');
                    $dernieresolde= Caisse::where('boutique_id', Auth::user()->boutique->id)

                    ->whereDate('caisses.date', '>=', $date_carbon->addDay())
                    //->where('caisses.date', '<', now())
                    ->whereDate('caisses.date', '<', $date)
                    ->select('soldeMagasin');
        $recetteTotale = $venteNette - $TOTALdepense +$recouvrementInterieur +$globalbybounonlivret;
        $soldemagasin =$recetteTotale - $totalmontant +$dernieresolde;
        //$soldeMagasin =$recetteTotale + $dernieresolde - $TOTALdepense-;
                //dd($globalbyboucredit);
            }
            return view('caisse.addcaisse', compact('boutiques','soldemagasin','globalbyboutiqAvoir','dernieresolde','date','recetteTotale','TOTALdepense','recouvrementInterieur','venteNette',
            'globalbybouremiseglobal','totalmontant','montant','globalbybouventeglobal','globalbybounonlivret','globalbyboucredit','globalbybousimple'));
    }

}
