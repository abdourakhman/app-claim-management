<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function getClaims(){
        $claims = DB::table('reclamations')
        ->select('reclamations.id', 'reclamations.designation', 'reclamations.description', 'reclamations.statut', 'reclamations.date', 'reclamations.client_id', 'reclamations.created_at', 'users.prenom')
        ->leftJoin('clients', 'reclamations.client_id', '=', 'clients.id')
        ->leftJoin('users', 'clients.user_id', '=', 'users.id')
        ->where('reclamations.statut', '=', 'déposée')
        ->orWhere('reclamations.statut', '=', 'en cours')
        ->get();
        $claimsDay = DB::table('reclamations')
                  ->select('date')
                  ->distinct()
                  ->where('statut', '=', 'déposée')  
                  ->orWhere('statut', '=', 'en cours')
                  ->get();
        return view('manager.claims',['claims' => $claims ,'claimsDay' => $claimsDay]);
        //JE VEUX RECUPERER LES RECLAMATIONS PAR CLIENT EN UTILISANT LES RELATIONS
    }
    
}
