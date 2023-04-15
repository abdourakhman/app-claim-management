<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Technicien;
use App\Models\Gestionnaire;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'sexe',
        'telephone',
        'photo_url',
        'date_naissance',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relationship

    public function client(){
        return $this->hasOne(Client::class);
    }

    public function gestionnaire(){
        return $this->hasOne(Gestionnaire::class);
    }

    public function technicien(){
        return $this->hasOne(Technicien::class);
    }
}
