<?php

namespace App\Http\Controllers;

use App\Commande;
use App\commandeModele;
use App\Historique;
use App\Livraison;
use App\Livraison_vente;
use App\livraisonCommande;
use App\LivraisonV;
use App\Modele;
use App\modeleFournisseur;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LivraisonsController extends Controller
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
        $livraison=Livraison::with('boutique')->where ('boutique_id', '=',Auth::user()->boutique->id)->get();
        return datatables()->of($livraison)
            ->addColumn('action', function ($clt){

                return '
                                    <a class="btn btn-info" onclick="show('.$clt->id.')"> <i class="fa fa-info"></i></a> ';
            })
            ->make(true) ;
    }

    public function index2()
    {
        $livraison=LivraisonV::with('boutique')->where ('boutique_id', '=',Auth::user()->boutique->id)->get();
        return datatables()->of($livraison)
            ->addColumn('action', function ($clt){

                return '
                                    <a class="btn btn-info" onclick="show('.$clt->id.')"> <i class="fa fa-info"></i></a> ';
            })
            ->make(true) ;
    }
    public function liste()
    {
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
            ->select('clients.nom as nom','clients.nom as prenom','clients.id as id')
            ->groupBy('id', 'clients.nom', 'clients.nom')
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
        $historique=new Historique();
        $historique->actions = "Liste";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return view('livraison',compact('mod','modele2','clients','credit','cre'));
    }
    public function liste2()
    {
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
            ->select('clients.nom as nom','clients.nom as prenom','clients.id as id')
            ->groupBy('id', 'clients.nom', 'clients.nom')
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
        $historique=new Historique();
        $historique->actions = "Liste";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return view('livraisonvente',compact('mod','modele2','clients','credit','cre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commande = DB::table('commandes')
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.commande_id', '=', 'commandes.id');
            })
            ->where ('commande_modeles.modele_fournisseur_id', '!=', null)
            ->where ('commande_modeles.etat', '=', false)
            ->where ('commandes.type_commande', '<>', 1)
            ->select('commandes.id as id','commandes.numero as numero')
            ->groupBy('commandes.id', 'commandes.numero')
            ->orderBy('commandes.created_at', 'DESC')
            ->limit(25)
            ->get();
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
            ->select('clients.nom as nom','clients.nom as prenom','clients.id as id')
            ->groupBy('id', 'clients.nom', 'clients.nom')
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
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
       return  view('newlivraison',compact('commande','mod','modele2','clients','credit','cre'));
    }
    public function create2()
    {
        $vente = DB::table('ventes')
            ->join('preventes', function ($join) {
                $join->on('preventes.vente_id', '=', 'ventes.id');
            })
            ->where ('ventes.type_vente', '=', 3)
            ->where ('preventes.etat', '=', 1)
            ->select('ventes.id as id','ventes.numero as numero')
            ->groupBy('ventes.id', 'ventes.numero')
            ->orderBy('ventes.created_at', 'DESC')
            ->limit(25)
            ->get();

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
       return  view('newlivraisonvente',compact('vente'));
    }


    /**

     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $id=DB::table('livraisons')->max('id');
            $ed=1+$id;
            $livraison = new Livraison();
            $livraison ->numero="LIV".now()->format('Y')."-".$ed;
            $livraison ->date_livraison= now();
            $livraison ->boutique_id= Auth::user()->boutique->id;
            $livraison->save();
    
            $alllivraison= explode( ',', $request->input('livTable') );
            for ($i =0 ;$i<count($alllivraison);$i+=2) {
                $commande_modele = DB::table('commande_modeles')->find($alllivraison[$i]);
                $quantite_livre= DB::table('livraison_commandes')
                        ->where('commande_modele_id',$alllivraison[$i])
                        ->sum('quantite_livre');
                                    
                $livraisoncommande = new livraisonCommande();
                $livraisoncommande ->livraison_id=$livraison ->id;
                $livraisoncommande  ->commande_modele_id=$alllivraison[$i];
                $livraisoncommande ->quantite_livre =$alllivraison[$i+1];
                $livraisoncommande->quantite_restante =$commande_modele->quantite - $quantite_livre - $alllivraison[$i+1];
                $livraisoncommande->save();
    
                $modele= Modele::findOrFail($commande_modele->modele);
                $modele->quantite=$modele->quantite+ $livraisoncommande ->quantite_livre;
                $modele->update();
    
                if ($livraisoncommande->quantite_restante==0){
                    DB::table('commande_modeles')
                        ->where('id',$alllivraison[$i])
                        ->update(['etat' => true]);
                }
            }
    
            $historique=new Historique();
            $historique->actions = "Creer";
            $historique->cible = "Livraisons";
            $historique->user_id =Auth::user()->id;
            $historique->save();

            DB::commit();
            return $livraison;
            
            
        } catch (\Execption $e) {
            DB::rollback();
            return $e;
        }

    }



    /**

     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function oldStore(Request $request)
    {

        $id=DB::table('livraisons')->max('id');
        $ed=1+$id;
        $livraison = new Livraison();
        $livraison ->numero="LIV".now()->format('Y')."-".$ed;
        $livraison ->date_livraison= now();
        $livraison ->boutique_id= Auth::user()->boutique->id;
        $livraison->save();
        $alllivraison= explode( ',', $request->input('livTable') );
        for ($i =0 ;$i<count($alllivraison);$i+=2) {
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
            ->where('commande_modeles.id','=',$alllivraison[$i])
            ->select('commande_modeles.quantite as quantite','commande_modeles.id as idC','modeles.id as id','modeles.quantite as quant','commandes.id as commande')
            ->get();

            $quantite= DB::table('livraison_commandes')
                ->where('commande_modele_id',$alllivraison[$i] )
                    ->sum('quantite_livre');               
        $livraisoncommande = new livraisonCommande();
        $livraisoncommande ->livraison_id=$livraison ->id;
        $livraisoncommande  ->commande_modele_id=$alllivraison[$i];
        $livraisoncommande ->quantite_livre =$alllivraison[$i+1];
        $livraisoncommande->quantite_restante =$commande[0]->quantite - $quantite-$alllivraison[$i+1];
        $livraisoncommande->save();
        $modele_id = DB::table('modeles')
            ->join('modele_fournisseurs', function ($join) {
                $join->on('modele_fournisseurs.modele_id', '=', 'modeles.id');
            })
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.modele_fournisseur_id', '=', 'modele_fournisseurs.id');
            })

            ->join('livraison_commandes', function ($join) {
                $join->on('livraison_commandes.commande_modele_id', '=', 'commande_modeles.id');
            })
            ->where('livraison_commandes.id','=',$livraisoncommande->id)
            ->select('modeles.id as id')
            ->get();
        $modele= Modele::findOrFail($modele_id[0]->id);
        $modele->quantite=$modele->quantite+ $livraisoncommande ->quantite_livre;
        $modele->update();

        $liv= DB::table('livraison_commandes')
            ->where('commande_modele_id',$commande[0]->idC )
            ->latest('created_at')
            ->get();

        if ($liv[0]->quantite_restante==0){
            DB::table('commande_modeles')
                ->where('id',$commande[0]->idC)
                ->update(['etat' => true]);
        }
        }
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return $commande;

    }

    /**

     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request)
    {
        try {
            DB::beginTransaction();

            $id=DB::table('livraison_v_s')->max('id');
            $ed=1+$id;
            $livraison = new LivraisonV();
            $livraison ->numero="LIV-VENT".now()->format('Y')."-".$ed;
            $livraison ->date_livraison= now();
            $livraison ->boutique_id= Auth::user()->boutique->id;
            $livraison->save();
    
            $alllivraison= explode( ',', $request->input('livTable') );
            for ($i =0 ;$i<count($alllivraison);$i+=2) {
                $commande_modele = DB::table('preventes')->find($alllivraison[$i]);
                $quantite_livre= DB::table('livraison_ventes')
                        ->where('prevente_id', $alllivraison[$i])
                        ->sum('quantite_livre');
                                    
                $livraisonvente = new Livraison_vente();
                $livraisonvente->livraison_v_id=$livraison ->id;
                $livraisonvente->prevente_id=$alllivraison[$i];
                $livraisonvente->quantite_livre =$alllivraison[$i+1];
                $livraisonvente->quantite_restante =$commande_modele->quantite - $quantite_livre - $alllivraison[$i+1];
                $livraisonvente->save();
    
                $modele= Modele::findOrFail($commande_modele->modele_fournisseur_id);
                $modele->quantite=$modele->quantite- $livraisonvente ->quantite_livre;
                $modele->update();
    
                if ($livraisonvente->quantite_restante==0){
                    DB::table('preventes')
                        ->where('id',$alllivraison[$i])
                        ->update(['etat' => false]);
                }
            }
    
            $historique=new Historique();
            $historique->actions = "Creer";
            $historique->cible = "Livraisons";
            $historique->user_id =Auth::user()->id;
            $historique->save();

            DB::commit();
            return $livraison;
            
            
        } catch (\Execption $e) {
            DB::rollback();
            return $e;
        }

    }


    public function oldStore2(Request $request)
    {

        $id=DB::table('livraison_v_s')->max('id');
        $ed=1+$id;
        $livraison = new LivraisonV();
        $livraison ->numero="LIV-VENT".now()->format('Y')."-".$ed;
        $livraison ->date_livraison= now();
        $livraison ->boutique_id= Auth::user()->boutique->id;
        $livraison->save();
        $alllivraison= explode( ',', $request->input('livTable') );
        for ($i =0 ;$i<count($alllivraison);$i+=2) {
        $commande = DB::table('ventes')
            ->join('preventes', function ($join) {
                $join->on('preventes.vente_id', '=', 'ventes.id');
            })
            ->join('modeles', function ($join) {
                $join->on('modeles.id', '=', 'preventes.modele_fournisseur_id');
            })
            ->join('produits', function ($join) {
                $join->on('produits.id', '=', 'modeles.produit_id');
            })
            ->where('preventes.id','=',$alllivraison[$i])
            ->select('preventes.quantite as quantite','preventes.id as idC','modeles.id as id','modeles.quantite as quant','ventes.id as commande')
            ->get();

            $quantite= DB::table('livraison_ventes')
                ->where('prevente_id',$alllivraison[$i] )
                ->sum('quantite_livre');
        $livraisoncommande = new Livraison_vente();
        $livraisoncommande ->livraison_v_id=$livraison ->id;
        $livraisoncommande  ->prevente_id=$alllivraison[$i];
        $livraisoncommande ->quantite_livre =$alllivraison[$i+1];
        $livraisoncommande->quantite_restante =$commande[0]->quantite - $quantite-$alllivraison[$i+1];
        $livraisoncommande->save();
        $modele= Modele::findOrFail($commande[0]->id);
        $modele->quantite=$modele->quantite -$livraisoncommande ->quantite_livre;
        $modele->update();

        $liv= DB::table('livraison_ventes')
            ->where('prevente_id',$commande[0]->idC )
            ->latest('created_at')
            ->get();

        if ($liv[0]->quantite_restante==0){
            DB::table('preventes')
                ->where('id',$commande[0]->idC)
                ->update(['etat' => 0]);
        }
        }
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return $commande;

    }

    
    public function verification($id)
    {
        try {
            $commande_modele = DB::table('commande_modeles')->find($id);

            $quantite= DB::table('livraison_commandes')
                ->where('commande_modele_id',$id )
                ->sum('quantite_livre');
            return $commande_modele->quantite - $quantite;

        } catch (\Exception $e){
            return $e;
        }
    }

    public function verification2($id)
    {
        try {
            $commande_modele = DB::table('preventes')->find($id);

            $quantite= DB::table('livraison_ventes')
                ->where('prevente_id',$id )
                ->sum('quantite_livre');
            return $commande_modele->quantite - $quantite;

        } catch (\Exception $e){
            return $e;
        }
    }

    public function oldVerification($id)
    {
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
            ->where('commande_modeles.id','=',$id)
            ->select('commande_modeles.quantite as quantite','commande_modeles.id as idC','modeles.id as id','modeles.quantite as quant','commandes.id as commande')
            ->get();
        $quantite= DB::table('livraison_commandes')
            ->where('commande_modele_id',$id )
            ->sum('quantite_livre');
        return $commande[0]->quantite - $quantite;
    }


    public function oldVerification2($id)
    {
        $commande = DB::table('ventes')
            ->join('preventes', function ($join) {
                $join->on('preventes.vente_id', '=', 'ventes.id');
            })
            ->join('modele_fournisseurs', function ($join) {
                $join->on('modele_fournisseurs.id', '=', 'preventes.modele_fournisseur_id');
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
            ->where('preventes.id','=',$id)
            ->select('preventes.quantite as quantite','preventes.id as idC','modeles.id as id','modeles.quantite as quant','ventes.id as commande')
            ->get();
        $quantite= DB::table('livraison_ventes')
            ->where('prevente_id',$id)
            ->sum('quantite_livre');
        return $commande[0]->quantite - $quantite;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
                */
    public function show($id)
    {
        $livraison =DB::table('livraisons')
            ->join('livraison_commandes', function ($join) {
                $join->on('livraisons.id', '=', 'livraison_commandes.livraison_id');
            })
            ->join('commande_modeles', function ($join) {
                $join->on('commande_modeles.id', '=', 'livraison_commandes.commande_modele_id');
            })
            ->join('commandes', function ($join) {
                $join->on('commandes.id', '=', 'commande_modeles.commande_id');
            })
            ->join('modeles', function ($join) {
                $join->on('modeles.id', '=', 'commande_modeles.modele');
            })
            ->join('fournisseurs', function ($join) {
                $join->on('fournisseurs.id', '=', 'commandes.fournisseur_id');
            })
            ->join('produits', function ($join) {
                $join->on('produits.id', '=', 'modeles.produit_id');
            })
            ->where('livraisons.id','=',$id)
            ->select('commandes.numero as numero',
                'commandes.date_commande as dateC',
                'livraisons.date_livraison as dateL',
                'livraisons.numero as num',
                'modeles.libelle as modele',
                'produits.nom as produit',
                'livraison_commandes.quantite_livre as quantiteL',
                'fournisseurs.nom as fournisseur',
                'commande_modeles.etat as etat',
                'commande_modeles.quantite as quantiteC',
                'livraison_commandes.quantite_restante as quantiteR'
                )
            ->get();
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
            ->select('clients.nom as nom','clients.nom as prenom','clients.id as id')
            ->groupBy('id', 'clients.nom', 'clients.nom')
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
        $historique=new Historique();
        $historique->actions = "Detail";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return view('detaillivraison',compact('livraison','mod','modele2','cre','credit','clients'));
    }
    public function show2($id)
    {
        // dd($id);
        $livraison =DB::table('livraison_v_s')
            ->join('livraison_ventes', function ($join) {
                $join->on('livraison_v_s.id', '=', 'livraison_ventes.livraison_v_id');
            })
            ->join('preventes', function ($join) {
                $join->on('preventes.id', '=', 'livraison_ventes.prevente_id');
            })
            ->join('modeles', function ($join) {
                $join->on('modeles.id', '=', 'preventes.modele_fournisseur_id');
            })
            ->join('produits', function ($join) {
                $join->on('produits.id', '=', 'modeles.produit_id');
            })
            ->join('ventes', function ($join) {
                $join->on('ventes.id', '=', 'preventes.vente_id');
            })
            ->join('clients', function ($join) {
                $join->on('clients.id', '=', 'ventes.client_id');
            })
            ->where('livraison_v_s.id','=',$id)
            ->select('ventes.numero as numero',
                'ventes.date_vente as dateC',
                'livraison_v_s.date_livraison as dateL',
                'livraison_v_s.numero as num',
                'modeles.libelle as modele',
                'produits.nom as produit',
                'livraison_ventes.quantite_livre as quantiteL',
                'clients.nom as client',
                'clients.nom as prenom',
                'preventes.etat as etat',
                'preventes.quantite as quantiteC',
                'livraison_ventes.quantite_restante as quantiteR'
                )
            ->get();

        // dd($livraison);

        $historique=new Historique();
        $historique->actions = "Detail";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return view('detaillivraison2',compact('livraison'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $liv= DB::table('livraison_commandes')
            ->where('commande_modele_id',1 )
            ->latest('created_at')
            ->get();

        if ($liv[0]->quantite_restante==0){
            DB::table('commande_modeles')
                ->where('id',1 )
            ->update(['etat' => true]);

        }
        $historique=new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return $liv[0]->quantite_restante;
    }
    public function edit2()
    {

        $liv= DB::table('livraison_ventes')
            ->where('prevente_id',1 )
            ->latest('created_at')
            ->get();

        if ($liv[0]->quantite_restante==0){
            DB::table('preventes')
                ->where('id',1 )
            ->update(['etat' => false]);

        }
        $historique=new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Livraisons";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return $liv[0]->quantite_restante;
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
