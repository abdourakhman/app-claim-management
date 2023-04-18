<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createUser(){
        return view('user.form');
    }

    public function deleteUser(){
        $users = User::all();
        return view('user.delete')->with('users', $users);
    }

    public function listUser(){
        $users = User::all();
        return view('user.liste')->with('users', $users);
    }

    public function editUser(){
        $users = User::all();
        return view('user.edit')->with('users', $users);
    }
}
