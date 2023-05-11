<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Technicien;
use App\Models\Reclamation;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function dashboard(){

        return view('manager.dashboard');
    }

    public function getClaims(){
        //Requête 1
        $reclamations = DB::table('clients as c')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->join('reclamations as r', 'r.client_id', '=', 'c.id')
        ->select('r.id as claim_id', 'r.designation', 'r.description', 'r.created_at', 'r.statut', 'c.id as client_id')
        ->where('u.profil', '=', 'client')
        ->whereIn('r.statut', ['en cours', 'en attente'])
        ->get();

        // Requête 2
        $clients = DB::table('users as u')
            ->join('clients as c', 'c.user_id', '=', 'u.id')
            ->select('u.prenom', 'u.nom', 'u.photo_url', 'c.id')
            ->where('u.profil', '=', 'client')
            ->get();

        return view('manager.claims', ['clients' => $clients, 'reclamations' => $reclamations, 'title'=>"Manager|claims"]);
    } 

    public function getFormAffectClaim($id){
        $techniciens = Technicien::where('disponibilite',1)->get();
        $claim = Reclamation::findOrFail($id);
        return view('manager.formAffect',['claim'=>$claim,'techniciens'=>$techniciens,'title'=>"Manager|claims"]); 
    }

    public function affectClaim(Request $request){
        $reclamation = Reclamation::with('client')->where('id',$request->id)->first();
        $reclamation->gestionnaire_id = Auth::user()->gestionnaire->id;
        $reclamation->statut = 'en cours';

        $intervention = new Intervention;
        $intervention->libelle = $reclamation->designation." à ".$reclamation->client->user->adresse." chez ".$reclamation->client->user->prenom. " ".$reclamation->client->user->nom."\nTel: ".$reclamation->client->user->telephone;
        $intervention->statut = 'en attente';
        $intervention->reclamation_id = $reclamation->id;
        $reclamation->save();
        $intervention->save();

        $technicien = Technicien::find($request->technicien);
        $technicien->interventions()->attach($intervention->id,['date' => date('Y-m-d')]);
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
        return view('manager.affectedClaims', ['clients' => $clients, 'reclamations' => $reclamations,'title'=>"Manager|claims"]);

    }

    public function getPendingClaims(){
        $reclamations = DB::table('clients as c')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->join('reclamations as r', 'r.client_id', '=', 'c.id')
        ->select('r.id as claim_id', 'r.designation', 'r.description', 'r.created_at', 'r.statut', 'c.id as client_id')
        ->where('u.profil', '=', 'client')
        ->where('r.statut', 'en attente')
        ->get();

        // Requête 2
        $clients = DB::table('users as u')
            ->join('clients as c', 'c.user_id', '=', 'u.id')
            ->select('u.prenom', 'u.nom', 'u.photo_url', 'c.id')
            ->where('u.profil', '=', 'client')
            ->get();
        return view('manager.pendingClaims', ['clients' => $clients, 'reclamations' => $reclamations,'title'=>"Manager|claims"]);
    }

    public function getListTechniciens(){
        $techniciens = Technicien::with('user')->where('id', '!=', 0)->get();
        return view('manager.technicien.list',['techniciens'=> $techniciens, 'title'=>"Manager|technicien"]);
    }

    public function getTechniciensDisponible(){
        $techniciens = Technicien::with('user')->where('disponibilite', '=', 1)->get();
        return view('manager.technicien.disponible',['techniciens'=> $techniciens, 'title'=>"Manager|technicien"]);
    }

    public function getTechniciensIndisponible(){
        $techniciens = Technicien::with('user')->where('disponibilite', '!=', 1)->get();
        return view('manager.technicien.indisponible',['techniciens'=> $techniciens, 'title'=>"Manager|technicien"]);
    }

    public function searchClaim(Request $request){
        //Requête 1
        $reclamations = DB::table('clients as c')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->join('reclamations as r', 'r.client_id', '=', 'c.id')
        ->select('r.id as claim_id', 'r.designation', 'r.description', 'r.created_at', 'r.statut', 'c.id as client_id')
        ->where('u.profil', '=', 'client')
        ->whereIn('r.statut', ['en cours', 'en attente'])
        ->orwhere('designation','=', $request->term)
        ->orwhere('description','like', '%'.$request->term.'%')->get();

        // Requête 2
        $clients = DB::table('users as u')
            ->join('clients as c', 'c.user_id', '=', 'u.id')
            ->select('u.prenom', 'u.nom', 'u.photo_url', 'c.id')
            ->where('u.profil', '=', 'client')
            ->get();

        return view('manager.claims', ['clients' => $clients, 'reclamations' => $reclamations, 'title'=>"Manager|claims"]);
    } 
}
