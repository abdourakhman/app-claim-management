<?php

namespace App\Models;

use App\Models\Type;
use App\Models\User;
use App\Models\Fiche;
use App\Models\Reclamation;
use App\Models\Intervention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technicien extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function fiches(){
        return $this->hasMany(Fiche::class);
    }

    public function reclamations(){
        return $this->belongsToMany(Reclamation::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function interventions(){
        return $this->belongsToMany(Intervention::class);
    }
}
