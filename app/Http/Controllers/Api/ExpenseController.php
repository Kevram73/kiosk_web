<?php

namespace App\Http\Controllers\Api;

use App\Depense;
use App\Historique;
use App\Http\Controllers\Controller;
use App\Sold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Depense::all();

        return response()->json($expenses->toArray());


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $_name = $data['name'];
        $_montant =$data['montant'];
        $_date_rep=$data['date_dep'];
        $_motif = $data['motif'];
        $_user_id = $data['user_id'];
        $solde_id = $data['sold_id'] ;
        $_boutique_id = $data['boutique_id'] ;

        DB::beginTransaction();
        $id=DB::table('journal_depenses')->max('id');
        $charge = new Depense();
        //$charge->name = $request->name;
        $charge->name = $_name;
        //$charge->montant = $request->montant;
        $charge->montant = $_montant;
       // $charge->date_dep = date('Y-m-d', strtotime($request->date));
        $charge->date_dep = date('Y-m-d', strtotime($_date_rep));
        //$charge->motif = $request->motif;
        $charge->motif = $_motif;

        $charge->journal_id = $id;
        $charge->user_id = $_user_id;
        $charge->sold_id = $solde_id;
        $charge->boutique_id =$_boutique_id;

        $charge->save();

        $sold = Sold::find($solde_id);
        if($sold->montant <= $request->montant)
        {
            DB::rollback();
            return response([
                'data' => 'unable to create resoruce',
                'status'=>404,

            ]);
        }


        $sold->montant -= $_montant;
        $sold->update();

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Dépense";
        $historique->user_id = $_user_id;
        $historique->save();

        DB::commit();

        return response([
            'charge'=>$charge->toArray(),
            'status'=>201
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
