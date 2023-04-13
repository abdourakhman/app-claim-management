<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reclamation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gestionnaire extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reclamations(){
        return $this->hasMany(Reclamation::class);
    }
}
