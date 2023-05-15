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
        $interventions = DB::table('interventions')
            ->select(DB::raw("DATE_FORMAT(created_at, '%m/%d') as moisJour"), DB::raw('COUNT(*) as nombreInterventions'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m/%d')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%m/%d')"))
            ->limit(10)
            ->get();

        $reclamationResolues = DB::table('reclamations')
            ->select(DB::raw('YEAR(created_at) as annee'), DB::raw('WEEK(created_at) as semaine'), DB::raw('COUNT(*) as nombreReclamationResolues'))
            ->where('statut', 'résolue')
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('WEEK(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('WEEK(created_at)'), 'asc')
            ->limit(10)
            ->get();

        $reclamationEchouees = DB::table('reclamations')
            ->select(DB::raw('YEAR(created_at) as annee'), DB::raw('WEEK(created_at) as semaine'), DB::raw('COUNT(*) as nombreReclamationEchouees'))
            ->where('statut', 'échouée')
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('WEEK(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('WEEK(created_at)'), 'asc')
            ->limit(10)
            ->get();
        $reclamationAnnulees = DB::table('reclamations')
            ->select(DB::raw('YEAR(created_at) as annee'), DB::raw('WEEK(created_at) as semaine'), DB::raw('COUNT(*) as nombreReclamationAnnulees'))
            ->where('statut', 'annulée')
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('WEEK(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('WEEK(created_at)'), 'asc')
            ->limit(10)
            ->get();
        $reclamations = DB::table('reclamations')
            ->select(DB::raw('YEAR(created_at) as annee'), DB::raw('WEEK(created_at) as semaine'), DB::raw('COUNT(*) as nombreReclamations'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('WEEK(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('WEEK(created_at)'), 'asc')
            ->limit(10)
            ->get();

        $gestionnaireId = Auth::user()->gestionnaire->id;
        $affectations = DB::table('reclamations')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as nombreAffectations'))
            ->where('gestionnaire_id', $gestionnaireId)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->limit(10)
            ->get();
            
        return view('manager.dashboard', [
            'title' => 'Dashboard',
            'interventions' => $interventions,
            'reclamations' => $reclamations,
            'reclamationResolues' => $reclamationResolues,
            'reclamationAnnulees' => $reclamationAnnulees,
            'reclamationEchouees' => $reclamationEchouees,
            'affectations' => $affectations,
        ]);
    }

    public function getClaims(){
        //Requête 1
        $reclamations = DB::table('clients as c')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->join('reclamations as r', 'r.client_id', '=', 'c.id')
        ->select('r.id as claim_id', 'r.designation', 'r.description', 'r.created_at', 'r.statut', 'c.id as client_id')
        ->where('u.profil', '=', 'client')
        ->whereIn('r.statut', ['en cours', 'en attente','résolue','échouée'])
        ->paginate(3);

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
        $technicien->reclamations()->attach($reclamation->id);
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
        ->paginate(3);

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
        ->paginate(3);

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
