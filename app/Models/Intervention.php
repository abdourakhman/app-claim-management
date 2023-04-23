<?php

namespace App\Models;

use App\Models\Technicien;
use App\Models\Reclamation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intervention extends Model
{
    use HasFactory;

    protected $fillable = ['lieu', 'statut'];

    public function techniciens(){
        return $this->belongsToMany(Technicien::class)->withPivot('date');
    }

    public function reclamation(){
        return $this->belongsTo(Reclamation::class);
    }
}
