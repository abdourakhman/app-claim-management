<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Technicien;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function getClaims(){
        //Requête 1
        $reclamations = DB::table('clients as c')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->join('reclamations as r', 'r.client_id', '=', 'c.id')
        ->select('r.id as claim_id', 'r.designation', 'r.description', 'r.created_at', 'r.statut', 'c.id as client_id')
        ->where('u.profil', '=', 'client')
        ->whereIn('r.statut', ['en cours', 'déposée'])
        ->get();

        // Requête 2
        $clients = DB::table('users as u')
            ->join('clients as c', 'c.user_id', '=', 'u.id')
            ->select('u.prenom', 'u.nom', 'u.photo_url', 'c.id')
            ->where('u.profil', '=', 'client')
            ->get();
        return view('manager.claims', ['clients' => $clients, 'reclamations' => $reclamations]);
    } 

    public function getFormAffectClaim($id){
        $techniciens = Technicien::where('disponibilite',1)->get();
        $claim = Reclamation::findOrFail($id);
        return view('manager.formAffect',['claim'=>$claim,'techniciens'=>$techniciens]); 
    }

    public function affectClaim(Request $request){
        $reclamation = Reclamation::find($request->id);
        $reclamation->statut = 'en cours';
        $reclamation->save();
        $success =true;
        return redirect()->route('home')->with('success',$success);
    }

    public function getAffectedClaims(){
        $reclamations = DB::table('clients as c')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->join('reclamations as r', 'r.client_id', '=', 'c.id')
        ->select('r.id as claim_id', 'r.designation', 'r.description', 'r.created_at', 'r.statut', 'c.id as client_id')
        ->where('u.profil', '=', 'client')
        ->where('r.statut', 'en cours')
        ->get();

        // Requête 2
        $clients = DB::table('users as u')
            ->join('clients as c', 'c.user_id', '=', 'u.id')
            ->select('u.prenom', 'u.nom', 'u.photo_url', 'c.id')
            ->where('u.profil', '=', 'client')
            ->get();
        return view('manager.affectedClaims', ['clients' => $clients, 'reclamations' => $reclamations]);

    }

    public function getPendingClaims(){
        $reclamations = DB::table('clients as c')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->join('reclamations as r', 'r.client_id', '=', 'c.id')
        ->select('r.id as claim_id', 'r.designation', 'r.description', 'r.created_at', 'r.statut', 'c.id as client_id')
        ->where('u.profil', '=', 'client')
        ->where('r.statut', 'déposée')
        ->get();

        // Requête 2
        $clients = DB::table('users as u')
            ->join('clients as c', 'c.user_id', '=', 'u.id')
            ->select('u.prenom', 'u.nom', 'u.photo_url', 'c.id')
            ->where('u.profil', '=', 'client')
            ->get();
        return view('manager.pendingClaims', ['clients' => $clients, 'reclamations' => $reclamations]);
    }

}
