<?php

namespace App\Http\Controllers;

use App\Boutique;
use App\Sold;
use App\SoldDepot;
use App\Depense;
use App\DepenseFile;
use App\JournalDepense;
use App\Historique;
use App\File;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepenseController extends Controller
{

    public function liste()
    {
        $sold = Sold::findorfail(1);
        $historique = new Historique();
        $historique->actions = "liste";
        $historique->cible = "Depense";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('depenses/index', compact('sold'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charge = Depense::with('boutique')->where('boutique_id', '=',Auth::user()->boutique->id )->orderBy('depenses.created_at', 'DESC')->get();
        return datatables()->of($charge)
            ->addColumn('action', function ($clt) {

                return
                        '<a class="btn btn-info" href="/depense-files-' . $clt->id . '"> <i class="fa fa-file"></i></a>
                        <a class="btn btn-success" onclick="editcharge(' . $clt->id . ')"> <i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger" onclick="deletecharge(' . $clt->id . ')"><i class="fa fa-trash-o"></i></a>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function create_depot()
    {
        $sold = Sold::findorfail(1);
        $historique = new Historique();
        $historique->actions = "Créer";
        $historique->cible = "Dépot";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('depenses/add_depot', compact('sold'));
    }

    public function create_depense_file($id)
    {
        $sold = Sold::findorfail(1);
        $depense = Depense::findorfail($id);
        $files = DepenseFile::where(['depense_id' => $depense->id])->get();
        $historique = new Historique();
        $historique->actions = "Créer";
        $historique->cible = "Dépense file";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        return view('depenses/add_depense_file', compact('sold', 'depense', 'files'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $id=DB::table('journal_depenses')->max('id');
        $charge = new Depense();
        $charge->name = $request->name;
        $charge->montant = $request->montant;
        $charge->date_dep = date('Y-m-d', strtotime($request->date));
        $charge->motif = $request->motif;

        $charge->journal_id = $id;
        $charge->user_id = Auth::user()->id;
        $charge->sold_id = $request->sold_id;
        $charge->boutique_id =Auth::user()->boutique->id;

        $charge->save();

        $sold = Sold::find($request->sold_id);
        if($sold->montant <= $request->montant)
        {
            DB::rollback();
            return null;
        }

        
        $sold->montant -= $request->montant;
        $sold->update();

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Dépense";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        DB::commit();

        return $sold;
    }

    public function store_depot(Request $request)
    {
        DB::beginTransaction();
        $id=DB::table('journal_depenses')->max('id');
        $charge = new SoldDepot();
        $charge->montant = $request->montant;
        $charge->date_dep = date('Y-m-d', strtotime($request->date));
        $charge->motif = $request->motif;

        $name = File::newFile($request->file, "justify");
        if($request->file && $name){
            $charge->justifier = true;
            $charge->file_name = $request->file->getClientOriginalName();
            $charge->file_url = $name;
        }

        $charge->journal_id =$id;
        $charge->user_id = Auth::user()->id;
        $charge->sold_id = $request->sold_id;
        $charge->boutique_id =Auth::user()->boutique->id;

        $charge->save();

        $sold = Sold::find($request->sold_id);
        $sold->montant += $request->montant;
        $sold->update();

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Sold Depôt";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        DB::commit();

        return redirect("/depenses")->with('success', 'Dépôt effectuer avec success');   
    }

    public function store_depense(Request $request)
    {
        DB::beginTransaction();
        
        $depense = Depense::findorfail($request->depense_id);

        $name = File::newFile($request->file, "justify");
        if($name){
            $file = new DepenseFile();
            $file->name = $request->file->getClientOriginalName();
            $file->url = $name;
            $file->depense_id = $depense->id;

            $depense->justifier = true;
            $file->save();
        }

        $depense->update();

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Depense File";
        $historique->user_id = Auth::user()->id;
        $historique->save();

        DB::commit();

        return redirect()->back()->with('success', 'Fichier Enregistrer');   
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historique = new Historique();
        $historique->actions = "Detail";
        $historique->cible = "Dépense";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        $charge = Depense::findOrFail($id);
        return $charge;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $sold = Sold::find($request->sold_id);
        $charge= Depense::findOrFail($request->input('idcharge'));
        $sold->montant += $charge->montant;
        $sold->montant -= $request->montant;

        $charge->name = $request->name;
        $charge->montant = $request->montant;
        $charge->date_dep = date('Y-m-d', strtotime($request->date));
        $charge->motif = $request->motif;

        $sold->update();
        $charge->update();

        $historique=new Historique();
        $historique->actions = "Modifier";
        $historique->cible = "Dépense";
        $historique->user_id =Auth::user()->id;
        $historique->save();

        return $sold;
    }

    public function journal()
    {

        $id=DB::table('journal_depenses')->max('id');
        if($id != null)
        {
            $journ= JournalDepense::findOrFail($id);
            $journ->date_fermeture =now();
            $journ->update();
        }
        $journal= new JournalDepense();
        $journal->date_creation =now();
        $journal->user_id = Auth::user()->id;
        $journal->mois = now()->format('m');
        $journal->annee = now()->format('Y');
        $journal->boutique_id =Auth::user()->boutique->id;
        $journal->save();
        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "journal_depenses";
        $historique->user_id =Auth::user()->id;
        $historique->save();
        return [];
    }

    public function fermer()
    {
        $id=DB::table('journal_depenses')->max('id');
        $journ= JournalDepense::findOrFail($id);
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
        $id=DB::table('journal_depenses')->max('id');
        $journal = DB::table('journal_depenses')
            ->where('journal_depenses.id', '=', $id)
            ->select('journal_depenses.date_fermeture as fermeture','journal_depenses.date_creation as creation')
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $sold_id)
    {
        $charge = Depense::findOrFail($id);

        $sold = Sold::find($sold_id);
        $sold->montant -= $charge->montant;
        $sold->update();

        $charge->delete();

        $historique = new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Dépense";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        
        return $sold;
    }

    public function destroy_file($id)
    {
        $charge = DepenseFile::findOrFail($id);
        $charge->delete();

        $historique = new Historique();
        $historique->actions = "Supprimer";
        $historique->cible = "Dépense Fichier";
        $historique->user_id = Auth::user()->id;
        $historique->save();
        
        return redirect()->back();
    }
}
