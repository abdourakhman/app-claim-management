<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function getClaims(){
        //Requête 1
        $reclamations = DB::table('users as u')
        ->join('clients as c', 'c.user_id', '=', 'u.id')
        ->join('reclamations as r', 'c.id', '=', 'r.client_id')
        ->select('r.designation', 'r.description', 'r.created_at', 'r.statut', 'c.id')
        ->where(function($query){
            $query->where('r.statut', '=', 'en cours')
                ->orWhere('r.statut', '=', 'déposée');
        })
        ->where('u.profil', '=', 'client')
        ->get();

        // Requête 2
        $clients = DB::table('users as u')
            ->join('clients as c', 'c.user_id', '=', 'u.id')
            ->select('u.prenom', 'u.nom', 'u.photo_url', 'c.id')
            ->where('u.profil', '=', 'client')
            ->get();
        return view('manager.claims', ['clients' => $clients, 'reclamations' => $reclamations]);
    } 

}
