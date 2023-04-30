<?php

namespace App\Http\Controllers;

use App\Models\Technicien;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicienController extends Controller
{
    public function getInterventions(){
        $technicien = Technicien::with('interventions')->where('user_id',Auth::user()->id)->first();
        return view('technicien.interventions',['technicien'=> $technicien, 'title'=>"technicien"]);
    }

    public function solveClaim($id){
        $technicien  = Technicien::where('user_id', Auth::user()->id)->first();
        $technicien->disponibilite = 0;
        $technicien->save();
        $intervention = Intervention::with('reclamation')->where('id', $id)->first();
        $intervention->statut = "en cours";
        $intervention->reclamation->statut="clôturée";
        $intervention->reclamation->save();
        $intervention->save();
        $success = true;
        return redirect()->route('home')->with('success',$success);
    }

    public function getSolvedInterventions(){
        $technicien = Technicien::with('interventions')->where('user_id',Auth::user()->id)->first();
        return view('technicien.solved',['technicien'=> $technicien, 'title'=>"technicien"]);
    }

    public function getPendingInterventions(){
        $technicien = Technicien::with('interventions')->where('user_id',Auth::user()->id)->first();
        return view('technicien.notSolved',['technicien'=> $technicien, 'title'=>"technicien"]);
    }
    
}

