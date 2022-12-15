<?php

namespace App\Http\Controllers;

use App\Boutique;
use App\Categorie;
use App\Commande;
use App\commandeModele;
use App\Fournisseur;
use App\Historique;
use App\Modele;
use App\Journal_achat;
use App\Produit;
use App\produitProvision;
use App\Provision;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

class CommandesController extends Controller
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
    public function fournisseur($id)
    {
        $fournisseur=Provision::with('fournisseur','produit')->where ('produit_id', '=', $id)->get();
        return $fournisseur;
    }
    public function provision($id,$ed)
    {
        $provision=DB::table('provisions')
            ->where ('fournisseur_id', '=', $id)
            ->where ('produit_id', '=', $ed)

            ->get();
        return $provision;
    }
    public function commande($id)
    {
        $commande = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->join('modeles', function ($join) {
                $join->on('modeles.id', '=', 'commande_modeles.modele');
            })
            ->join('produits', function ($join) {
                $join->on('produits.id', '=', 'modeles.produit_id');
            })
            ->where('commandes.id','=',$id)
            ->select(
                'modeles.libelle as modele',
                'commande_modeles.etat as etat',
                'produits.nom as produit',
                'commande_modeles.id as id')
            ->get();
        return $commande;
    }


    public function index()
    {
        $commande = Commande::with(['boutique'])->where ('boutique_id', '=',Auth::user()->boutique->id)->get();
        return datatables()->of($commande)
            ->addColumn('action', function ($clt) {
                return  '<a class="btn btn-info " onclick="show(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>
                                    <a class="btn btn-danger" onclick="deletepro(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true);
    }


    public function liste($id)
    {
        $categorie=Categorie::all();
        $commande = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->join('modele_fournisseurs', function ($join) {
                $join->on('modele_fournisseurs.id', '=', 'commande_modeles.modele_fournisseur_id');
            })
            ->join('modeles', function ($join) {
                $join->on('modeles.id', '=', 'modele_fournisseurs.modele_id');
            })
            ->join('produits', function ($join) {
                $join->on('produits.id', '=', 'modeles.produit_id');
            })
            ->join('fournisseurs', function ($join) {
                $join->on('fournisseurs.id', '=', 'modele_fournisseurs.fournisseur_id');
            })
            ->where('commandes.id','=',$id)
            ->select('commandes.numero as numero',
                'commandes.date_commande as date',
                'fournisseurs.nom as fournisseur',
                'modeles.libelle as modele',
                'produits.nom as produit',
                'commande_modeles.quantite as quantite',
                'commande_modeles.prix as prix',
                'commandes.created_at as create',
                'commandes.updated_at as update')
            ->get();
        $historique=new Historique();
        $historique->actions = "Liste";
        $historique->cible = "Commandes";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return view('provision',compact('categorie','commande'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    $fournisseurs=Fournisseur::all();
    $categorie=Categorie::all();
    $produits=Produit::all();
    $modeles=Modele::all();
    $modele2=DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->whereColumn('modeles.seuil','>=','modeles.quantite')
            ->get();
        $mod=count($modele2);
        $clients=DB::table('clients')
            ->join('ventes', function ($join) {
                $join->on('ventes.client_id', '=', 'clients.id');
            })
            ->join('reglements', function ($join) {
                $join->on('reglements.vente_id', '=', 'ventes.id');
            })
            ->where ('ventes.boutique_id', '=',Auth::user()->boutique->id )
            ->where('reglements.montant_restant', '>', 0)
            ->select('clients.nom as nom','clients.id as id')
            ->groupBy('id', 'clients.nom')
            ->get();
        $credit=array();
        for ($i =0 ;$i<count($clients);$i++) {
            $total = DB::table('reglements')
                ->join('ventes', function ($join) {
                    $join->on('reglements.vente_id', '=', 'ventes.id');
                })
                ->where('ventes.client_id', '=', $clients[$i]->id)
                ->SUM('reglements.montant_restant');
            $credit[$i] = $total;
        }
        $cre=count($clients);
        return view('newcommande',compact('categorie', 'produits', 'modeles', 'fournisseurs', 'mod','modele2','clients','credit','cre'));
    }
  public function create2()
    {
    $fournisseur=Fournisseur::all();
    $categorie=Categorie::all();
    $produits=Produit::all();
    $modeles=Modele::all();
    $modele2=DB::table('modeles')
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->whereColumn('modeles.seuil','>=','modeles.quantite')
            ->get();
        $mod=count($modele2);
        $clients=DB::table('clients')
            ->join('ventes', function ($join) {
                $join->on('ventes.client_id', '=', 'clients.id');
            })
            ->join('reglements', function ($join) {
                $join->on('reglements.vente_id', '=', 'ventes.id');
            })
            ->where ('ventes.boutique_id', '=',Auth::user()->boutique->id )
            ->where('reglements.montant_restant', '>', 0)
            ->select('clients.nom as nom','clients.id as id')
            ->groupBy('id', 'clients.nom')
            ->get();
        $credit=array();
        for ($i =0 ;$i<count($clients);$i++) {
            $total = DB::table('reglements')
                ->join('ventes', function ($join) {
                    $join->on('reglements.vente_id', '=', 'ventes.id');
                })
                ->where('ventes.client_id', '=', $clients[$i]->id)
                ->SUM('reglements.montant_restant');
            $credit[$i] = $total;
        }
        $cre=count($clients);
        return view('newcommande2',compact('categorie', 'produits', 'modeles', 'fournisseur','mod','modele2','clients','credit','cre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function a($id)
    {
        $verification = DB::table('commande_modeles')
            ->join('modeles', function ($join) {
                $join->on('commande_modeles.modele', '=', 'modeles.id');
            })
            ->join('modele_fournisseurs', function ($join) {
                $join->on('modele_fournisseurs.modele_id', '=', 'modeles.id');
            })
            ->where('modele_fournisseurs.id', '=', $id)
            ->select('modeles.id as modele')
            ->get();
        return $verification;
    }
    public function store(Request $request)
    {
        $id=DB::table('commandes')->max('id');
        $ad=DB::table('journal_achats')->max('id');

        $ed=1+$id;
        $commande = new Commande();
        $commande ->numero="COM".now()->format('Y')."-".$ed;
        $commande ->date_commande= now();
        $commande ->journal_achat_id= $ad;
        $commande ->boutique_id= Auth::user()->boutique->id;
        $commande ->type_commande= 1;
        $commande ->fournisseur_id= $request->input('fournisseur');
        $commande ->credit = $request->input('credit') == "on" ? true : false;
        $commande->save();
        $allcommande= explode( ',', $request->input('comTable') );

        for ($i =0;$i<count($allcommande);$i+=3) {
            $verification = DB::table('modele_fournisseurs')
                ->join('modeles', function ($join) {
                    $join->on('modele_fournisseurs.modele_id', '=', 'modeles.id');
                })
                ->where('modele_fournisseurs.id', '=', $allcommande[$i])
                ->select('modeles.id as modele')
                ->first();
            $modeleId = $verification ? $verification->modele : $allcommande[$i];

            $commandemodele = new commandeModele();
            $commandemodele ->commande_id=$commande ->id;
            $commandemodele ->modele_fournisseur_id= $verification ? $allcommande[$i] : null;
            $commandemodele ->prix =$allcommande[$i+1];
            $commandemodele -> quantite= $allcommande[$i+2];
            $commandemodele -> total= $allcommande[$i+1]*$allcommande[$i+2];
            $commandemodele -> modele=$modeleId;
            $commandemodele->save();

            $modele= Modele::findOrFail($modeleId);
            if($modele->quantite <= 0)
            {
                $modele->quantite = $allcommande[$i+2];
            }else{
                $modele->quantite=$modele->quantite +  $allcommande[$i+2];
            }

            $modele->update();

            $commande= Commande::findOrFail($commande ->id);
            $commande->totaux=$commande->totaux+  $commandemodele -> total;
            $commande->update();
        }

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Commandes directe";
        $historique->user_id =Auth::user()->id;
        $historique->save();
    return view('provision');
    }
    public function store2(Request $request)
    {
        $id=DB::table('commandes')->max('id');
        $ad=DB::table('journal_achats')->max('id');
        $ed=1+$id;
        $commande = new Commande();
        $commande ->numero="COM".now()->format('Y')."-".$ed;
        $commande ->date_commande= now();
        $commande ->journal_achat_id= $ad;
        $commande ->boutique_id= Auth::user()->boutique->id;
        $commande ->type_commande= 2;
        $commande ->fournisseur_id= $request->input('fournisseur');
        $commande ->credit = $request->input('credit') == "on" ? true : false;
        $commande->save();
        $allcommande= explode( ',', $request->input('comTable') );
        for ($i =0 ;$i<count($allcommande);$i+=3) {
            $verification = DB::table('modele_fournisseurs')
                ->join('modeles', function ($join) {
                    $join->on('modele_fournisseurs.modele_id', '=', 'modeles.id');
                })
                ->where('modele_fournisseurs.id', '=', $allcommande[$i])
                ->select('modeles.id as modele')
                ->first();
            $commandemodele = new commandeModele();
            $commandemodele ->commande_id=$commande ->id;
            $commandemodele ->modele_fournisseur_id=$allcommande[$i];
            $commandemodele ->prix =$allcommande[$i+1];
            $commandemodele -> quantite= $allcommande[$i+2];
            $commandemodele -> total= $allcommande[$i+1]*$allcommande[$i+2];
            $commandemodele -> modele=$verification->modele;
            $commandemodele->save();
            // $modele_id = DB::table('modeles')
            //     ->where('modeles.id','=',$allcommande[$i])
            //     ->select('modeles.id as id')
            //     ->get();
            // $modele= Modele::findOrFail($modele_id[0]->id);
            // $modele->quantite=$modele->quantite+  $allcommande[$i+2];
            // $modele->update();

            $commande= Commande::findOrFail($commande ->id);
            $commande->totaux=$commande->totaux+  $commandemodele -> total;
            $commande->update();
        }

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Commandes indirecte";
        $historique->user_id =Auth::user()->id;
        $historique->save();
    return view('provision');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

             public function show($id)
    {
             $verification = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
                 ->where('commandes.id','=',$id)
                 ->get();
             if ($verification[0]->modele_fournisseur_id==null){
                 $commande = DB::table('commandes')
                     ->join('commande_modeles', function ($join) {
                         $join->on('commande_modeles.commande_id', '=', 'commandes.id');
                     })
                     ->join('modeles', function ($join) {
                         $join->on('modeles.id', '=', 'commande_modeles.modele');
                     })
                     ->join('produits', function ($join) {
                         $join->on('produits.id', '=', 'modeles.produit_id');
                     })
                     ->where('commandes.id','=',$id)
                     ->select('commandes.numero as numero',
                         'commandes.date_commande as date',
                         'modeles.libelle as modele',
                         'produits.nom as produit',
                         'commande_modeles.quantite as quantite',
                         'commande_modeles.prix as prix',
                         'commandes.created_at as create',
                         'commandes.updated_at as update')
                     ->get();
                 $historique=new Historique();
                 $historique->actions = "Detail";
                 $historique->cible = "Commandes";
                 $historique->user_id =Auth::user()->id;
                 $historique->save();
                 return view('detailcommandedirect',compact('commande'));
             }
             else{
                 $commande = DB::table('commandes')
                     ->join('commande_modeles', function ($join) {
                         $join->on('commande_modeles.commande_id', '=', 'commandes.id');
                     })
                     ->join('modele_fournisseurs', function ($join) {
                         $join->on('modele_fournisseurs.id', '=', 'commande_modeles.modele_fournisseur_id');
                     })
                     ->join('modeles', function ($join) {
                         $join->on('modeles.id', '=', 'modele_fournisseurs.modele_id');
                     })
                     ->join('produits', function ($join) {
                         $join->on('produits.id', '=', 'modeles.produit_id');
                     })
                     ->join('fournisseurs', function ($join) {
                         $join->on('fournisseurs.id', '=', 'modele_fournisseurs.fournisseur_id');
                     })
                     ->where('commandes.id','=',$id)
                     ->select('commandes.numero as numero',
                         'commandes.date_commande as date',
                         'fournisseurs.nom as fournisseur',
                         'modeles.libelle as modele',
                         'produits.nom as produit',
                         'commande_modeles.quantite as quantite',
                         'commande_modeles.prix as prix',
                         'commandes.created_at as create',
                         'commandes.updated_at as update')
                     ->get();
                 $historique=new Historique();
                 $historique->actions = "Detail";
                 $historique->cible = "Commandes";
                 $historique->user_id =Auth::user()->id;
                 $historique->save();
                 return view('detailcommande',compact('commande'));
             }


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
        $provision= produitProvision::findOrFail($request->input('idprovision'));
        $provision->quantite = $request->input('quantite');
        $provision->prix_achat = $request->input('prix');
        $provision->date_provision = $request->input('dateprovision');
        $provision->provision_id = $request->input('provision');
        $provision->update();
        $historique=new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Commandes";
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
        $commande=Commande::findOrFail($id);
        DB::table('commande_modeles')->where('commande_id', '=', $commande->id)->delete();
        $commande ->delete();
        $historique=new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Commandes";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return [];
    }
    public function fermer()
    {
        $id=DB::table('journal_achats')->max('id');
        $journ= journal_achat::findOrFail($id);
        if ($journ->date_fermeture==null){
            $journ->date_fermeture =now();
            $journ->update();
            return 1;
        }
        else{
            return 2;
        }
    }
    public function verification()
    {
        $id=DB::table('journal_achats')->max('id');
        $journal = DB::table('journal_achats')
            ->where('journal_achats.id', '=', $id)
            ->select('journal_achats.date_fermeture as fermeture','journal_achats.date_creation as creation')
            ->get();
        if ($id==null){
            return 1;
        }
        $d1 = new DateTime($journal[0]->creation);
        if ($d1->format('Y-m-d') !== now()->format('Y-m-d') || $journal[0]->fermeture != null){
            return(2);
        }
        else
        {
            return(3);
        }
    }
    public function journal()
    {

        $journal= new Journal_achat();
        $journal->date_creation =now();
        $journal->mois = now()->format('m');
        $journal->annee = now()->format('Y');
        $journal->user_id = Auth::user()->id;
        $journal->boutique_id =Auth::user()->boutique->id;
        $journal->save();
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Journal";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return [];
    }
    public function achatdate($id)
    {
        $commande = DB::table('commandes')
            ->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->where('commandes.journal_achat_id', '=', $id)
            ->select('commandes.id as id','commandes.numero as commande',
                'commandes.totaux as totaux',
                'commandes.date_commande as date')
            ->get();
        return datatables()->of($commande)
            ->addColumn('action', function ($clt) {
                return  '<a class="btn btn-info " onclick="show(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>';
            })
            ->make(true) ;
    }

    public function adminachatdate($id,$ed)
    {
        $commande = DB::table('commandes')
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',$ed)
            ->where('commandes.journal_achat_id', '=', $id)
            ->select('commandes.id as id','commandes.numero as commande',
                'commandes.totaux as totaux',
                'commandes.date_commande as date')
            ->get();
        return datatables()->of($commande)
            ->addColumn('action', function ($clt) {
                return  '<a class="btn btn-info " onclick="show(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>';
            })
            ->make(true) ;
    }


    public function achatmois($id,$ed)
    {

        $commande = DB::table('commandes')
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where('journal_achats.mois', '=', $id)
            ->where('journal_achats.annee', '=', $ed)
            ->select('commandes.id as id','commandes.numero as commande',
                'commandes.totaux as totaux',
                'commandes.date_commande as date')
            ->get();
        return datatables()->of($commande)
            ->addColumn('action', function ($clt) {
                return  '<a class="btn btn-info " onclick="show(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>';
            })
            ->make(true) ;
    }

    public function adminachatmois($id,$ed,$ad)
    {

        $commande = DB::table('commandes')
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',$ad)
            ->where('journal_achats.mois', '=', $id)
            ->where('journal_achats.annee', '=', $ed)
            ->select('commandes.id as id','commandes.numero as commande',
                'commandes.totaux as totaux',
                'commandes.date_commande as date')
            ->get();
        return datatables()->of($commande)
            ->addColumn('action', function ($clt) {
                return  '<a class="btn btn-info " onclick="show(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>';
            })
            ->make(true) ;
    }

    public function achatannee($id)
    {

        $commande = DB::table('commandes')
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->where('journal_achats.annee', '=', $id)
            ->select('commandes.id as id','commandes.numero as commande',
                'commandes.totaux as totaux',
                'commandes.date_commande as date')
            ->get();
        return datatables()->of($commande)
            ->addColumn('action', function ($clt) {
                return  '<a class="btn btn-info " onclick="show(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>';
            })
            ->make(true) ;
    }

    public function adminachatannee($id,$ed)
    {
        $commande = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->join('modeles', function ($join) {
                $join->on('commande_modeles.modele', '=', 'modeles.id');
            })
            ->join('produits', function ($join) {
                $join->on('modeles.produit_id', '=', 'produits.id');
            })
            ->join('categories', function ($join) {
                $join->on('produits.categorie_id', '=', 'categories.id');
            })
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',$ed)
            ->where('journal_achats.annee', '=', $id)
            ->select('commandes.id as id',
                'commandes.numero as commande',
                'commandes.totaux as totaux',
                'commandes.date_commande as date',
                'commande_modeles.total',
                'modeles.libelle as modele',
                'produits.nom as produit','categories.nom as categorie')
            ->get();
        return datatables()->of($commande)
            ->addColumn('action', function ($clt) {
                return  '<a class="btn btn-info " onclick="show(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>';
            })
            ->make(true) ;
    }





    public function depensejour($id)
    {
        $depense = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->where('commandes.journal_achat_id', '=', $id)
            ->sum('commande_modeles.total');
        return $depense;
    }

    public function admindepensejour($id,$ed)
    {
        $depense = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->where ('commandes.boutique_id', '=',$ed)
            ->where('commandes.journal_achat_id', '=', $id)
            ->sum('commande_modeles.total');
        return $depense;
    }
    public function depensemois($id,$ed)
    {
        $depense = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->where('journal_achats.mois', '=', $id)
            ->where('journal_achats.annee', '=', $ed)
            ->sum('commande_modeles.total');
        return $depense;
    }

    public function admindepensemois($id,$ed,$ad)
    {
        $depense = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',$ad)
            ->where('journal_achats.mois', '=', $id)
            ->where('journal_achats.annee', '=', $ed)
            ->sum('commande_modeles.total');
        return $depense;
    }

    public function depenseannee($id)
    {
        $depense = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->where('journal_achats.annee', '=', $id)
            ->sum('commande_modeles.total');
        return $depense;
    }


    public function admindepenseannee($id,$ed)
    {
        $depense = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',$ed)
            ->where('journal_achats.annee', '=', $id)
            ->sum('commande_modeles.total');
        return $depense;
    }


    public function recuperdateachat()
    {
        $date = DB::table('commandes')
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->select('commandes.journal_achat_id as journal','journal_achats.id as id','journal_achats.date_creation as date')
            ->groupBy('journal', 'id', 'date')
            ->get() ;
        $a=array();
        $d=array();
        $c=array();
        $table=array();
        if($date==null){
            return $date;
        }
        else{
            for ($i = 0; $i <count($date); $i++) {
                setlocale(LC_TIME,'fr_FR','fra_FRA');
                $b=strftime('%A %d %B %G', strtotime($date[$i]->date));
                $a[$i]=$b;
                $d[$i]=$date[$i]->id;
                $c=mb_convert_encoding($a,'UTF-8','UTF-8');
            }
            $table["fran"]=$c;
            $table["id"]=$d;
            return $table;
        }
    }

    public function adminrecuperdateachat($id)
    {
        $date = DB::table('commandes')
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',$id)
            ->select('commandes.journal_achat_id as journal','journal_achats.id as id','journal_achats.date_creation as date')
            ->groupBy('journal', 'id', 'date')
            ->get() ;
        $a=array();
        $d=array();
        $c=array();
        $table=array();
        if($date==null){
            return $date;
        }
        else{
            for ($i = 0; $i <count($date); $i++) {
                setlocale(LC_TIME,'fr_FR','fra_FRA');
                $b=strftime('%A %d %B %G', strtotime($date[$i]->date));
                $a[$i]=$b;
                $d[$i]=$date[$i]->id;
                $c=mb_convert_encoding($a,'UTF-8','UTF-8');
            }
            $table["fran"]=$c;
            $table["id"]=$d;
            return $table;
        }
    }


    public function annee()
    {

        $date = DB::table('commandes')
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->select ('journal_achats.annee as annee')
            ->groupBy ('journal_achats.annee')
            ->get() ;

        return $date;
    }

    public function adminannee($id)
    {

        $date = DB::table('commandes')
            ->join('journal_achats', function ($join) {
                $join->on('commandes.journal_achat_id', '=', 'journal_achats.id');
            })
            ->where ('commandes.boutique_id', '=',$id)
            ->select ('journal_achats.annee as annee')
            ->groupBy ('journal_achats.annee')
            ->get() ;

        return $date;
    }



    public function historique()
    {
        return view('historiqueachat');
    }

    public function adminhistorique()
    {
        $boutiques=Boutique::all();
        return view('adminhistoriqueachat',compact('boutiques'));
    }


}
