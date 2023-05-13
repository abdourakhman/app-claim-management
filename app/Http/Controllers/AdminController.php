<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use App\Models\Client;
use App\Models\Technicien;
use App\Models\Gestionnaire;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{   
    public function dashboard(){
        $numberCustumer = User::where('profil','client')->get()->count();
        $numberManager = User::where('profil','gestionnaire')->get()->count();
        $numberTechnician = User::where('profil','technicien')->get()->count();
        $numberIntervention = Intervention::count();

        $registrations = DB::table(DB::raw('(SELECT DISTINCT DATE_FORMAT(created_at, "%Y-%m") as mois_annee FROM users) AS months'))
        ->leftJoin('users', DB::raw('DATE_FORMAT(users.created_at, "%Y-%m")'), '=', DB::raw('months.mois_annee'))
        ->select(DB::raw('months.mois_annee as mois_annee'), DB::raw('COUNT(users.id) as nombre_clients'))
        ->where('users.profil', 'client')
        ->groupBy(DB::raw('months.mois_annee'))
        ->orderBy(DB::raw('months.mois_annee'))
        ->get();
        return view('user.admin_dashboard',
                        ['numberCustumer'=>$numberCustumer,
                        'numberManager'=>$numberManager,
                        'numberTechnician'=>$numberTechnician,
                        'numberIntervention'=>$numberIntervention,
                        'registrations'=>$registrations
                        ]
                    );
    }
    public function createUser(){
        return view('user.form');
    }

    public function saveUser(Request $request){
        $success = false;
    $default_photo_path = "img/images/profil.png";

    // Enregistrer l'image par défaut dans le système de fichiers Laravel
    if (!Storage::disk('public')->exists($default_photo_path)) {
        Storage::disk('public')->put($default_photo_path, file_get_contents(public_path($default_photo_path)));
    }

    $photo_url = $default_photo_path;

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
        $validator = Validator::make($request->all(), [
            'profil' => 'required',
            'password' => 'required',
            'naissance' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
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
        if($user->profil == 'client'){
            $user->client()->save(new Client(['CIN' =>$request->cin]));
        }
        if($user->profil == 'gestionnaire'){$user->gestionnaire()->save(new Gestionnaire);}
        if($user->profil == 'technicien'){
            $technicien = $user->technicien()->save(new Technicien);
            if($request->type_eau){
                $type = Type::where('nom',$request->type_eau)->first();
                $technicien->types()->attach($type->id);
            }
            if($request->type_electricite){
                $type = Type::where('nom',$request->type_electricite)->first();
                $technicien->types()->attach($type->id);
            }
        }
        return view('user.form')->with('success', $success=true);
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
        $success = true;
        return  view('home')->with('success', $success);
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
        $success = true;
        return  view('home')->with('success',$success);
    }
    public function searchUser(Request $request){
        $users = User::where('prenom','like', '%'.$request->term.'%')
        ->orwhere('id','=', $request->term)
        ->orwhere('email','=', $request->term)
        ->orwhere('profil','=', $request->term)
        ->orwhere('nom','like', '%'.$request->term.'%')->get();
        return view('user.liste')->with('users', $users);
    }
}
