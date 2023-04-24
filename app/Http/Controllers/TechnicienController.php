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
        return view('technicien.interventions')->with('technicien',$technicien);
    }

    public function solveClaim($id){
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
        return view('technicien.solved')->with('technicien',$technicien);
    }

    public function getPendingInterventions(){
        $technicien = Technicien::with('interventions')->where('user_id',Auth::user()->id)->first();
        return view('technicien.notSolved')->with('technicien',$technicien);
    }
}

