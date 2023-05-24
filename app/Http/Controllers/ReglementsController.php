<?php

namespace App\Http\Controllers;

use App\Banque;
use App\CompteBancaire;
use App\journal;
use App\Reglement;
use App\Client;
use App\Commande;
use App\Fournisseur;
use App\Historique;
use App\Recette;
use App\ReglementAchat;
use App\TypeRecette;
use App\vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReglementsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reglement=Reglement::with('boutique')->where ('boutique_id', '=',Auth::user()->boutique->id)
            ->join('clients', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            ->select('reglements.*', 'clients.nom')
            ->get();
        return datatables()->of($reglement)
            ->addColumn('action', function ($clt) {

                return '
                                    <a class="btn btn-success" onclick="editreglement(' . $clt->id . ')"> <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" onclick="deletereglement(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true);
    }

    public function liste()
    {
        $client=DB::table('clients')
            ->join('reglements', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            ->where ('clients.boutique_id', '=',Auth::user()->boutique->id )
            -> select ('clients.id','clients.nom')
            -> groupby ('clients.id', 'clients.nom')
            ->get();
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Reglements";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('regler',compact('client'));
    }

    public function reglementlist()
    {
        $clients = Reglement::join('clients', function ($join) {
            $join->on('reglements.client_id', '=', 'clients.id');
        })
        ->join('ventes', function ($join) {
            $join->on('reglements.vente_id', '=', 'ventes.id');
        })
        ->where('ventes.boutique_id', '=',Auth::user()->boutique->id)
        ->selectRaw('clients.id, ventes.id as venteId, ventes.numero, clients.nom, clients.contact, ventes.totaux, SUM(reglements.montant_donne) as donner')
        ->groupBy('clients.id', 'clients.nom', 'clients.contact', 'ventes.numero', 'ventes.id', 'ventes.totaux')
        ->havingRaw('(totaux - donner) > 0.0')
        ->get();

        $reglements=Reglement::join('clients', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            ->join('ventes', function ($join) {
                $join->on('reglements.vente_id', '=', 'ventes.id');
            })
            ->where('ventes.boutique_id', '=',Auth::user()->boutique->id)
            ->selectRaw('clients.id, ventes.id as venteId,reglements.created_at, ventes.numero, clients.nom, clients.contact, ventes.totaux, SUM(reglements.montant_donne) as donner')

            ->groupBy('clients.id', 'clients.nom','reglements.created_at', 'clients.contact', 'ventes.numero', 'ventes.id', 'ventes.totaux')
            ->orderBy('reglements.created_at', 'desc')
            ->get();

        // $ventes = vente::with('boutique')->where ('ventes.boutique_id', '=',Auth::user()->boutique->id)
        //     ->join('clients', function ($join) {
        //         $join->on('ventes.client_id', '=', 'clients.id');
        //     })->selectRaw('clients.id, clients.nom, SUM(ventes.totaux) as total')
        //     ->groupBy('clients.id', 'clients.nom')
        //     ->get();


        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Reglements";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('reglementlist',compact('clients', 'reglements'));
    }

    public function reglementachatlist()
    {
        $fournisseur=DB::table('fournisseurs')
            ->get();
        $banques = DB::table('banques')
        ->join('agence_banques','agence_banques.banque_id','=','banques.id')
        ->join('compte_bancaires','compte_bancaires.agence_id','=','agence_banques.id')
        ->select('compte_bancaires.id as id','compte_bancaires.numero as numero','agence_banques.nom as agence','banques.nom as banques')
        ->get();
       // dd($banques);
        $reglements=ReglementAchat::join('fournisseurs', function ($join) {
                $join->on('reglement_achats.fournisseur_id', '=', 'fournisseurs.id');
            })
            ->selectRaw('fournisseurs.id, fournisseurs.nom, SUM(reglement_achats.montant_donne) as donner')
            ->groupBy('fournisseurs.id', 'fournisseurs.nom')
            ->get();

        $commandes = Commande::with('boutique')->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->join('fournisseurs', function ($join) {
                $join->on('commandes.fournisseur_id', '=', 'fournisseurs.id');
            })->selectRaw('fournisseurs.id, fournisseurs.nom, SUM(commandes.totaux) as total')
            ->groupBy('fournisseurs.id', 'fournisseurs.nom')
            ->get();


        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Reglements Achat";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('reglementachatlist',
            compact('fournisseur',
                'reglements', 'commandes','banques'));
    }

    public function reglementlistshow($id)
    {
        // $clients=DB::table('clients')
        //     ->join('reglements', function ($join) {
        //         $join->on('reglements.client_id', '=', 'clients.id');
        //     })
        //     ->where ('clients.boutique_id', '=',Auth::user()->boutique->id )
        //     -> select ('clients.id','clients.nom')
        //     -> groupby ('clients.id', 'clients.nom')
        //     ->get();

        try {
            $vente = DB::table('ventes')->find($id);
            $client=Client::find($vente->client_id);

            $reglementClient=Reglement::where(['reglements.vente_id' => $id])
            ->join('clients', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            ->selectRaw('clients.id, clients.nom, SUM(reglements.montant_donne) as donner')
            ->groupBy('clients.id', 'clients.nom')
            ->first();

            $venteClient = vente::with('boutique')
            ->join('clients', function ($join) {
                $join->on('ventes.client_id', '=', 'clients.id');
            })
            ->selectRaw('ventes.numero, ventes.created_at as date, clients.id, clients.nom, ventes.totaux as total')
            ->where(['ventes.id' => $id])
            ->groupBy('clients.id', 'clients.nom', 'ventes.numero', 'ventes.created_at', 'ventes.totaux')
            ->first();


        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Reglements";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('reglementlistshow',compact('client', 'reglementClient', 'venteClient'));

        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function reglementachatlistshow($id)
    {
        $fournisseurs=DB::table('fournisseurs')
            ->join('reglement_achats', function ($join) {
                $join->on('reglement_achats.fournisseur_id', '=', 'fournisseurs.id');
            })
            ->where ('reglement_achats.boutique_id', '=',Auth::user()->boutique->id )
            -> select ('fournisseurs.id','fournisseurs.nom')
            -> groupby ('fournisseurs.id', 'fournisseurs.nom')
            ->get();


        $fournisseur=Fournisseur::find($id);

        $reglementfournisseur=ReglementAchat::where(['reglement_achats.fournisseur_id' => $id])
        ->join('fournisseurs', function ($join) {
                $join->on('reglement_achats.fournisseur_id', '=', 'fournisseurs.id');
            })
            ->selectRaw('fournisseurs.id, fournisseurs.nom, SUM(reglement_achats.montant_donne) as donner')
            ->groupBy('fournisseurs.id', 'fournisseurs.nom')
            ->first();

        $commandefournisseur = Commande::with('boutique')
        ->where(['commandes.fournisseur_id' => $id])
        ->where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->join('fournisseurs', function ($join) {
                $join->on('commandes.fournisseur_id', '=', 'fournisseurs.id');
            })->selectRaw('fournisseurs.id, fournisseurs.nom, SUM(commandes.totaux) as total')
            ->groupBy('fournisseurs.id', 'fournisseurs.nom')
            ->first();


        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Reglements Achat";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('reglementachatlistshow',compact('fournisseurs', 'fournisseur', 'reglementfournisseur', 'commandefournisseur'));
    }

    public function reglementsbyclient($id)
    {
        $reglements=Reglement::where(['reglements.client_id' => $id])
            ->join('clients', function ($join) {
                    $join->on('reglements.client_id', '=', 'clients.id');
            })
            ->select('reglements.*')
            ->get();
        return datatables()->of($reglements)
                ->addColumn('action', function ($clt) {

                    return '
                                        <a class="btn btn-success" onclick="editreglement(' . $clt->id . ')"> <i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" onclick="deletereglement(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a> ';
                })
            ->make(true);
    }

    public function reglementsbyfournisseur($id)
    {
        $reglements=ReglementAchat::where(['reglement_achats.fournisseur_id' => $id])
            ->join('fournisseurs', function ($join) {
                    $join->on('reglement_achats.fournisseur_id', '=', 'fournisseurs.id');
            })
            ->select('reglement_achats.*')
            ->get();
        return datatables()->of($reglements)
                ->addColumn('action', function ($clt) {
                    // <a class="btn btn-success" onclick="editreglement(' . $clt->id . ')"> <i class="fa fa-pencil"></i></a>
                    return '

                                        <a class="btn btn-danger" onclick="deletereglement(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a> ';
                })
            ->make(true);
    }

    public function ventesbyclient($id)
    {
        $ventes = vente::where ('ventes.boutique_id', '=',Auth::user()->boutique->id)
            ->where(['ventes.client_id' => $id])
            ->join('clients', function ($join) {
                $join->on('ventes.client_id', '=', 'clients.id');
            })
            ->join('reglements', function ($join) {
                $join->on('reglements.vente_id', '=', 'ventes.id');
            })->select('ventes.*')
            ->get();
        return datatables()->of($ventes)
            ->addColumn('action', function ($clt) {
                return '<a class="btn btn-info " onclick="show(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>';
            })
            ->make(true);
    }

    public function commandesbyfournisseur($id)
    {
        $ventes = Commande::where ('commandes.boutique_id', '=',Auth::user()->boutique->id)
            ->where(['commandes.fournisseur_id' => $id, 'commandes.credit' => true])
            ->join('fournisseurs', function ($join) {
                $join->on('commandes.fournisseur_id', '=', 'fournisseurs.id');
            })
            ->select('commandes.*')
            ->get();
        return datatables()->of($ventes)
            ->addColumn('action', function ($clt) {
                return '<a class="btn btn-info " onclick="show(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>';
            })
            ->make(true);
    }

    public function test($id)
    {
        $total=DB::table('clients')
            ->join('reglements', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            -> where ('reglements.client_id', '=',$id)
            -> select ('reglements.montant_restant','reglements.created_at')
            ->latest()
            ->first();
        $a= $total;
        dd($a);
        return $a;
    }
    public function total($id)
    {
        $total=DB::table('clients')
            ->join('reglements', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            ->join('ventes', function ($join) {
                $join->on('reglements.vente_id', '=', 'ventes.id');
            })
            -> where ('reglements.client_id', '=',$id)
            -> select ('ventes.id as venteId', 'reglements.montant_restant','reglements.created_at')
            ->latest()
            ->first();

        return response() ->json($total);
    }

    public function totalachat($id)
    {
        $total=DB::table('fournisseurs')
        ->join('reglement_achats', function ($join) {
            $join->on('reglement_achats.fournisseur_id', '=', 'fournisseurs.id');
        })
        -> where ('reglement_achats.fournisseur_id', '=',$id)
        -> sum('montant_donne');

        $totalachat=DB::table('commandes')
        -> where (['commandes.fournisseur_id' => $id, 'commandes.credit' => true ])
        -> sum('totaux');

        return response() ->json(['montant' => $total, 'total' => $totalachat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client=DB::table('clients')
            ->join('ventes', function ($join) {
                $join->on('ventes.client_id', '=', 'clients.id');
            })
            ->select('clients.nom as nom','clients.id as id')
            ->groupBy('id', 'clients.nom')
            ->get();
        $credit=array();
        for ($i =0 ;$i<count($client);$i++) {
            $total = DB::table('reglements')
                ->join('ventes', function ($join) {
                    $join->on('reglements.vente_id', '=', 'ventes.id');
                })
                ->join('clients', function ($join) {
                    $join->on('ventes.client_id', '=', 'clients.id');
                })
                ->where('ventes.client_id', '=', $client[$i]->id)
                ->SUM('reglements.montant_restant');
           $credit[$i] = $total;
        }
        return  $client;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=DB::table('ventes')->max('id');
        $client=DB::table('ventes')
            ->where('ventes.id', '=',$id)
            ->select('ventes.client_id as client')
            ->get();
        $total=DB::table('clients')
            ->join('reglements', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            -> where ('reglements.client_id', '=',$client[0]->client)
            -> select ('reglements.montant_restant','reglements.created_at')
            ->latest()
            ->first();
        $reglement=new Reglement();
        $reglement->montant_donne = $request->input('donne');
        $reglement->client_id = $client[0]->client;
        if ($request->input('reste')>0)
        {
            if ($total==null){
                $reglement->total =$request->input('total');
                $reglement->montant_restant =$request->input('restant');

            }else{
                $reglement->total =$request->input('total')+$total->montant_restant;
                $reglement->montant_restant =$request->input('total')+$total->montant_restant-$request->input('donne');
            }
            $reglement->vente_id =$id;
            $reglement->save();
            return $request ->input();
        }
        else{
            $reglement->montant_restant =0;
            $reglement->vente_id =$id;
            $reglement->save();
            return $request ->input();
        }


    }
    public function store2(Request $request)
    {
        $reglement=new Reglement();
        $reglement->montant_donne = $request->input('donne');
        $reglement->client_id = $request->input('client');
        $reglement->vente_id = $request->input('idvente');
        $reglement->total = $request->input('total');
        if ($request->input('reste')>0)
        {
            $reglement->montant_restant = $request->input('restant');
            $reglement->save();
            // Récupération de l'utilisateur à mettre à jour
            $client = client::find($reglement->client_id);
            // Mise à jour des informations de l'utilisateur
            $client->solde = $reglement->montant_restant;
            // Sauvegarde des modifications
            $client->save();
            return $request ->input();


        }
        else{
            $reglement->montant_restant =0;
            $reglement->save();
            return $request ->input();
        }
    }
    public function storeachat(Request $request)
    {
        $reglement=new ReglementAchat();
        $compte_id = $request->input('compte') ;
        $compte = CompteBancaire::find($compte_id);

        $reglement->montant_donne = $request->input('donne');
        $reglement->fournisseur_id = $request->input('fournisseur');
        $reglement->total = $request->input('total');
        $reglement->user_id = Auth::user()->id;
        $reglement->boutique_id = Auth::user()->boutique->id;
        if ($request->input('reste')>0)
        {
            $compte->solder = $compte->solder - $reglement->montant_donne ;
            $compte->save();
            $reglement->montant_restant = $request->input('restant');
            $reglement->save();
              // Récupération de l'utilisateur à mettre à jour
              $fournisseur = Fournisseur::find($reglement->fournisseur_id);

              // Mise à jour des informations de l'utilisateur
              $fournisseur->solde = $reglement->montant_restant;

              // Sauvegarde des modifications
              $fournisseur->save();

            return $request ->input();
        }
        else{
            $compte->solder = $compte->solder - $reglement->montant_donne ;
            $compte->save();
            $reglement->montant_restant =0;
            $reglement->save();
            return $request ->input();
        }
    }
    public function store3(Request $request, $id)
    {
        $vente=DB::table('ventes')->find($id);
        if($vente && $vente->type_vente == 4) {
            return $request ->input();
        }

        if($vente) {
        $total=DB::table('clients')
            ->join('reglements', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            -> where ('reglements.client_id', '=',$vente->client_id)
            -> select ('reglements.montant_restant','reglements.created_at')
            ->latest()
            ->first();
        $reglement=new Reglement();
        $reglement->montant_donne = $request->input('donne');
        $reglement->client_id = $vente->client_id;
        $reglement->vente_id = $vente->id;
        if ($request->input('reste')>0){
            if ($total==null){
                $reglement->total =$request->input('total');
                $reglement->montant_restant =$request->input('restant');

            }else{
                $reglement->total =$request->input('total')+$total->montant_restant;
                $reglement->montant_restant =$request->input('total')+$total->montant_restant-$request->input('donne');
            }
            $reglement->vente_id =$id;
            $reglement->save();
            return $request ->input();
        }
        else{
            $reglement->montant_restant =0;
            $reglement->vente_id =$id;
            $reglement->save();
            return $request ->input();
        }
    }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reglement=DB::table('reglements')
            ->join('clients', function ($join) {
                $join->on('reglements.client_id', '=', 'clients.id');
            })
            ->select('reglements.id as id',
                'reglements.montant_donne as donne',
                'reglements.total as total',
                'reglements.montant_restant as restant',
                'clients.nom as nom'
                )
            -> where ('reglements.id','=',$id)
            ->get();
        return $reglement;
    }

    public function showachat($id)
    {
        $reglement=DB::table('reglement_achats')
            ->join('fournisseurs', function ($join) {
                $join->on('reglement_achats.fournisseur_id', '=', 'fournisseurs.id');
            })
            ->select('reglement_achats.id as id',
                'reglement_achats.montant_donne as donne',
                'reglement_achats.total as total',
                'reglement_achats.montant_restant as restant',
                'fournisseurs.nom as nom'
                )
            -> where ('reglement_achats.id','=',$id)
            ->get();
        return $reglement;
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
    public function update(Request $request, $id)
    {
        $reglement= Reglement::findOrFail($request->input('idreglement'));
        $reglement->montant_donne = $request->input('donne');
        $reglement->montant_restant = $request->input('restant');
        $reglement->client_id = $request->input('client');
        $reglement->update();
        $historique = new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Reglements";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return [];
    }

    public function updateachat(Request $request, $id)
    {
        $reglement= ReglementAchat::findOrFail($request->input('idreglement'));
        $reglement->montant_donne = $request->input('donne');
        $reglement->montant_restant = $request->input('restant');
        $reglement->fournisseur_id = $request->input('fournisseur');
        $reglement->update();
        $historique = new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Reglements Achat";
        $historique->user_id = Auth::user()->id;
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
        $reglement= Reglement::findOrFail($id);
        $reglement->delete();
        $historique = new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Reglements";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return [];
    }

    public function destroyachat($id)
    {
        $reglement= ReglementAchat::findOrFail($id);
        $reglement->delete();
        $historique = new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Reglements Achats";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return [];
    }

    public function recetteIndex()
    {
        $fournisseurs = Fournisseur::all();
        $types = TypeRecette::all();
        return view('recettes.index', compact('fournisseurs', 'types'));
    }

    public function recetteListe()
    {
        $recette =Recette::where('boutique_id', '=',Auth::user()->boutique->id)
        ->leftjoin('fournisseurs', 'recettes.fournisseur_id', '=', 'fournisseurs.id')
        ->leftjoin('type_recettes', 'recettes.type_id', '=', 'type_recettes.id')
        ->select('recettes.*', 'fournisseurs.nom as fournisseur', 'fournisseurs.id as fournisseur_id', 'type_recettes.label as type', 'type_recettes.id as type_id')
        ->orderBy('created_at', 'DESC')
        ->get();
        return datatables()->of($recette)
            ->addColumn('action', function ($clt) {

                return ' <a class="btn btn-info " onclick="showclt(' . $clt->id . ')" ><i class="fa  fa-info"></i></a>
                                    <a class="btn btn-success" onclick="editclt(' . $clt->id . ')"> <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" onclick="deleteclt(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a> ';
            })
            ->make(true);
    }

    public function recetteShow($id)
    {
        $recette =Recette::where('boutique_id', '=',Auth::user()->boutique->id)
        ->where(['recettes.id' => $id])
        ->leftjoin('fournisseurs', 'recettes.fournisseur_id', '=', 'fournisseurs.id')
        ->leftjoin('type_recettes', 'recettes.type_id', '=', 'type_recettes.id')
        ->select('recettes.*', 'fournisseurs.nom as fournisseur', 'fournisseurs.id as fournisseur_id', 'type_recettes.label as type', 'type_recettes.id as type_id')
        ->first();
        return $recette;
    }

    public function recetteStore(Request $request)
    {
        $recette = new Recette();
        $recette->montant = $request->input('montant');
        $recette->observation = $request->input('observation');
        $recette->fournisseur_id = $request->input('fournisseur');
        $recette->type_id = $request->input('type');
        $recette->user_id = Auth::user()->id;
        $recette->boutique_id = Auth::user()->boutique->id;
        $recette->save();

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Recettes";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return [];
    }

    public function recetteUpdate(Request $request, $id)
    {
        $recette = Recette::findOrFail($id);
        $recette->montant = $request->input('montant');
        $recette->observation = $request->input('observation');
        $recette->fournisseur_id = $request->input('fournisseur');
        $recette->type_id = $request->input('type');
        $recette->user_id = Auth::user()->id;
        $recette->update();

        $historique = new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Recettes";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return [];
    }

    public function recetteDelete($id)
    {
        $recette = Recette::findOrFail($id);
        $recette->delete();
        $historique = new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Recettes";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return [];
    }
}

