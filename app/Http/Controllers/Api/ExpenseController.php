<?php

namespace App\Http\Controllers\Api;

use App\Depense;
use App\Historique;
use App\Http\Controllers\Controller;
use App\Sold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

        return response([
            'data' => $expenses,
            'status' => 200
        ]);


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
        $sold = Sold::find($request->sold_id);
        if($sold->montant <= $request->montant)
        {
            return response([
                'data' => 'unable to create resoruce',
                'status'=>404,
            ]);
        }
        $id=JournalDepense::latest()->first()->id;
        if($id){
            $ed = $id + 1;
        } else {
            $ed=1;
        }
        $expense = Depense::create([
            'name' => $request->name,
            'montant' => $request->montant,
            'date_dep' => Carbon::now(),
            'motif' => $request->motif,
            'user_id' => $request->user_id,
            'sold_id' => $request->sold_id,
            'boutique_id' => $request->boutique_id,
            'journal_id' => $id,
        ]);


        $sold->montant -= $request->montant;
        $sold->update();

        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Dépense";
        $historique->user_id = $_user_id;
        $historique->save();

        return response([
            'data' => $expense->toArray(),
            'status' => 201
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
