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
        $client = Client::where('user_id',Auth::user()->id)->first();
        $notifications = Reclamation::where('statut', 'en cours')->where('client_id',$client->id)->count();        
        $client = DB::table('clients')
                ->where('user_id', '=', Auth::user()->id)
                ->first();

        $claims = DB::table('reclamations')
                ->select('id','designation','description', 'date', 'created_at','statut')
                ->where('client_id', '=', $client->id)
                ->paginate(4);

        $claimsDay = DB::table('reclamations')
                ->select('date')
                ->distinct()
                ->where('client_id', '=', $client->id)                
                ->get();
        $title = "reclamations";
        return view('claim.list',
                    [
                    'claims' => $claims,
                    'claimsDay' => $claimsDay,
                    'title' => $title,
                    'notifications'=>$notifications
                    ]);
    }

    public function getProcessedClaim(){
        $client = Client::where('user_id',Auth::user()->id)->first();
        $notifications = Reclamation::where('statut', 'en cours')->where('client_id',$client->id)->count();        
        $client = DB::table('clients')
                ->where('user_id', '=', Auth::user()->id)
                ->first();

        $claims = DB::table('reclamations')
                ->where('client_id', '=', $client->id)
                ->whereIn('statut', ['en cours', 'clôturée'])
                ->paginate(3);

        $claimsDay = DB::table('reclamations')
                ->select('date','client_id')
                ->distinct()
                ->where('client_id', '=', $client->id)                
                ->whereIn('statut', ['en cours', 'clôturée'])
                ->get();

        $title = "reclamations";

        return view('claim.listProcessed',
                    [
                    'claims' => $claims,
                    'claimsDay' => $claimsDay,
                    'title' => $title,
                    'notifications' =>$notifications
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
        $client = Client::where('user_id',Auth::user()->id)->first();
        $notifications = Reclamation::where('statut', 'en cours')->where('client_id',$client->id)->count();
        return view('claim.form')-with('notifications',$notifications);
    }

    public function saveClaim(Request $request){
        $claim = null;
        if($request->id){
                $claim = Reclamation::find($request->id);
                $claim->statut = "en attente";
        }else{
                $claim = new Reclamation;
        }
        $client = Client::where('user_id',(Auth::user()->id))->first();
        $claim->designation = $request->designation;
        $claim->description = $request->description;
        $claim->date = $request->date;
        $claim->client_id = $client->id;
        $claim->save();
        $success = true;
        return redirect()->route('home')->with('success',$success);
    }

    public function getAbortedClaim(){
        $client = Client::where('user_id',Auth::user()->id)->first();
        $notifications = Reclamation::where('statut', 'en cours')->where('client_id',$client->id)->count();        
        $client = DB::table('clients')
                ->where('user_id', '=', Auth::user()->id)
                ->first();

        $claims = DB::table('reclamations')
                ->where('client_id', '=', $client->id)
                ->where('statut', '=', "annulée")
                ->paginate(3);

        $claimsDay = DB::table('reclamations')
                ->select('date')
                ->distinct()
                ->where('client_id', '=', $client->id)                
                ->where('statut', '=', "annulée")
                ->get();
        
        $title = 'reclamations';
        
        return view('claim.listAborted',
                    [
                    'claims' => $claims,
                    'claimsDay' => $claimsDay,
                    'title' => $title,
                    'notifications' => $notifications
                    ]);
    }

    public function abortClaim($id){
        $claim = Reclamation::find($id);
        $claim->statut = "annulée";
        $claim->save();
        $success = true;
        return redirect()->route('home')->with('success', $success);
    }
    public function relaunchClaim($id){
        $client = Client::where('user_id',Auth::user()->id)->first();
        $notifications = Reclamation::where('statut', 'en cours')->where('client_id',$client->id)->count();
        $claim = Reclamation::find($id);
        return view('claim.relaunched',['title' => 'reclamations', 'claim' =>$claim , 'notifications'=>$notifications]);
    }

    public function searchClaim(Request $request){
        $client = Client::where('user_id',Auth::user()->id)->first();
        $notifications = Reclamation::where('statut', 'en cours')->where('client_id',$client->id)->count();
        $client = DB::table('clients')
        ->where('user_id', '=', Auth::user()->id)
        ->first();

        $claims = DB::table('reclamations')
                ->select('id','designation','description', 'date', 'created_at')
                ->where('client_id', '=', $client->id)                
                ->where('designation','like', '%'.$request->term.'%')
                ->orwhere('id','=', $request->term)
                ->get();

        $claimsDay = DB::table('reclamations')
                ->select('date')
                ->distinct()
                ->where('client_id', '=', $client->id)                
                ->where('designation','like', '%'.$request->term.'%')
                ->orwhere('id','=', $request->term)
                ->paginate(1);
        $title = "reclamations";
        return view('claim.search',
                [
                'claims' => $claims,
                'claimsDay' => $claimsDay,
                'title' => $title,
                'notifications' => $notifications
                ]); 
    }
}
