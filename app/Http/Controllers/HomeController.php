<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->profil == 'admin')
            return redirect()->route('admin.dashboard');
        if(Auth::user()->profil == 'gestionnaire')
            return redirect()->route('manager.dashboard');
        if(Auth::user()->profil == 'technicien')
            return redirect()->route('technicien.dashboard');
        if(Auth::user()->profil == 'client'){
            $client = Client::where('user_id',Auth::user()->id)->first();
            $notifications = Reclamation::where('statut', 'en cours')->where('client_id',$client->id)->count();        
            return view('home')->with('notifications',$notifications);
        }
    }
}
