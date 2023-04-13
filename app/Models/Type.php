<?php

namespace App\Models;

use App\Models\Technicien;
use App\Models\Reclamation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    public function reclamation(){
        return $this->hasOne(Reclamation::class);
    }

    public function techniciens(){
        return $this->belongsToMany(Technicien::class);
    }
}
