<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Technicien;
use App\Models\Gestionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function createUser(){
        return view('user.form');
    }

    public function saveUser(Request $request){
        $photo_url = "img/images/profil.png";
        // Créer une instance Intervention\Image\Image à partir des données de la photo
       if($request->photo){
           $image = Image::make($request->photo);
   
           // Redimensionner l'image pour qu'elle ait une taille maximale de 50x50 pixels
           $image->fit(50, 50);
   
           // Encoder l'image dans le format approprié en fonction de l'extension du fichier
           if ($request->photo->extension() == 'png') {
               $imageData = $image->encode('png', 80);
           } elseif ($request->photo->extension() == 'gif') {
               $imageData = $image->encode('gif');
           } else {
               $imageData = $image->encode('jpg', 80);
           }
   
           // Générer un nom de fichier unique pour la nouvelle image
           $filename = uniqid('avatar_', true) . '.' . $request->photo->extension();
   
           // Stocker l'image dans le système de fichiers public de Laravel
           Storage::disk('public')->put('avatars/' . $filename, $imageData);
   
           // Enregistrer l'URL de l'image dans la base de données
           $photo_url = 'avatars/' . $filename;
       }
       
        $user = new User;
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->sexe = $request->sexe;
        $user->photo_url = $photo_url;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;
        $user->profil = $request->profil;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->date_naissance = $request->naissance; 
        $user->save();
        if($user->profil == 'client'){$user->client()->save(new Client(['CIN' =>'A9VBJFS1'.$user->id]));}
        if($user->profil == 'gestionnaire'){$user->gestionnaire()->save(new Gestionnaire);}
        if($user->profil == 'technicien'){$user->technicien()->save(new Technicien);}
        return redirect('/');
    }

    public function deleteUser(){
        $users = User::all();
        return view('user.delete')->with('users', $users);
    }

    public function removeUser($user){
        $user = User::findOrFail($user);

        if($user->profil == "client")
            Client::where('user_id',$user->id)->delete();

        if($user->profil == "gestionnaire")
            Gestionnaire::where('user_id',$user->id)->delete();

        if($user->profil == "technicien")
            Technicien::where('user_id',$user->id)->delete();

        $user->delete();
        return  redirect('/');
    }

    public function listUser(){
        $users = User::all();
        return view('user.liste')->with('users', $users);
    }

    public function editUser(){
        $users = User::all();
        return view('user.edit')->with('users', $users);
    }
    public function editUserform($user){
        return view('user.editForm')->with('user',User::find($user));
    }
    public function updateUser(Request $request){
        $photo_url = "img/images/profil.png";
        // Créer une instance Intervention\Image\Image à partir des données de la photo
       if($request->photo){
           $image = Image::make($request->photo);
   
           // Redimensionner l'image pour qu'elle ait une taille maximale de 50x50 pixels
           $image->fit(50, 50);
   
           // Encoder l'image dans le format approprié en fonction de l'extension du fichier
           if ($request->photo->extension() == 'png') {
               $imageData = $image->encode('png', 80);
           } elseif ($request->photo->extension() == 'gif') {
               $imageData = $image->encode('gif');
           } else {
               $imageData = $image->encode('jpg', 80);
           }
   
           // Générer un nom de fichier unique pour la nouvelle image
           $filename = uniqid('avatar_', true) . '.' . $request->photo->extension();
   
           // Stocker l'image dans le système de fichiers public de Laravel
           Storage::disk('public')->put('avatars/' . $filename, $imageData);
   
           // Enregistrer l'URL de l'image dans la base de données
           $photo_url = 'avatars/' . $filename;
       }
       
        $user = User::find($request->id);
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->sexe = $request->sexe;
        $user->photo_url = $photo_url;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;
        $user->profil = $request->profil;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->date_naissance = $request->naissance; 
        $user->save();
        return  redirect('/');
    }
}
