<?php

namespace App\Http\Controllers;

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
        return view('home');
    }
}
