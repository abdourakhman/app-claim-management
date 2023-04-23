<?php

namespace App\Http\Controllers;

use App\Models\Technicien;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicienController extends Controller
{
    public function getInterventions(){
        $technicien = Technicien::where('user_id',Auth::user()->id)->first();
        return view('technicien.interventions')->with('technicien',$technicien);
    }
}
