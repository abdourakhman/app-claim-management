<?php

namespace App\Models;

use App\Models\Technicien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fiche extends Model
{
    use HasFactory;

    public function technicien(){
        return $this->belongsTo(Technicien::class);
    }
}
