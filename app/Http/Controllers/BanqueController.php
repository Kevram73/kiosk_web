<?php

namespace App\Http\Controllers;

use App\AgenceBanque;
use App\Banque;
use App\CompteBancaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BanqueController extends Controller
{
    // Create banque
    public function create_banque(Request $request){


    $new_banque = new Banque();
    $new_banque->nom = $request->input('bName');
    $new_banque->description = $request->input('bDesc');
    $new_banque->save();
    error_log($new_banque);
    return $request->input();
    }
    // update banques
    public function update_banque(){

    }

    // desactivate banques
    public function  desactivate_banque(){

    }

    // liste banques.
    public function list_banques(){
    $banks = Banque::all() ;
    error_log($banks);
    return view('banque.list_bank',
        compact('banks')) ;
    }
    public function listagences(){
        $agences = AgenceBanque::all();
     
        error_log($agences);
        return view('banque.list_agences',
            compact('agences')) ;
        }
        public function list_comptes(){
            $comptes_bancaires = CompteBancaire::all();
            
            error_log($comptes_bancaires);
            
            return view('banque.list_comptes',
                compact('comptes_bancaires')) ;
            }


   // public function create_agence-banque
    public function create_agence(){
     // create banques.
    //$data =
    }

    // update agence
    public function update_agence(){}

    // list agence for a banques
    public function  list_agence_of_bank(Request $request,$bank_id){
    $data = Banque::where('id',$bank_id)->agences() ;
    return $data ;
    }

    // return the list of account of a given bank.
    public function get_account_for_bank(Request  $request){
        $boutique_id = $request->input('boutique');
        $bank_id = $request->input('banque');

        //banques
        //compte_bancaires
        //agence
        $result = DB::table('banques')
            ->join('agence_banques',function ($join){
                $join->on('banques.id','=','agence_banques.banque_id');
            })
            ->join('compte_bancaires',function ($join){
                $join->on('compte_bancaires.agence_id',
                    '=','agence_banques.id');
            })
            ->where('compte_bancaires.boutique_id','=',$boutique_id)
            ->where('banques.id','=',$bank_id)
            ->get();
        error_log($request);

        return response()->json($result);

    }

    // get sold
    public function get_solde(Request $request){
        $account_id = $request->input('account_id') ;
        $result = DB::table('compte_bancaires')
            ->where('id','=',$account_id)
            ->where('type','=','withdrawal')
            ->get();
         error_log($result);
        return response()->json($result) ;
    }



}
