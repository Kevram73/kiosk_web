<?php

namespace App\Http\Controllers\Api;

use App\Depense;
use App\Historique;
use App\Http\Controllers\Controller;
use App\Sold;
use App\JournalDepense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Api\BaseController as BaseController;

class ExpenseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Depense::orderBy('created_at', 'desc')->get()->take(10);

        return response([
            'data' => $expenses,
            'status' => 200
        ]);
    }

    public function filter(Request $request){
        $expenses = Depense::whereBetween('created_at', [$request->beginDate, $request->endDate])->get();

        return $this->sendResponse($expenses, "Depenses retrieved successfully.");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function available_depense(Request $request){
        $journal = JournalDepense::where('user_id', $request->user_id)->where('date_fermeture', null)->get();
        if(count($journal) == 0){
            $elt = JournalDepense::create(
                [
                    'date_creation' => Carbon::now(),
                    'mois' => Carbon::now()->month,
                    'annee' => Carbon::now()->year,
                    'user_id' => $request->user_id,
                    'boutique_id' => $request->boutique_id,
                ]
            );
        } else {
            $elt = $journal->first();
        }

        return response([
            'data' => $elt,
            'status' => 200,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
            'boutique_id' => $request->boutique_id,
            'journal_id' => $id,
        ]);



        $historique = new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Dépense";
        $historique->user_id = $request->user_id;
        $historique->save();

        return response([
            'data' => $expense,
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
