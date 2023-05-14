<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\Technicien;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TechnicienController extends Controller
{
    public function dashboard(){
        $technicien = Technicien::with('interventions')->where('user_id',Auth::user()->id)->first();
        $suggestions = Fiche::where('technicien_id', $technicien->id)->where('suggestion','!=',"")->count();
        $interventionResolue = 0;
        $interventionEchouee = 0;
        $interventionEnAttente = 0;
        foreach($technicien->interventions as $intervention){
            if($intervention->statut == 'clôturée'){
                $interventionResolue++;
            }
            if($intervention->statut == 'échouée'){
                $interventionEchouee++;
            }
            if($intervention->statut == 'en attente'){
                $interventionEnAttente++;
            }        
        }
        $interventions = DB::table('interventions')
            ->select(DB::raw("DATE_FORMAT(created_at, '%m/%d') as moisJour"), DB::raw('COUNT(*) as nombreInterventions'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m/%d')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%m/%d')"))
            ->limit(10)
            ->get();
        return view('technicien.dashboard',[
            'title' => 'Dashboard',
            'interventions' => $interventions,
            'suggestions' => $suggestions,
            'interventionResolue' => $interventionResolue,
            'interventionEchouee' => $interventionEchouee,
            'interventionEnAttente' => $interventionEnAttente,
        ]);
    }
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

