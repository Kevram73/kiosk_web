<?php

namespace App\Http\Controllers\Api;

use App\Journal;
use App\Historique;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class JournalController extends BaseController
{
    public function closeJournal(Request $request){
        $journal = Journal::find($request->journal_id);
        $journal->date_fermeture = now();
        $journal->save();

        return response()->json([
            'status' => 'success',
            'journal' => $journal,
        ], 201);
    }

    public function openJournal(Request $request){
        $journal= new Journal();
        $journal->date_creation = now();
        $journal->user_id = $request->user_id;
        $journal->mois = now()->format('m');
        $journal->annee = now()->format('Y');
        $journal->boutique_id = $request->boutique_id;
        $journal->save();

        $historique=new Historique();
        $historique->actions = "Creer";
        $historique->cible = "Journal";
        $historique->user_id =$request->user_id;
        $historique->save();

        return response()->json([
            'status' => 'success',
            'journal' => $journal,
        ], 201);
    }

    public function verifyJournal(Request $request){
        $journal = Journal::where('boutique_id', $request->boutique_id)->where('date_fermeture', null)->first();
        if($journal){
            return response()->json([
                'status' => 'success',
                'journal' => $journal,
            ], 201);
        }else{
            return response()->json([
                'status' => 'error',
                'journal' => $journal,
            ], 201);
        }
    }
}
