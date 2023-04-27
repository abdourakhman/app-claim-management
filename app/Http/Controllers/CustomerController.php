<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{   


    public function getDepositClaim(){
        $client = DB::table('clients')
                ->where('user_id', '=', Auth::user()->id)
                ->first();

        $claims = DB::table('reclamations')
                ->select('id','designation','description', 'date', 'created_at')
                ->where('client_id', '=', $client->id)
                ->where('statut', '=', 'en attente')
                ->get();

        $claimsDay = DB::table('reclamations')
                ->select('date')
                ->distinct()
                ->where('client_id', '=', $client->id)                
                ->where('statut', '=', 'en attente')
                ->get();

        return view('claim.list',
                    [
                    'claims' => $claims,
                    'claimsDay' =>$claimsDay
                    ]);
    }

    public function getProcessedClaim(){
        $client = DB::table('clients')
                ->where('user_id', '=', Auth::user()->id)
                ->first();

        $claims = DB::table('reclamations')
                ->where('client_id', '=', $client->id)
                ->where('statut', '=', 'en cours')
                ->orWhere('statut', '=', 'clôturée')
                ->get();

        $claimsDay = DB::table('reclamations')
                ->select('date')
                ->distinct()
                ->where('client_id', '=', $client->id)                
                ->where('statut', '=', 'en cours')
                ->orWhere('statut', '=', 'clôturée')
                ->get();

        return view('claim.listProcessed',
                    [
                    'claims' => $claims,
                    'claimsDay' =>$claimsDay
                    ]);
    }

    public function getResolvedInterventions($id){
        $reclamation = Reclamation::with('interventions')->where('id', $id)->first();
        foreach($reclamation->interventions as $intervention){
                if($intervention->reclamation_id == $id){
                        foreach($intervention->techniciens as $technicien){
                                $technicien->disponibilite = 1;
                                $technicien->save();
                        }
                        $intervention->statut = "résolue";
                        $intervention->save();
                }
        }
        $reclamation->statut = "résolue";
        $reclamation->save();
        return redirect()->route('customer.claim.processed');
    }
    
    public function getFailedInterventions($id){
        $reclamation = Reclamation::with('interventions')->where('id', $id)->first();
        foreach($reclamation->interventions as $intervention){
                if($intervention->reclamation_id == $id){
                        foreach($intervention->techniciens as $technicien){
                                $technicien->disponibilite = 1;
                                $technicien->save();
                        }
                        $intervention->statut = "échouée";
                        $intervention->save();
                }
        }
        $reclamation->statut = "échouée";
        $reclamation->save();
        return redirect()->route('customer.claim.processed');
    }

    public function createClaim(){
        return view('claim.form');
    }

    public function saveClaim(Request $request){
        $client = Client::where('user_id',(Auth::user()->id))->first();
        $success = false;
        $claim = new Reclamation;
        $claim->designation = $request->designation;
        $claim->description = $request->description;
        $claim->date = $request->date;
        $claim->client_id = $client->id;
        $claim->save();
        $success = true;
        return redirect()->route('home')->with('success',$success);
    }

    public function getAbortedClaim(){
        $client = DB::table('clients')
                ->where('user_id', '=', Auth::user()->id)
                ->first();

        $claims = DB::table('reclamations')
                ->where('client_id', '=', $client->id)
                ->where('statut', '=', "annulée")
                ->get();

        $claimsDay = DB::table('reclamations')
                ->select('date')
                ->distinct()
                ->where('client_id', '=', $client->id)                
                ->where('statut', '=', "annulée")
                ->get();

        return view('claim.listAborted',
                    [
                    'claims' => $claims,
                    'claimsDay' =>$claimsDay
                    ]);
    }

    public function abortClaim($id){
        $claim = Reclamation::find($id);
        $claim->statut = "annulée";
        $claim->save();
        $success = true;
        return redirect()->route('home')->with('success', $success);
    }


}
