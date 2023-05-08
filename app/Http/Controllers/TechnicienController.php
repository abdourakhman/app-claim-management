<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
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
    
    public function fillForm($id){
        $intervention = Intervention::with('reclamation')->where('id',$id)->first();
        return view('technicien.fillForm',['intervention' => $intervention, 'title'=>"technicien"]);
    }

    public function saveForm(Request $request){
        $technicien = Technicien::where('user_id',$request->user_id)->first();
        $intervention = Intervention::find($request->intervention_id);
        $intervention->statut = "clôturée";
        $intervention->save();
        Fiche::create([
            'titre' => $request->designation,
            'detail' => $request->detail,
            'suggestion' => $request->suggestion,
            'technicien_id' => $technicien->id
        ]);
        $success = true;
        return redirect()->route('home')->with('success',$success);
    }
}

