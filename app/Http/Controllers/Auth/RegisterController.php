<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'sexe' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'naissance' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //tester si la variable existe 
        // sinon donner une valeur par défaut 
        // et le mettre dans le storage 
        dd($data);
        // Créer une instance Intervention\Image\Image à partir des données de la photo
        $image = Image::make($data['photo']);

        // Redimensionner l'image pour qu'elle ait une taille maximale de 50x50 pixels
        $image->fit(50, 50);

        // Encoder l'image dans le format approprié en fonction de l'extension du fichier
        if ($data['photo']->extension() == 'png') {
            $imageData = $image->encode('png', 80);
        } elseif ($data['photo']->extension() == 'gif') {
            $imageData = $image->encode('gif');
        } else {
            $imageData = $image->encode('jpg', 80);
        }

        // Générer un nom de fichier unique pour la nouvelle image
        $filename = uniqid('avatar_', true) . '.' . $data['photo']->extension();

        // Stocker l'image dans le système de fichiers public de Laravel
        Storage::disk('public')->put('avatars/' . $filename, $imageData);

        // Enregistrer l'URL de l'image dans la base de données
        $photo_url = 'avatars/' . $filename;

        $user = User::create([
            'email' => $data['email'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'sexe' => $data['sexe'],
            'photo_url' => $photo_url,
            'telephone' => $data['telephone'],
            'adresse' => $data['adresse'],
            'date_naissance' => $data['naissance'],
            'password' => Hash::make($data['password']),
        ]);
        $user->client()->save(new Client(['CIN' =>$data['cin']]));
        return $user;
    }
}