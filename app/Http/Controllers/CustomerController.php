<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function createClaim(){
        return view('claim.form');
    }

    public function saveClaim(Request $request){
        $client = Client::where('user_id',(Auth::user()->id))->first();
        $success = false;
        $claim = new Reclamation;
        $claim->designation = $request->designation;
        $claim->description = $request->description;
        $claim->date = $request->date;
        $claim->client_id = $client->id;
        $claim->save();
        return redirect()->route('home')-with('success',$success=true);
    }
}
